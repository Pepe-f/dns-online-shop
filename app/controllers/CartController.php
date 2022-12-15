<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;

/** @property Cart $model */
class CartController extends AppController
{
	public function addAction(): bool
	{
		$id = get("id");
		$qty = get("qty");

		if (!$id) {
			return false;
		}

		$product = $this->model->get_product($id);
		if (!$product) {
			return false;
		}

		$this->model->add_to_cart($product, $qty);
		if ($this->isAjax()) {
			$this->loadView("view");
		}

		redirect();
		return true;
	}

	public function showAction()
	{
		$this->loadView("view");
	}

	public function deleteAction()
	{
		$id = get("id");
		if (isset($_SESSION["cart"][$id])) {
			$this->model->delete_item($id);
		}
		if ($this->isAjax()) {
			$this->loadView("view");
		}
		redirect();
	}

	public function qtyAction()
	{
		$id = get("id");
		$qty = get("qty");

		if (isset($_SESSION["cart"][$id])) {
			if (!$this->model->change_item_qty($id, $qty)) {
				return false;
			}
		}

		if ($this->isAjax()) {
			$this->loadView("view");
		}

		redirect();
	}

	public function dataAction()
	{
		if (isset($_SESSION["cart.qty"]) && isset($_SESSION["cart.sum"])) {
			$answer = [
				"qty" => $_SESSION["cart.qty"],
				"sum" => $_SESSION["cart.sum"]
			];
		}
		exit(json_encode($answer));
	}

	public function checkoutAction()
	{
		if (!isset($_SESSION["cart"])) {
			return false;
		}

		if (!empty($_POST)) {
			$data["city"] = post("city");
			$data["address"] = post("address");
			$data["note"] = post("note");
			$data["comment"] = post("comment");
			$data["delivery_method_id"] = post("delivery_method");
			$data["payment_method_id"] = post("payment_method");

			if (!($order_id = Order::saveOrder($data))) {
				return false;
			} else {
				unset($_SESSION["cart"]);
				unset($_SESSION["cart.sum"]);
				unset($_SESSION["cart.qty"]);
			}
		} else {
			return false;
		}

		redirect();
	}

	public function orderingAction()
	{
		if (!isset($_SESSION["cart"]) || !isset($_SESSION["user"])) {
			redirect(PATH . "/cart");
		}

		$paymentMethods = $this->model->get_payment_methods();
		$deliveryMethods = $this->model->get_delivery_methods();
		$products = $_SESSION["cart"];

		$this->set(compact("paymentMethods", "deliveryMethods", "products"));
		$this->setMeta("Оформление заказа", "Description...", "Keywords...");
	}

	public function successAction()
	{
		if (!isset($_SESSION["last"])) {
			redirect(PATH);
		}

		$this->setMeta("Заказ успешно оформлен", "Description...", "Keywords...");
	}

	public function viewAction()
	{
		$products = $this->model->getRecomendation(4);

		$this->set(compact("products"));
		$this->setMeta("Корзина", "Description...", "Keywords");
	}
}
