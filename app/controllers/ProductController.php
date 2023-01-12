<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;

/** @property Product $model */

class ProductController extends AppController
{
	public function viewAction()
	{
		$product = $this->model->get_product($this->route["slug"]);

		if (!$product) {
			$this->error_404();
			return;
		}

		$breadcrumbs = Breadcrumbs::getBreadcrumbs($product["category_id"], $product["name"]);

		$gallery = $this->model->get_gallery($product["id"]);
		$characteristics = $this->model->get_characteristics($product["id"]);
		$this->setMeta($product["name"], $product["description"], $product["keywords"]);
		$this->set(compact("product", "gallery", "breadcrumbs", "characteristics"));
	}
}
