<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Slider extends AppModel
{
	public function slider_validate(): bool
	{
		$errors = "";

		$_POST["title"] = trim($_POST["title"]);
		if (empty($_POST["title"])) {
			$errors .= "Не заполнен Заголовок<br>";
		}

		if ($errors) {
			$_SESSION["errors"] = $errors;
			$_SESSION["form_data"] = $_POST;
			return false;
		}
		return true;
	}

	public function save_slider(): bool
	{
		R::begin();
		try {
			$slider = R::dispense("slider");
			$slider->title = post("title", "s");
			$slider->text = $_POST["text"];
			$slider->img = post("img") ?: NO_IMAGE;
			R::store($slider);

			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			$_SESSION["form_data"] = $_POST;
			return false;
		}
	}

	public function update_slider($id): bool
	{
		R::begin();
		try {
			$slide = R::load("slider", $id);
			if (!$slide) {
				return false;
			}

			$slide->title = post("title", "s");
			$slide->text = $_POST["text"];
			$slide->img = post("img") ?: NO_IMAGE;
			R::store($slide);

			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}

	public function get_slide($id): array
	{
		return R::getRow("SELECT * FROM slider WHERE id = ?", [$id]);
	}

	public function get_slides(): array
	{
		return R::getAll("SELECT * FROM slider");
	}
}
