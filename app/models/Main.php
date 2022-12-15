<?php

namespace app\models;

use RedBeanPHP\R;

class Main extends AppModel
{
	public function getRecomendation($limit): array
	{
		return R::getAll("SELECT * FROM product ORDER BY id DESC LIMIT $limit");
	}

	public function getPopular($limit): array
	{
		return R::getAll(
			"SELECT * FROM category WHERE parent_id > 0 ORDER BY counter DESC LIMIT $limit"
		);
	}
}
