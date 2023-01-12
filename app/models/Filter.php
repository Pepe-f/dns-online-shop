<?php

namespace app\models;

use dns\App;
use RedBeanPHP\R;

class Filter extends AppModel
{
	public function filter_products(
		$subcategory,
		$brands,
		$minPrice,
		$maxPrice
	): array {
		$sql = "SELECT * FROM product WHERE category_id = $subcategory";
		if (isset($brands) && !empty($brands)) {
			$brand = implode("', '", $brands);
			$sql .= " AND brand_id IN('" . $brand . "')";
		}
		if (isset($minPrice) && isset($maxPrice)) {
			$sql .= " AND price BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'";
		}

		return R::getAll($sql);
	}
}
