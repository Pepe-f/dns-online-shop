<?php

namespace app\controllers\admin;

use dns\Cache;

class CacheController extends AppController
{
	public function indexAction()
	{
		$title = 'Управление кэшем';
		$this->setMeta($title);
		$this->set(compact('title'));
	}
	
	public function deleteAction()
	{
		$cache_key = get('cache', 's');
		$cache = Cache::getInstance();
		if ($cache_key == 'category') {
			$cache->delete("dns_menu");
		}
		if ($cache_key == 'page') {
			$cache->delete("dns_page_menu");
		}
		$_SESSION['success'] = 'Выбранный кэш удален';
		redirect();
	}
}