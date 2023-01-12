<?php

namespace app\models;

use RedBeanPHP\R;

class Product extends AppModel
{
	public function get_product($slug): array
	{
		return R::getRow("SELECT * FROM product WHERE slug = ?", [$slug]);
	}

	public function get_gallery($product_id): array
	{
		return R::getAll("SELECT * FROM product_gallery WHERE product_id = ?", [
			$product_id
		]);
	}

	public function get_characteristics($product_id): array
	{
		return R::getAll(
			"SELECT * FROM product_characteristic WHERE product_id = ?",
			[$product_id]
		);
	}
}
