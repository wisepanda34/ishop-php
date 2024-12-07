<?php
define("DEBUG", 1); //1-dev, 0-production
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/wfm');
define("HELPERS", ROOT . '/vendor/wfm/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'ishop');
define("PATH", 'http://ishop-php');
define("ADMIN", 'http://ishop-php/admin');
define("NO_IMAGE", 'uploads/images/no_image.png');

require_once ROOT . '/vendor/autoload.php';
