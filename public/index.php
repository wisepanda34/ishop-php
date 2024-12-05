<?php
if (PHP_MAJOR_VERSION < 8) {
  die("PHP version down 8");
}

require_once dirname(__DIR__) . '/config/init.php'; //файл init.php со всеми константами и автозагрузчик composer
require_once HELPERS . '/functions.php'; // функции хэлперы
require_once CONFIG . '/routes.php';

new \wfm\App();

// debug(\wfm\Router::getRoutes());
