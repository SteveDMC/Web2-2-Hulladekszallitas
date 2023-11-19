<?php

class Regisztracio_Controller
{
	public $baseName = 'belepes';

	public function main(array $vars)
	{
		$regisztralModel = new Regisztral_Model;
        $result = $regisztralModel->get_data($vars);
		$view = new View_Loader($this->baseName."_main");
        $view->assignAll($result);
	}
}
