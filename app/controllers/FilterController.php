<?php

namespace app\controllers;

use app\models\Filter;

/** @property Filter $model */

class FilterController extends AppController
{
	public function showAction()
	{
		$subcategory = get("subcategory");
		if (isset($_GET["brands"])) {
			$brands = $_GET["brands"];
		} else {
			$brands = [];
		}
		$minPrice = get("minPrice");
		$maxPrice = get("maxPrice");

		$products = $this->model->filter_products(
			$subcategory,
			$brands,
			$minPrice,
			$maxPrice
		);

		if ($this->isAjax()) {
			$this->loadView("view", $products);
		}

		return true;
	}
}
