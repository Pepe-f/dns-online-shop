<?php

namespace app\models;

use RedBeanPHP\R;

class Page extends AppModel
{
	public function get_page($slug): array
	{
		return R::getRow("SELECT * FROM page WHERE slug = ?", [$slug]);
	}
}
