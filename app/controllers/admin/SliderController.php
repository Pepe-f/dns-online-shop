<?php

namespace app\controllers\admin;

use RedBeanPHP\R;

class SliderController extends AppController
{
	public function indexAction()
	{
		$slides = $this->model->get_slides();
		$title = "Управление слайдером";
		$this->setMeta($title);
		$this->set(compact("title", "slides"));
	}

	public function addAction()
	{
		if (!empty($_POST)) {
			if ($this->model->slider_validate()) {
				if ($this->model->save_slider()) {
					$_SESSION["success"] = "Слайд добавлен";
				} else {
					$_SESSION["errors"] = "Ошибка добавления слайда";
				}
			}
			redirect();
		}

		$title = "Добавление слайда";
		$this->setMeta($title);
		$this->set(compact("title"));
	}

	public function editAction()
	{
		$id = get("id");

		if (!empty($_POST)) {
			if ($this->model->slider_validate()) {
				if ($this->model->update_slider($id)) {
					$_SESSION["success"] = "Слайд обновлен";
				} else {
					$_SESSION["errors"] = "Ошибка обновления слайда";
				}
			}

			redirect();
		}

		$slide = $this->model->get_slide($id);
		if (!$slide) {
			throw new \Exception("Слайд не найден", 404);
		}

		$title = "Редактирование слайда";
		$this->setMeta($title);
		$this->set(compact("title", "slide"));
	}

	public function deleteAction()
	{
		$id = get("id");

		R::exec("DELETE FROM slider WHERE id = ?", [$id]);
		$_SESSION["success"] = "Слайд удален";

		redirect();
	}
}
