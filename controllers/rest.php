<?php

class Rest_Controller
{
    public function main(array $vars)
    {
        $hsz = new Alapinfok_Hulladekszallitas_Model;

        $resource_id = (int)($vars[0] ?? null);
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET": {
                $result = $resource_id ? $hsz->getSzolgaltatasById($resource_id) : $hsz->getSzolgaltatasok();
                if ($result === false) {
                    $this->sendJson(null, 404);
                } else {
                    $this->sendJson($result);
                }
                break;
            }
            case "POST": {
                try {
                    $input = file_get_contents("php://input");
                    $parsed = json_decode($input, true);
                    $inserted = $hsz->insertSzolgaltatas($parsed);
                    $this->sendJson($inserted, 201);
                } catch (Throwable) {
                    $this->sendJson(null, 400);
                }
                break;
            }
            case "PUT": {
                try {
                    $input = file_get_contents("php://input");
                    $parsed = json_decode($input, true);
                    $rowCount = $hsz->updateSzolgaltatas($resource_id, $parsed);
                    $rowCount ? $this->sendJson(null) : $this->sendJson(null, 404);
                } catch (Throwable) {
                    $this->sendJson(null, 400);
                }
                break;
            }
            case "DELETE": {
                try {
                    $rowCount = $hsz->deleteSzolgaltatas($resource_id);
                    $rowCount ? $this->sendJson(null, 204) : $this->sendJson(null, 404);
                } catch (Throwable) {
                    $this->sendJson(null, 400);
                }
                break;
            }
            default: {
                $this->sendJson(null, 405);
            }
        }

        /*$this->sendJson([
            'napok' => $naptar->getNapok($ev, $honap),
            'szallitasi_napok' => $hsz->getSzallitasiNapok($szolg_id, $ev, $honap),
            'igenyek' => $hsz->getIgenyek($szolg_id, $ev, $honap),
            'mennyisegek' => $hsz->getMennyisegek($ev, $honap),
        ]);*/
    }

    protected function sendJson(?array $data, int $response_code = 200): never
    {
        http_response_code($response_code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
