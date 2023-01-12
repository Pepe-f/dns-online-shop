<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Product extends AppModel
{
	public function product_validate(): bool
	{
		$errors = '';
		if (!is_numeric(post('price'))) {
			$errors .= "Цена должна быть числовым значением<br>";
		}

		$item = $_POST['product'];
		$item['name'] = trim($item['name']);
		if (empty($item['name'])) {
			$errors .= "Не заполнено Наименование<br>";
		}

		if ($errors) {
			$_SESSION['errors'] = $errors;
			$_SESSION['form_data'] = $_POST;
			return false;
		}
		return true;
	}

	public function save_product(): bool
	{
		R::begin();
		try {
			// product
			$product = R::dispense('product');
			$product->category_id = post('parent_id', 'i');
			$product->price = post('price', 'i');
			$product->qty = post('qty', 'i');
			$product->img = post('img') ?: NO_IMAGE;
			$product->brand_id = post('brand_id', 'i');
			$product->article = post('article');
			R::store($product);

			$item = $_POST['product'];
			$product->name = $item['name'];
			$product->content = $item['content'];
			$product->description = $item['description'];
			$product->keywords = $item['keywords'];
			$product_id = R::store($product);

			$product->slug = AppModel::create_slug('product', 'slug', $_POST['product']['name'], $product_id);

			R::store($product);

			// product_gallery if exists
			if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
				$sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
				foreach ($_POST['gallery'] as $item) {
					$sql .= "({$product_id}, ?),";
				}
				$sql = rtrim($sql, ',');
				R::exec($sql, $_POST['gallery']);
			}

			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			$_SESSION['form_data'] = $_POST;
			return false;
		}
	}

	public function update_product($id): bool
	{
		R::begin();
		try {
			$product = R::load('product', $id);
			if (!$product) {
				return false;
			}

			$product->category_id = post('parent_id', 'i');
			$product->brand_id = post('brand_id', 'i');
			$product->article = post('article');
			$product->price = post('price', 'i');
			$product->qty = post('qty', 'i');
			$product->img = post('img') ?: NO_IMAGE;
			R::store($product);

			$item = $_POST['product'];
			$product->name = $item['name'];
			$product->description = $item['description'];
			$product->keywords = $item['keywords'];
			$product->content = $item['content'];
			$product_id = R::store($product);

			if (!isset($_POST['gallery'])) {
				R::exec("DELETE FROM product_gallery WHERE product_id = ?", [$id]);
			}

			if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
				$gallery = self::get_gallery($id);

				if ((count($gallery) != count($_POST['gallery'])) || array_diff($gallery, $_POST['gallery']) || array_diff($_POST['gallery'], $gallery)) {
					R::exec("DELETE FROM product_gallery WHERE product_id = ?", [$id]);
					$sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
					foreach ($_POST['gallery'] as $item) {
						$sql .= "({$id}, ?),";
					}
					$sql = rtrim($sql, ',');
					R::exec($sql, $_POST['gallery']);
				}
			}

			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}

	public function get_product($id): array
	{
		return R::getRow("SELECT * FROM product WHERE id = ?", [$id]);
	}

	public function get_products($start, $perpage): array
	{
		return R::getAll("SELECT * FROM product LIMIT $start, $perpage");
	}

	public function get_brands(): array
	{
		return R::getAll("SELECT * FROM brand");
	}

	public function get_gallery($id): array
	{
		return R::getCol("SELECT img FROM product_gallery WHERE product_id = ?", [$id]);
	}
}
