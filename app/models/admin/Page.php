<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Page extends AppModel
{
	public function get_pages($start, $perpage): array
	{
		return R::getAll("SELECT * FROM page LIMIT $start, $perpage");
	}
	
	public function deletePage($id): bool
	{
		R::begin();
		try {
			$page = R::load('page', $id);
			if (!$page) {
				return false;
			}
			R::trash($page);
			
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function page_validate(): bool
	{
		$errors = '';
		
		$item = $_POST['page'];
		
		$item['title'] = trim($item['title']);
		$item['content'] = trim($item['content']);
		if (empty($item['title'])) {
			$errors .= "Не заполнено Наименование<br>";
		}
		if (empty($item['content'])) {
			$errors .= "Не заполнен Контент<br>";
		}
		
		if ($errors) {
			$_SESSION['errors'] = $errors;
			$_SESSION['form_data'] = $_POST;
			return false;
		}
		
		return true;
	}
	
	public function save_page(): bool
	{
		R::begin();
		try {
			// page
			$page = R::dispense('page');
			$item = $_POST['page'];
			$page->title = $item['title'];
			$page->content = $item['content'];
			$page->description = $item['description'];
			$page->keywords = $item['keywords'];
			$page_id = R::store($page);
			$page->slug = AppModel::create_slug(
				'page', 'slug', $_POST['page']['title'], $page_id
			);
			R::store($page);
			
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			$_SESSION['form_data'] = $_POST;
			return false;
		}
	}
	
	public function update_page($id): bool
	{
		R::begin();
		try {
			// page
			$page = R::load('page', $id);
			if (!$page) {
				return false;
			}
			
			$item = $_POST['page'];
			$page->title = $item['title'];
			$page->content = $item['content'];
			$page->description = $item['description'];
			$page->keywords = $item['keywords'];
			
			R::store($page);
			
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function get_page($id): array
	{
		return R::getRow("SELECT * FROM page WHERE id = ?", [$id]);
	}
}