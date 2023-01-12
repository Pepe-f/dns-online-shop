<?php

namespace app\controllers\admin;

use app\models\admin\Category;
use dns\App;
use RedBeanPHP\R;

/** @property Category $model */
class CategoryController extends AppController
{
	public function indexAction()
	{
		$title = "Категории";
		$this->setMeta($title);
		$this->set(compact("title"));
	}

	public function deleteAction()
	{
		$id = get("id");
		$errors = "";
		$children = R::count("category", "parent_id = ?", [$id]);
		$products = R::count("product", "category_id = ?", [$id]);
		if ($children) {
			$errors .= "Ошибка! В категории есть вложенные категории<br>";
		}
		if ($products) {
			$errors .= "Ошибка! В категории есть товары<br>";
		}
		if ($errors) {
			$_SESSION["errors"] = $errors;
		} else {
			R::exec("DELETE FROM category WHERE id = ?", [$id]);
			$_SESSION["success"] = "Категория удалена";
		}

		redirect();
	}

	public function addAction()
	{
		if (!empty($_POST)) {
			if ($this->model->category_validate()) {
				if ($this->model->save_category()) {
					$_SESSION['success'] = 'Категория добавлена';
				} else {
					$_SESSION['errors'] = 'Ошибка добавления';
				}
			}
			redirect();
		}
		
		$title = "Добавление категории";
		$this->setMeta($title);
		$this->set(compact("title"));
	}
	
	public function editAction()
	{
		$id = get('id');
		if (!empty($_POST)) {
			if ($this->model->category_validate()) {
				if ($this->model->update_category($id)) {
					$_SESSION['success'] = 'Категория обновлена';
				} else {
					$_SESSION['errors'] = 'Ошибка обновления';
				}
			}
			
			redirect();
		}
		$category = $this->model->get_category($id);
		if (!$category) {
			throw new \Exception('Не найдена категория', 404);
		}
		App::$app->setProperty('parent_id', $category['parent_id']);
		$title = 'Редактирование категории';
		$this->setMeta($title);
		$this->set(compact("title", "category"));
	}
}
