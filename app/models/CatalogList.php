<?php

namespace app\models;

use RedBeanPHP\R;

class CatalogList extends AppModel
{
	public function get_category($slug): array
	{
		return R::getRow(
			"SELECT * FROM category WHERE parent_id = 0 AND slug = ?",
			[$slug]
		);
	}

	public function get_category_id($category): int
	{
		return $category["id"];
	}

	public function get_subcategories($parent_id): array
	{
		return R::getAll("SELECT * FROM category WHERE parent_id = ?", [
			$parent_id
		]);
	}
}
