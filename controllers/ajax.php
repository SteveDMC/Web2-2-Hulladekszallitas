<?php

class Ajax_Controller
{
    public function main(array $vars)
    {
        $szolg_id = (int)$_GET['szolgid'];
        $ev = (int)$_GET['ev'];
        $honap = (int)$_GET['honap'];

        $naptar = new Naptar_Model;
        $hsz = new Hulladekszallitas_Model;

        $this->sendJson([
            'hetek' => $naptar->getHetek($ev, $honap),
            'szallitasi_napok' => $hsz->getSzallitasiNapok($szolg_id, $ev, $honap),
            'igenyek' => $hsz->getIgenyek($szolg_id, $ev, $honap),
            'mennyisegek' => $hsz->getMennyisegek($ev, $honap),
        ]);
    }

    protected function sendJson(array $data): never
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
