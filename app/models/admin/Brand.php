<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Brand extends AppModel
{
	public function brand_validate(): bool
	{
		$errors = '';
		$item = $_POST['brand'];
		$item['name'] = trim($item['name']);
		if (empty($item['name'])) {
			$errors .= "Не заполнено Наименование<br>";
		}
		if ($errors) {
			$_SESSION['errors'] = $errors;
			$_SESSION['form_data'] = $_POST;
			return false;
		}
		
		return true;
	}
	
	public function save_brand(): bool
	{
		R::begin();
		try {
			$brand = R::dispense('brand');
			
			$brand->name = $_POST['brand']['name'];
			R::store($brand);
			
			R::commit();
			
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function update_brand($id): bool
	{
		R::begin();
		try {
			$brand = R::load('brand', $id);
			
			if (!$brand) {
				return false;
			}
			
			$brand->name = $_POST['brand']['name'];
			R::store($brand);
			
			R::commit();
			return true;
		} catch (\Exception $e) {
			R::rollback();
			return false;
		}
	}
	
	public function get_brands(): array
	{
		return R::getAll("SELECT * FROM brand");
	}
	
	public function get_brand($id): array
	{
		return R::getRow("SELECT * FROM brand WHERE id = ?", [$id]);
	}
}