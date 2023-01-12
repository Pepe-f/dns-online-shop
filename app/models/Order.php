<?php

namespace app\models;

use RedBeanPHP\R;

class Order extends AppModel
{
	public static function saveOrder($data): int|false
	{
		R::begin();
		try {
			$order = R::dispense("orders");
			$order->user_id = $_SESSION["user"]["id"];
			$order->city = $data["city"];
			$order->address = $data["address"];
			$order->note = $data["note"];
			$order->comment = $data["comment"];
			$order->delivery_method_id = $data["delivery_method_id"];
			$order->payment_method_id = $data["payment_method_id"];
			$order->total = $_SESSION["cart.sum"];
			$order->qty = $_SESSION["cart.qty"];
			$order_id = R::store($order);
			self::saveOrderProduct($order_id, $_SESSION["user"]["id"]);

			R::commit();

			$_SESSION["last"] = $order_id;

			return $order_id;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}

	public static function saveOrderProduct($order_id, $user_id): void
	{
		$sql_part = "";
		$binds = [];
		foreach ($_SESSION["cart"] as $product_id => $product) {
			$sum = $product["qty"] * $product["price"];
			$sql_part .= "(?,?,?,?,?,?,?,?),";
			$binds = array_merge($binds, [
				$order_id,
				$product_id,
				$product["name"],
				$product["article"],
				$product["img"],
				$product["price"],
				$product["qty"],
				$sum
			]);

			$findProduct = R::getRow("SELECT * FROM product WHERE id = ?", [$product_id]);
			$qty = $findProduct["qty"] - $product["qty"];
			R::exec("UPDATE product SET qty = ? WHERE id = ?", [$qty, $product_id]);
		}
		$sql_part = rtrim($sql_part, ",");
		R::exec(
			"INSERT INTO order_products (order_id, product_id, name, article, img, price, qty, sum) VALUES $sql_part",
			$binds
		);
	}
}
