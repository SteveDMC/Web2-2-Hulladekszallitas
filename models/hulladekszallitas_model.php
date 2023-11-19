<?php

class Hulladekszallitas_Model
{
    public function getSzolgaltatasok(): array
    {
        $connection = Database::getConnection();
        $stmt = $connection->query("select id, jelentes from szolgaltatas;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvek(): array
    {
        $connection = Database::getConnection();
        $stmt = $connection->query("select distinct YEAR(datum) ev from naptar order by datum asc;");
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
        $stmt = $connection->prepare("select datum from naptar where szolgid = ? and datum between ? and ? order by datum asc;");
        $stmt->execute([$szolgaltatas_id, $kezdo_datum, $veg_datum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
