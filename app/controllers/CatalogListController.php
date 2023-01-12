<?php

namespace app\controllers;

use app\models\CatalogList;
use dns\App;

/** @property CatalogList $model */

class CatalogListController extends AppController
{
	public function viewAction()
	{
		$category = $this->model->get_category($this->route["slug"]);

		if (!$category) {
			$this->error_404();
			return;
		}

		$category_id = $this->model->get_category_id($category);
		$subcategories = $this->model->get_subcategories($category_id);

		$this->setMeta($category["name"], $category["description"], $category["keywords"]);
		$this->set(compact("category", "subcategories"));
	}
}
