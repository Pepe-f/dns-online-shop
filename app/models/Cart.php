<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{
	public function get_product($id): array
	{
		return R::getRow("SELECT * FROM product WHERE id = ?", [$id]);
	}

	public function add_to_cart($product, $qty = 1)
	{
		//$qty = abs($qty);

		$_SESSION["cart"][$product["id"]] = [
			"id" => $product["id"],
			"slug" => $product["slug"],
			"name" => $product["name"],
			"article" => $product["article"],
			"img" => $product["img"],
			"price" => $product["price"],
			"qty" => $qty
		];

		$_SESSION["cart.qty"] = !empty($_SESSION["cart.qty"])
			? $_SESSION["cart.qty"] + $qty
			: $qty;
		$_SESSION["cart.sum"] = !empty($_SESSION["cart.sum"])
			? $_SESSION["cart.sum"] + $qty * $product["price"]
			: $qty * $product["price"];

		return true;
	}

	public function change_item_qty($id, $qty): bool
	{
		$product = R::getRow("SELECT * FROM product WHERE id = ?", [$id]);

		if ($product["qty"] < $qty) {
			return false;
		}

		$_SESSION["cart"][$id]["qty"] = $qty;
		$_SESSION["cart.qty"] = 0;
		$_SESSION["cart.sum"] = 0;

		foreach ($_SESSION["cart"] as $product) {
			$_SESSION["cart.qty"] += $product["qty"];
			$_SESSION["cart.sum"] += $product["price"] * $product["qty"];
		}

		return true;
	}

	public function delete_item($id)
	{
		$qty_minus = $_SESSION["cart"][$id]["qty"];
		$sum_minus =
			$_SESSION["cart"][$id]["qty"] * $_SESSION["cart"][$id]["price"];
		$_SESSION["cart.qty"] -= $qty_minus;
		$_SESSION["cart.sum"] -= $sum_minus;
		unset($_SESSION["cart"][$id]);
	}

	public function get_payment_methods(): array
	{
		return R::getAll("SELECT * FROM payment_method");
	}

	public function get_delivery_methods(): array
	{
		return R::getAll("SELECT * FROM delivery_method");
	}

	public function getRecomendation($limit): array
	{
		return R::getAll("SELECT * FROM product ORDER BY id DESC LIMIT $limit");
	}
}
