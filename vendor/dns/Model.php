<?php

namespace dns;

use RedBeanPHP\R;

abstract class Model
{
	public array $attributes = [];

	public function __construct()
	{
		Db::getInstance();
	}

	public function load($post = true)
	{
		$data = $post ? $_POST : $_GET;
		foreach ($this->attributes as $name => $value) {
			if (isset($data[$name])) {
				$this->attributes[$name] = $data[$name];
			}
		}
	}

	public function save($table): int|string
	{
		$tbl = R::dispense($table);
		foreach ($this->attributes as $name => $value) {
			if ($value != "") {
				$tbl->$name = $value;
			}
		}
		return R::store($tbl);
	}

	public function update($table, $id): int|string
	{
		$tbl = R::load($table, $id);
		foreach ($this->attributes as $name => $value) {
			if ($value != "") {
				$tbl->$name = $value;
			}
		}
		return R::store($tbl);
	}
}
