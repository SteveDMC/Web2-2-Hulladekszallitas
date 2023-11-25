<?php

class Alapinfok_Hulladekszallitas_Controller
{
	public $baseName = 'alapinfok_hulladekszallitas';

	public function main(array $vars)
	{
		$model = new Alapinfok_Hulladekszallitas_Model;

        $view = new View_Loader($this->baseName."_main");
		$view->assignAll([
			'szolgaltatasok' => $model->getSzolgaltatasok() ?? [],
            'evek' => $model->getEvek() ?? [],
            'honapok' => $model->getHonapok() ?? [],
		]);
	}
}
