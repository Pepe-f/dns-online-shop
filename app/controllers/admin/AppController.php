<?php

namespace app\controllers\admin;

use app\models\admin\User;
use app\models\AppModel;
use dns\App;
use dns\Controller;
use RedBeanPHP\R;

class AppController extends Controller
{
	public false|string $layout = "admin";

	public function __construct($route)
	{
		parent::__construct($route);

		if (!User::isAdmin() && $route["action"] != "login-admin") {
			redirect(ADMIN . "/user/login-admin");
		}

		new AppModel();

		$categories = R::getAssoc("SELECT * FROM category");
		App::$app->setProperty("categories", $categories);
	}
}
