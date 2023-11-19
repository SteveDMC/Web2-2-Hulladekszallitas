<?php

class Ajax_Controller
{
	public function main(array $vars)
	{
		$naptar = new Naptar_Model;
        $data = [
            'hetek' => $naptar->getHetek(2023, 8),
        ];
        $this->sendJson($data);
	}

    protected function sendJson(array $data): never
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
