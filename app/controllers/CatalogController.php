<?php

namespace app\controllers;

use app\models\Catalog;

/** @property Catalog $model */
class CatalogController extends AppController
{
	public function viewAction()
	{
		$subcategory = $this->model->get_subcategory($this->route["slug"]);

		if (!$subcategory) {
			$this->error_404();
			return;
		}

		$this->model->update_subcategory_counter($subcategory);

		$ids = $this->model->getIds($subcategory["id"]);
		$ids = !$ids ? $subcategory["id"] : $ids . $subcategory["id"];

		$products = $this->model->get_products($ids);
		$brands = $this->model->get_brands($products);
		$maxPrice = $this->model->get_max_price($products);
		$category = $this->model->get_category($subcategory);
		$this->setMeta($subcategory["name"], $subcategory["description"], $subcategory["keywords"]);
		$this->set(compact("products", "subcategory", "brands", "maxPrice", "category"));
	}
}
