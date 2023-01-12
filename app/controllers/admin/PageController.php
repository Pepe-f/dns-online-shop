<?php

namespace app\controllers\admin;

use dns\Pagination;
use RedBeanPHP\R;

/** @property Page $model */
class PageController extends AppController
{
	public function indexAction()
	{
		$page = get('page');
		$perpage = 20;
		$total = R::count('page');
		$pagination = new Pagination($page, $perpage, $total);
		$start = $pagination->getStart();
		
		$pages = $this->model->get_pages($start, $perpage);
		$title = 'Список страниц';
		$this->setMeta($title);
		$this->set(compact('title', 'pages', 'pagination', 'total'));
	}
	
	public function deleteAction()
	{
		$id = get('id');
		if ($this->model->deletePage($id)) {
			$_SESSION['success'] = 'Страница удалена';
		} else {
			$_SESSION['errors'] = 'Ошибка удаления страницы';
		}
		redirect();
	}
	
	public function addAction()
	{
		if (!empty($_POST)) {
			if ($this->model->page_validate()) {
				if ($this->model->save_page()) {
					$_SESSION['success'] = 'Страница добавлена';
				} else {
					$_SESSION['errors'] = 'Ошибка добавления страницы';
				}
			}
			redirect();
		}
		
		$title = 'Новая страница';
		$this->setMeta($title);
		$this->set(compact('title'));
	}
	
	public function editAction()
	{
		$id = get('id');
		
		if (!empty($_POST)) {
			if ($this->model->page_validate()) {
				if ($this->model->update_page($id)) {
					$_SESSION['success'] = 'Страница сохранена';
				} else {
					$_SESSION['errors'] = 'Ошибка обновления страницы';
				}
			}
			redirect();
		}
		
		$page = $this->model->get_page($id);
		if (!$page) {
			throw new \Exception('Страница не найдена', 404);
		}
		$title = 'Редактирование страницы';
		$this->setMeta($title);
		$this->set(compact('title', 'page'));
	}
}