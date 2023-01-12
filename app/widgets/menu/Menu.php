<?php

namespace app\widgets\menu;

use dns\App;
use dns\Cache;

class Menu
{
	protected $data;
	protected $tree;
	protected $menuHtml;
	protected $tpl;
	protected $container = "ul";
	protected $class = "menu";
	protected $cache = 3600;
	protected $cacheKey = "dns_menu";
	protected $attrs = [];
	protected $prepend = "";

	public function __construct($options = [])
	{
		$this->tpl = __DIR__ . "/menu_tpl.php";
		$this->getOptions($options);
		$this->run();
	}

	protected function getOptions($options)
	{
		foreach ($options as $k => $v) {
			if (property_exists($this, $k)) {
				$this->$k = $v;
			}
		}
	}

	protected function run()
	{
		$cache = Cache::getInstance();
		$this->menuHtml = $cache->get("{$this->cacheKey}");

		if (!$this->menuHtml) {
			//$this->data = R::getAssoc("SELECT * FROM category");
			$this->data = App::$app->getProperty("categories");
			$this->tree = $this->getTree();
			$this->menuHtml = $this->getMenuHtml($this->tree);
			if ($this->cache) {
				$cache->set("{$this->cacheKey}", $this->menuHtml, $this->cache);
			}
		}

		$this->output();
	}

	protected function output()
	{
		$attrs = "";
		if (!empty($this->attrs)) {
			foreach ($this->attrs as $k => $v) {
				$attrs .= " $k='$v' ";
			}
		}
		echo "<{$this->container} class='{$this->class}' $attrs>";
		echo $this->prepend;
		echo $this->menuHtml;
		echo "</{$this->container}>";
	}

	protected function getTree()
	{
		$tree = [];
		$data = $this->data;
		foreach ($data as $id => &$node) {
			if (!$node["parent_id"]) {
				$tree[$id] = &$node;
			} else {
				$data[$node["parent_id"]]["children"][$id] = &$node;
			}
		}
		return $tree;
	}

	protected function getMenuHtml($tree, $tab = "")
	{
		$str = "";
		foreach ($tree as $id => $category) {
			$str .= $this->catToTemplate($category, $tab, $id);
		}
		return $str;
	}

	protected function catToTemplate($category, $tab, $id)
	{
		ob_start();
		require $this->tpl;
		return ob_get_clean();
	}
}
