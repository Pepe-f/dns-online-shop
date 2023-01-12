<?php

namespace app\controllers\admin;

use app\models\admin\Brand;
use RedBeanPHP\R;

/** @property Brand $model */
class BrandController extends AppController
{
	public function indexAction()
	{
		$brands = $this->model->get_brands();
		
		$title = "Бренды";
		$this->setMeta($title);
		$this->set(compact("title", "brands"));
	}
	
	public function addAction()
	{
		if (!empty($_POST)) {
			if ($this->model->brand_validate()) {
				if ($this->model->save_brand()) {
					$_SESSION['success'] = 'Бренд добавлен';
				} else {
					$_SESSION['errors'] = 'Ошибка добавления';
				}
			}
			redirect();
		}
		
		$title = "Добавление бренда";
		$this->setMeta($title);
		$this->set(compact("title"));
	}
	
	public function editAction()
	{
		$id = get('id');
		if (!empty($_POST)) {
			if ($this->model->brand_validate()) {
				if ($this->model->update_brand($id)) {
					$_SESSION['success'] = 'Бренд обновлен';
				} else {
					$_SESSION['errors'] = 'Ошибка обновления';
				}
			}
			
			redirect();
		}
		
		$brand = $this->model->get_brand($id);
		if (!$brand) {
			throw new \Exception('Не найден бренд', 404);
		}
		
		$title = 'Редактирование бренда';
		$this->setMeta($title);
		$this->set(compact("title", "brand"));
	}
	
	public function deleteAction()
	{
		$id = get("id");
		$errors = "";
		$products = R::count("product", "brand_id = ?", [$id]);
		if ($products) {
			$errors .= "Ошибка! С брендом связаны товары<br>";
		}
		if ($errors) {
			$_SESSION["errors"] = $errors;
		} else {
			R::exec("DELETE FROM brand WHERE id = ?", [$id]);
			$_SESSION["success"] = "Бренд удален";
		}
		
		redirect();
	}
}