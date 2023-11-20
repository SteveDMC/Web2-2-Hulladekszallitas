<?php

class Pdf_Model
{
    public static function generatePdf(array $napok, string $cim)
    {
        require_once(SERVER_ROOT . 'tcpdf/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(null, null, $cim, date('Y.m.d H:i:s'));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();

        $sorok = '';
        foreach ($napok as $nap) {
            $datum = key($nap);
            $esemeny = $nap[$datum];
            $sorok .= <<<SOR
            <tr>
                <td>$datum</td>
                <td>$esemeny</td>
            </tr>
            SOR;
        }

        $html = <<<HTML
        <table border="1" cellpadding="4">
            <thead>
                <tr bgcolor="#eee">
                    <th>Dátum</th>
                    <th>Esemény</th>
                </tr>
            </thead>
            <tbody style="border-top: 1px solid #000;">
                $sorok
            </tbody>
        </table>
        HTML;

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output($cim . '.pdf', 'I');
    }
}
