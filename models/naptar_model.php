<?php

class Naptar_Model
{
    public function getHetek(int $ev, int $honap): array
    {
        $kezdo_datum = sprintf('%d-%02d-01', $ev, $honap);
        $napok_szama = (int)date('t', strtotime($kezdo_datum)); // hány nap van az adott hónapban?
        $het_napja = (int)date('w', strtotime($kezdo_datum)) ?: 7; // hányadik napra esik a kezdődátum? (vasárnap 0, így akkor 7-re állítjuk)

        $het = 0;
        $hetek = [];

        for ($i = 1; $i < $het_napja; $i++) { // első hét feltöltése üres napokkal a kezdőnapig
            $hetek[$het][] = ['datum' => null, 'nap' => null];
        }        
        for ($i = 1; $i <= $napok_szama; $i++) { // heti bontásban a hónap napjai
            if (isset($hetek[$het]) && count($hetek[$het]) % 7 === 0) {
                $het++;
            }
            $hetek[$het][] = ['datum' => sprintf('%d-%02d-%02d', $ev, $honap, $i), 'nap' => $i];
        }
        for ($i = 1; $i < count($hetek[$het]) % 7; $i++) { // utolsó hét maradék napjainak feltöltése üres napokkal
            $hetek[$het][] = ['datum' => null, 'nap' => null];
        }
        return $hetek;
    }
}
