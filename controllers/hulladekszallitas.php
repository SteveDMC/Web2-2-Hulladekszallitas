<?php

class Hulladekszallitas_Controller
{
	public $baseName = 'hulladekszallitas';

	public function main(array $vars)
	{
		$model = new Hulladekszallitas_Model;

        $view = new View_Loader($this->baseName."_main");
		$view->assignAll([
			'szolgaltatasok' => $model->getSzolgaltatasok() ?? [],
            'evek' => $model->getEvek() ?? [],
            'honapok' => $model->getHonapok() ?? [],
		]);
	}
}
