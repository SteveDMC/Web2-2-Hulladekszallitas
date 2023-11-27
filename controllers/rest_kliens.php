<?php

class Rest_Kliens_Controller
{
    public $baseName = 'rest_kliens';

    public function main(array $vars)
    {
        $result = [];
        $http_code = null;
        if (isset($_POST["send"])) {
            $method = $vars["method"];
            $resource_id = (int)$vars["id"] ?: null;
            $data = null;
            if (in_array($method, ["POST", "PUT"])) {
                $data = [
                    "tipus" => $vars["tipus"],
                    "jelentes" => $vars["jelentes"],
                ];
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

    protected function sendRequest(string $method, ?int $resource_id, ?array $data)
    {
        $url = SITE_ROOT . 'rest';
        if ($resource_id) {
            $url .= '/' . $resource_id;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [$http_code, json_decode($result, true)];
    }
}
