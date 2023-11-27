<?php

class Alapinfok_Hulladekszallitas_Model
{
    public function getSzolgaltatasok(): array
    {
        $connection = Database::getConnection();
        $stmt = $connection->query("select * from szolgaltatas order by id;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSzolgaltatasById(int $szolgid): array|bool
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare("select * from szolgaltatas where id = ?;");
        $stmt->execute([$szolgid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertSzolgaltatas(array $data): array
    {
        $connection = Database::getConnection();
        $connection->prepare("insert into szolgaltatas (tipus, jelentes) values (?, ?);")->execute([$data['tipus'], $data["jelentes"]]);
        return $this->getSzolgaltatasById($connection->lastInsertId());
    }

    public function updateSzolgaltatas(int $id, array $data): int
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare("update szolgaltatas set tipus=?, jelentes=? where id=?;");
        $stmt->execute([$data['tipus'], $data["jelentes"], $id]);
        return $stmt->rowCount();
    }

    public function deleteSzolgaltatas(int $id): int
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare("delete from szolgaltatas where id=?;");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getSzolgaltatasNev(int $szolgid): string
    {
        $connection = Database::getConnection();
        $stmt = $connection->prepare("select jelentes from szolgaltatas where id = ?;");
        $stmt->execute([$szolgid]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['jelentes'] : 'Ismeretlen szolgáltatás';
    }

    public function getEvek(): array
    {
        $connection = Database::getConnection();
        $stmt = $connection->query("select distinct YEAR(datum) ev from naptar order by datum;");
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'ev');
    }

    public function getHonapok(): array
    {
        return range(1, 12);
    }

    public function getSzallitasiNapok(int $szolgaltatas_id, int $ev, int $honap): array
    {
        $kezdo_datum = sprintf('%d-%02d-01', $ev, $honap);
        $veg_datum = sprintf('%d-%02d-31', $ev, $honap);
        $connection = Database::getConnection();
        $stmt = $connection->prepare("select datum from naptar where szolgid = ? and datum between ? and ? order by datum;");
        $stmt->execute([$szolgaltatas_id, $kezdo_datum, $veg_datum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIgenyek(int $szolgaltatas_id, int $ev, int $honap): array
    {
        $kezdo_datum = sprintf('%d-%02d-01', $ev, $honap);
        $veg_datum = sprintf('%d-%02d-31', $ev, $honap);
        $connection = Database::getConnection();
        $stmt = $connection->prepare("select igeny, mennyiseg from lakig where szolgid = ? and igeny between ? and ? order by igeny;");
        $stmt->execute([$szolgaltatas_id, $kezdo_datum, $veg_datum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMennyisegek(int $ev, int $honap): array
    {
        $kezdo_datum = sprintf('%d-%02d-01', $ev, $honap);
        $veg_datum = sprintf('%d-%02d-31', $ev, $honap);
        $connection = Database::getConnection();
        $stmt = $connection->prepare("select jelentes as tipus, sum(mennyiseg) as mennyiseg from lakig join szolgaltatas on lakig.szolgid = szolgaltatas.id where igeny between ? and ? group by jelentes order by mennyiseg;");
        $stmt->execute([$kezdo_datum, $veg_datum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNapokLista(int $szolgid, int $ev, int $honap): array
    {
        $szallitasi_napok = array_map(function ($nap) {
            return [
                $nap['datum'] => 'szállítási nap'
            ];
        }, $this->getSzallitasiNapok($szolgid, $ev, $honap));

        $igenyek = array_map(function ($nap) {
            return [
                $nap['igeny'] => sprintf('szállítási igény (mennyiség: %s)', $nap['mennyiseg'])
            ];
        }, $this->getIgenyek($szolgid, $ev, $honap));

        $lista = array_merge($szallitasi_napok, $igenyek);
        usort($lista, function ($a, $b) {
            return key($a) <=> key($b);
        });
        return $lista;
    }
}
