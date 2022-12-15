<?php

namespace app\models;

use dns\App;
use RedBeanPHP\R;

class Catalog extends AppModel
{
	public function get_subcategory($slug): array
	{
		return R::getRow(
			"SELECT * FROM category WHERE slug = ? AND parent_id > 0",
			[$slug]
		);
	}

	public function update_subcategory_counter($subcategory)
	{
		$currentCounter = $subcategory["counter"];
		$counter = $currentCounter + 1;
		R::exec("UPDATE category SET counter=$counter WHERE id = ?", [
			$subcategory["id"]
		]);
	}

	public function get_category($subcategory): array
	{
		return R::getRow("SELECT * FROM category WHERE id = ? AND parent_id = 0", [
			$subcategory["parent_id"]
		]);
	}

	public function getIds($id): string
	{
		$subcategories = App::$app->getProperty("subcategories");
		$ids = "";
		foreach ($subcategories as $k => $v) {
			if ($v["parent_id"] === $id) {
				$ids .= $k . ",";
				$ids .= $this->getIds($k);
			}
		}
		return $ids;
	}

	public function get_products($ids): array
	{
		return R::getAll("SELECT * FROM product WHERE category_id IN ($ids)");
	}

	public function get_brands($products): array
	{
		$ids = "";
		$products_size = count($products);
		$counter = 1;
		foreach ($products as $product) {
			$ids .= $product["brand_id"];
			if ($counter !== $products_size) {
				$ids .= ",";
			}
			$counter += 1;
		}
		return R::getAll("SELECT * FROM brand WHERE id IN ($ids)");
	}

	public function get_max_price($products): int
	{
		$prices = [];
		foreach ($products as $product) {
			$prices[] = $product["price"];
		}
		return max($prices);
	}
}
