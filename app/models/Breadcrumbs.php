<?php

namespace app\models;

use dns\App;

class Breadcrumbs extends AppModel
{
	public static function getBreadcrumbs($category_id, $name = ""): string
	{
		$categories = App::$app->getProperty("categories");
		$breadcrumbs_array = self::getParts($categories, $category_id);
		$counter = 0;
		$breadcrumbs =
			"<li><a href='" . PATH . "' itemprop='item'>Главная</a></li>";
		if ($breadcrumbs_array) {
			foreach ($breadcrumbs_array as $slug => $title) {
				if ($counter === 0) {
					$breadcrumbs .= "<li><a href='catalog-list/{$slug}' itemprop='item'>{$title}</a></li>";
				} else {
					$breadcrumbs .= "<li><a href='catalog/{$slug}' itemprop='item'>{$title}</a></li>";
				}
				$counter += 1;
			}
		}
		if ($name) {
			$breadcrumbs .= "<li><a href='#'>$name</a></li>";
		}
		return $breadcrumbs;
	}

	public static function getParts($cats, $id): array|false
	{
		if (!$id) {
			return false;
		}
		$breadcrumbs = [];
		foreach ($cats as $k => $v) {
			if (isset($cats[$id])) {
				$breadcrumbs[$cats[$id]["slug"]] = $cats[$id]["name"];
				$id = $cats[$id]["parent_id"];
			} else {
				break;
			}
		}
		return array_reverse($breadcrumbs, true);
	}
}
