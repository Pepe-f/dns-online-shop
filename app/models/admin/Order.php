<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Order extends AppModel
{
	public function change_status($id, $status): bool
	{
		$status = ($status == 1) ? 1 : 0;
		R::begin();
		try {
			R::exec("UPDATE orders SET status = ? WHERE id = ?", [$status, $id]);
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function get_orders($start, $perpage, $status): array
	{
		if ($status) {
			return R::getAll(
				"SELECT * FROM orders WHERE $status ORDER BY id DESC LIMIT $start, $perpage"
			);
		} else {
			return R::getAll(
				"SELECT * FROM orders ORDER BY id DESC LIMIT $start, $perpage"
			);
		}
	}
	
	public function get_order($id): array
	{
		return R::getRow("SELECT * FROM orders WHERE id = ?", [$id]);
	}
	
	public function get_cart($id): array
	{
		return R::getAll("SELECT op.*, p.slug FROM order_products op JOIN product p ON op.product_id = p.id WHERE order_id = ?", [$id]);
	}
}