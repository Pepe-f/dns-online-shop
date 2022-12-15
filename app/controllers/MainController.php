<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;

/** @property Main $model */

class MainController extends AppController
{
	public function indexAction()
	{
		$slides = R::findAll("slider");
		$products = $this->model->getRecomendation(4);
		$subcategories = $this->model->getPopular(6);

		$this->set(compact("slides", "products", "subcategories"));
		$this->setMeta(
			"Интернет-магазин цифровой и бытовой техники",
			"Description...",
			"Keywords..."
		);
	}
}
