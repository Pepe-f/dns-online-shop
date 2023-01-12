<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Category extends AppModel
{
	public function category_validate(): bool
	{
		$errors = '';
		$item = $_POST['category'];
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
	
	public function save_category(): bool
	{
		R::begin();
		try {
			$category = R::dispense('category');
			$category->parent_id = post('parent_id', 'i');
			$category_id = R::store($category);
			
			$item = $_POST['category'];
			$category->name = $item['name'];
			$category->description = $item['description'];
			$category->keywords = $item['keywords'];
			$category->content = $item['content'];
			R::store($category);
			
			$category->slug = AppModel::create_slug(
				'category', 'slug', $_POST['category']['name'], $category_id
			);
			R::store($category);
			
			R::commit();
			
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function update_category($id): bool
	{
		R::begin();
		try {
			$category = R::load('category', $id);
			if (!$category) {
				return false;
			}
			
			$category->parent_id = post('parent_id', 'i');
			
			$item = $_POST['category'];
			$category->name = $item['name'];
			$category->description = $item['description'];
			$category->keywords = $item['keywords'];
			$category->content = $item['content'];
			R::store($category);
			
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function get_category($id): array
	{
		return R::getRow("SELECT * FROM category WHERE id = ?", [$id]);
	}
}