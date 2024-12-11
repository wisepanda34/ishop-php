<?php
// в главном классе приложения будет запускаться маршрутизация (mvc - module, view, contriller)
// и создаваться контейнер зависимостей (хранилище для данных приложения ) для нашего приложения - паттерн Реестр 
// класс App инициализирует и настраивает параметры приложения через контейнер зависимостей Registry.php и паттерн Singleton.

namespace wfm;

class App
{
  // к статическому свойству можно обращаться через оператор ::
  public static $app;

  public function __construct()
  {
    $query = trim(urldecode($_SERVER['REQUEST_URI']), '/');
    // debug($query);
    new ErrorHandler();
    self::$app = Registry::getInstance();
    $this->getParams();
    Router::dispatch($query);
  }

  protected function getParams()
  {
    $params = require_once CONFIG . '/params.php';
    if (!empty($params)) {
      foreach ($params as $k => $v) {
        self::$app->setProperty($k, $v);
      }
    }
  }
}
