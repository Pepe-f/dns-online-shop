<?php

namespace dns;

abstract class Model
{
	public array $attributes = [];
	public array $errors = [];
	public array $rules = [];
	public array $labels = [];

	public function __construct()
	{
		Db::getInstance();
	}
}
