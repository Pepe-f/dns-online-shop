<?php

namespace app\controllers;

use app\models\AppModel;
use dns\App;
use dns\Controller;
use RedBeanPHP\R;

class AppController extends Controller
{
	public function __construct($route)
	{
		parent::__construct($route);
		new AppModel();

		//$categories = R::getAssoc("SELECT * FROM category WHERE parent_id = 0");
		$subcategories = R::getAssoc("SELECT * FROM category WHERE parent_id > 0");
		$categories = R::getAssoc("SELECT * FROM category");
		App::$app->setProperty("categories", $categories);
		App::$app->setProperty("subcategories", $subcategories);
	}
}
