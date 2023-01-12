<?php

namespace app\models\admin;

use RedBeanPHP\R;

class User extends \app\models\User
{
	public array $attributes = [
		"name" => "",
		"email" => "",
		"phone" => "",
		"password" => "",
		"location" => "",
		"role" => ""
	];

	public array $rules = [
		"required" => ["name", "email", "phone", "password", "role"],
		"email" => ["email"],
		"lengthMin" => [["password", 6]],
		"optional" => ["password"]
	];

	public array $labels = [
		"name" => "Имя",
		"email" => "E-mail",
		"phone" => "Телефон",
		"password" => "Пароль",
		"location" => "Адрес",
		"role" => "Роль"
	];

	public static function isAdmin(): bool
	{
		return isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin";
	}

	public function login($is_admin = false): bool
	{
		$email = post("email");
		$password = post("password");
		if ($email && $password) {
			if ($is_admin) {
				$user = R::findOne("user", "email = ? AND role = 'admin'", [$email]);
			} else {
				$user = R::findOne("user", "email = ?", [$email]);
			}

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

	public function change_user_role($id, $status): bool
	{
		$status = ($status == 'user') ? 'user' : 'admin';
		R::begin();
		try {
			R::exec("UPDATE user SET role = ? WHERE id = ?", [$status, $id]);
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}

	public function get_users($start, $perpage): array
	{
		return R::findAll("user", "LIMIT $start, $perpage");
	}

	public function get_user($id): array
	{
		return R::getRow("SELECT * FROM user WHERE id = ?", [$id]);
	}

	public function get_count_orders($user_id): int
	{
		return R::count('orders', 'user_id = ?', [$user_id]);
	}

	public function get_user_orders($start, $perpage, $user_id): array
	{
		return R::getAll("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT $start, $perpage", [$user_id]);
	}
}
