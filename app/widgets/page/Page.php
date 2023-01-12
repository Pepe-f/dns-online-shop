<?php

namespace app\widgets\page;

use RedBeanPHP\R;
use dns\App;
use dns\Cache;

class Page
{
	protected string $container = "ul";
	protected string $class = "page-menu";
	protected int $cache = 3600;
	protected string $cacheKey = "dns_page_menu";
	protected string $menuPageHtml;
	protected string $prepend = "";
	protected $data;

	public function __construct($options = [])
	{
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
		$this->menuPageHtml = $cache->get("{$this->cacheKey}");

		if (!$this->menuPageHtml) {
			$this->data = R::getAssoc("SELECT * FROM page");
			$this->menuPageHtml = $this->getMenuPageHtml();
			if ($this->cache) {
				$cache->set("{$this->cacheKey}", $this->menuPageHtml, $this->cache);
			}
		}

		$this->output();
	}

	protected function getMenuPageHtml()
	{
		$html = "";
		foreach ($this->data as $k => $v) {
			$html .= "<li><a href='page/{$v["slug"]}'>{$v["title"]}</a></li>";
		}
		return $html;
	}

	protected function output()
	{
		echo "<{$this->container} class='{$this->class}'>";
		echo $this->prepend;
		echo $this->menuPageHtml;
		echo "</{$this->container}>";
	}
}
