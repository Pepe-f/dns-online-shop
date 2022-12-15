<?php

namespace dns;

use RedBeanPHP\R;

class View
{
	public string $content = "";

	public function __construct(
		public $route,
		public $layout = "",
		public $view = "",
		public $meta = []
	) {
		if (false !== $this->layout) {
			$this->layout = $this->layout ?: LAYOUT;
		}
	}

	public function render($data)
	{
		if (is_array($data)) {
			extract($data);
		}
		$prefix = str_replace("\\", "/", $this->route["admin_prefix"]);
		$viewFile =
			APP . "/views/{$prefix}{$this->route["controller"]}/{$this->view}.php";
		if (is_file($viewFile)) {
			ob_start();
			require_once $viewFile;
			$this->content = ob_get_clean();
		} else {
			throw new \Exception("Не найден view {$viewFile}", 500);
		}

		if (false !== $this->layout) {
			$layoutFile = APP . "/views/layouts/{$this->layout}.php";
			if (is_file($layoutFile)) {
				require_once $layoutFile;
			} else {
				throw new \Exception("Не найден layout {$layoutFile}", 500);
			}
		}
	}

	public function getMeta()
	{
		$out =
			"<title>" .
			App::$app->getProperty("site_name") .
			" | " .
			h($this->meta["title"]) .
			"</title>" .
			PHP_EOL;
		$out .=
			'<meta name="description" content="' .
			h($this->meta["description"]) .
			'">' .
			PHP_EOL;
		$out .=
			'<meta name="keywords" content="' .
			h($this->meta["keywords"]) .
			'">' .
			PHP_EOL;
		return $out;
	}

	public function getDbLogs()
	{
		if (DEBUG) {
			$logs = R::getDatabaseAdapter()
				->getDatabase()
				->getLogger();
			$logs = array_merge(
				$logs->grep("SELECT"),
				$logs->grep("INSERT"),
				$logs->grep("UPDATE"),
				$logs->grep("DELETE")
			);
			debug($logs);
		}
	}

	public function getPart($file, $data = null)
	{
		if (is_array($data)) {
			extract($data);
		}
		$file = APP . "/views/{$file}.php";
		if (is_file($file)) {
			require $file;
		} else {
			echo "Файл {$file} не найден";
		}
	}
}
