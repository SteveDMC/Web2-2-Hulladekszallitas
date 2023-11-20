<?php

class Hulladekszallitas_Model
{
    public function getSzolgaltatasok(): array
    {
        $connection = Database::getConnection();
        $stmt = $connection->query("select id, jelentes from szolgaltatas order by id;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
// select jelentes as tipus, szum from (select szolgid, sum(mennyiseg) as szum from lakig where igeny between '2018-04-01' and '2018-04-31' group by szolgid) aggregalt join szolgaltatas on aggregalt.szolgid = szolgaltatas.id;
// select jelentes as tipus, sum(mennyiseg) as mennyiseg from lakig join szolgaltatas on lakig.szolgid = szolgaltatas.id where igeny between '2018-04-01' and '2018-04-31' group by jelentes order by mennyiseg; 