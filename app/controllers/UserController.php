<?php

namespace app\controllers;

use app\models\User;

/** @property User $model */
class UserController extends AppController
{
	public function signupAction()
	{
		if (User::checkAuth()) {
			redirect();
		}

		if (!empty($_POST)) {
			$this->model->load();

			if (!$this->model->checkUnique()) {
				return false;
			} else {
				$this->model->attributes["password"] = password_hash(
					$this->model->attributes["password"],
					PASSWORD_DEFAULT
				);
				$this->model->save("user");
				$this->model->session_user($this->model->attributes["email"]);
				redirect();
			}
		}
	}

	public function loginAction()
	{
		if (User::checkAuth()) {
			redirect(PATH);
		}

		if (!empty($_POST)) {
			if ($this->model->login()) {
				redirect(PATH . "/user/cabinet");
			} else {
				return false;
			}
		}
	}

	public function changeAction()
	{
		if (!User::checkAuth()) {
			redirect(PATH);
		}

		if (!empty($_POST)) {
			if ($this->model->change()) {
				$this->model->session_user($_SESSION["user"]["email"]);
				redirect(PATH . "/user/cabinet");
			} else {
				return false;
			}
		}
	}

	public function passwordAction()
	{
		if (!User::checkAuth()) {
			redirect(PATH);
		}

		if (!empty($_POST)) {
			if ($this->model->changePassword()) {
				redirect(PATH . "/user/cabinet");
			} else {
				return false;
			}
		}
	}

	public function logoutAction()
	{
		if (User::checkAuth()) {
			unset($_SESSION["user"]);
		}
		redirect(PATH);
	}

	public function cabinetAction()
	{
		if (!User::checkAuth()) {
			redirect();
		}
		$this->setMeta("Личный кабинет", "Description...", "Keywords...");
	}

	public function historyAction()
	{
		if (!User::checkAuth()) {
			redirect();
		}

		$orders = $this->model->get_orders($_SESSION["user"]["id"]);

		if (empty($orders)) {
			$orders = [];
			$order_products = [];
		} else {
			$ids = "";

			$counter = 1;
			$orders_length = count($orders);

			foreach ($orders as $order) {
				$ids .= $order["id"];
				if ($counter !== $orders_length) {
					$ids .= ",";
				}
				$counter += 1;
			}

			$order_products = $this->model->get_order_products($ids);
		}
		$products = $this->model->getRecomendation(4);

		$this->setMeta("История заказов", "Description...", "Keywords...");
		$this->set(compact("orders", "order_products", "products"));
	}
}
