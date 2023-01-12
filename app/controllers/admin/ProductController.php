<?php

namespace app\controllers\admin;

use app\models\admin\Product;
use dns\App;
use dns\Pagination;
use RedBeanPHP\R;

/** @property Product $model */
class ProductController extends AppController
{
	public function indexAction()
	{
		$page = get("page");
		$perpage = 3;
		$total = R::count("product");
		$pagination = new Pagination($page, $perpage, $total);
		$start = $pagination->getStart();

		$products = $this->model->get_products($start, $perpage);

		$title = "Товары";
		$this->setMeta($title);
		$this->set(compact("title", "products", "pagination", "total"));
	}

	public function addAction()
	{
		if (!empty($_POST)) {
			if ($this->model->product_validate()) {
				if ($this->model->save_product()) {
					$_SESSION["success"] = "Товар добавлен";
				} else {
					$_SESSION["errors"] = "Ошибка добавления товара";
				}
			}
			redirect();
		}

		$brands = $this->model->get_brands();
		$title = "Добавление товара";
		$this->setMeta($title);
		$this->set(compact("title", "brands"));
	}

	public function editAction()
	{
		$id = get("id");

		if (!empty($_POST)) {
			if ($this->model->product_validate()) {
				if ($this->model->update_product($id)) {
					$_SESSION["success"] = "Товар обновлен";
				} else {
					$_SESSION["errors"] = "Ошибка обновления товара";
				}
			}

			redirect();
		}

		$product = $this->model->get_product($id);
		if (!$product) {
			throw new \Exception("Товар не найден", 404);
		}

		$brands = $this->model->get_brands();
		$gallery = $this->model->get_gallery($id);

		App::$app->setProperty("parent_id", $product["category_id"]);
		$title = "Редактирование товара";
		$this->setMeta($title);
		$this->set(compact("title", "product", "gallery", "brands"));
	}

	public function deleteAction()
	{
		$id = get("id");

		R::exec("DELETE FROM product_gallery WHERE product_id = ?", [$id]);
		R::exec("DELETE FROM product WHERE id = ?", [$id]);
		$_SESSION["success"] = "Товар удален";

		redirect();
	}
}
