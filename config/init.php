<?php

define("DEBUG", 0);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/dns");
define("HELPERS", ROOT . "/vendor/dns/helpers");
define("CACHE", ROOT . "/tmp/cache");
define("LOGS", ROOT . "/tmp/logs");
define("CONFIG", ROOT . "/config");
define("LAYOUT", "shop");
define("PATH", "http://dns-online-shop.loc");
define("ADMIN", "http://dns-online-shop.loc/admin");
define("NO_IMAGE", "/public/uploads/no_image.png");

require_once ROOT . "/vendor/autoload.php";
