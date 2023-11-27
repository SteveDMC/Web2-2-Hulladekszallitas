<?php

require_once("admin_rest_kliens.php");

class Admin_Rest_Kliens_Kulso_Controller extends Admin_Rest_Kliens_Controller
{
    protected const REST_URL = "https://gorest.co.in/public/v2/users";
    protected const AUTH_TOKEN = "883aaf31c8874be0730ad015000de6d98d0e4a2c2a509db27d183ec0dfb0d1d1";

    public $baseName = 'admin_rest_kliens_kulso';

    // override
    protected function getDataFromInputs(array $vars): array
    {
        return [
            "name" => $vars["name"],
            "email" => $vars["email"],
            "gender" => $vars["gender"],
            "status" => $vars["status"],
        ];
    }
}
