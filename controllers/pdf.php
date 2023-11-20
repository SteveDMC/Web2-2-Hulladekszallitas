<?php

class Pdf_Controller
{
    public function main(array $vars)
    {
        $szolg_id = (int)$_GET['szolgid'];
        $ev = (int)$_GET['ev'];
        $honap = (int)$_GET['honap'];

        $hsz = new Hulladekszallitas_Model;

        Pdf_Model::generatePdf(
            $hsz->getNapokLista($szolg_id, $ev, $honap),
            sprintf('%s (%d %02d. hónap)', $hsz->getSzolgaltatasNev($szolg_id), $ev, $honap)
        );
    }
}
