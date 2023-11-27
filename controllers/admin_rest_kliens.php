<?php

class Admin_Rest_Kliens_Controller
{
    protected const REST_URL = SITE_ROOT . 'rest';
    protected const AUTH_TOKEN = null;

    public $baseName = 'admin_rest_kliens';

    public function main(array $vars)
    {
        $result = [];
        $http_code = null;
        if (isset($_POST["send"])) {
            $method = $vars["method"];
            $resource_id = (int)$vars["id"] ?: null;
            $data = null;
            if (in_array($method, ["POST", "PUT"])) {
                $data = $this->getDataFromInputs($vars);
            }
            [$http_code, $result] = $this->sendRequest($method, $resource_id, $data);
            if (is_array($result) && !array_is_list($result)) {
                $result = [$result];
            }
        }
        $view = new View_Loader($this->baseName."_main");
        $view->assignAll([
            "result" => $result,
            "response_code" => $http_code,
        ]);
    }

    protected function getDataFromInputs(array $vars): array
    {
        return [
            "tipus" => $vars["tipus"],
            "jelentes" => $vars["jelentes"],
        ];
    }

    protected function sendRequest(string $method, ?int $resource_id, ?array $data)
    {
        $url = static::REST_URL;
        if ($resource_id) {
            $url .= '/' . $resource_id;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        $headers = ["Content-Type: application/json"];
        if (static::AUTH_TOKEN) {
            $headers[] = "Authorization: Bearer " . static::AUTH_TOKEN;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = ($http_code >= 200 && $http_code < 300) ? json_decode($response, true) : null;
        return [$http_code, $result];
    }
}
