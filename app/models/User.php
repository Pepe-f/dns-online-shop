<?php

namespace app\models;

use RedBeanPHP\R;

class User extends AppModel
{
	public array $attributes = [
		"name" => "",
		"email" => "",
		"phone" => "",
		"password" => ""
	];

	public static function checkAuth(): bool
	{
		return isset($_SESSION["user"]);
	}

	public function checkUnique(): bool
	{
		$user = R::findOne("user", "email = ?", [$this->attributes["email"]]);
		if ($user) {
			return false;
		}
		return true;
	}

	public function session_user($email)
	{
		$user = R::findOne("user", "email = ?", [$email]);
		if ($user) {
			foreach ($user as $k => $v) {
				if (!$k != "password") {
					$_SESSION["user"][$k] = $v;
				}
			}
		}
	}

	public function login(): bool
	{
		$email = post("email");
		$password = post("password");
		if ($email && $password) {
			$user = R::findOne("user", "email = ?", [$email]);
			if ($user) {
				if (password_verify($password, $user->password)) {
					foreach ($user as $k => $v) {
						if (!$k != "password") {
							$_SESSION["user"][$k] = $v;
						}
					}
					return true;
				}
			}
		}
		return false;
	}

	public function change(): bool
	{
		$id = $_SESSION["user"]["id"];

		$name = post("name");
		$phone = post("phone");
		$email = post("email");
		$location = post("location");

		$user = R::load("user", $id);
		$user->name = $name;
		$user->phone = $phone;
		$user->email = $email;
		$user->location = $location;
		R::store($user);

		return true;
	}

	public function changePassword(): bool
	{
		$id = $_SESSION["user"]["id"];

		$password = post("password");

		$user = R::load("user", $id);
		$user->password = password_hash($password, PASSWORD_DEFAULT);
		R::store($user);

		return true;
	}

	public function get_orders($user_id): array
	{
		return R::getAll(
			"SELECT o.*, dm.name AS delivery, dm.price, pm.name AS payment FROM orders o JOIN delivery_method dm ON o.delivery_method_id = dm.id JOIN payment_method pm ON o.payment_method_id = pm.id WHERE o.user_id = ?",
			[$user_id]
		);
	}

	public function get_order_products($ids): array
	{
		return R::getAll("SELECT * FROM order_products WHERE order_id IN ($ids)");
	}

	public function getRecomendation($limit): array
	{
		return R::getAll("SELECT * FROM product ORDER BY id DESC LIMIT $limit");
	}
}
