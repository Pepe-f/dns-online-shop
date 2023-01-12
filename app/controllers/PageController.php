<?php

namespace app\controllers;

use app\models\Page;
use dns\App;

/** @property Page $model */
class PageController extends AppController
{
	public function viewAction()
	{
		$page = $this->model->get_page($this->route["slug"]);

		if (!$page) {
			$this->error_404();
			return;
		}

		$this->setMeta($page["title"], $page["description"], $page["keywords"]);
		$this->set(compact("page"));
	}
}
