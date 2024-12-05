<?php

namespace wfm;

use RedBeanPHP\R;

class Db
{

  use TSingleton;

  private function __construct()
  {
    $db = require_once CONFIG . '/config_db.php';
    R::setup($db['dsn'], $db['user'], $db['password']);
    if (!R::testConnection()) {
      throw new \Exception('No connection to DB', 500);
    }
    R::freeze(true); //"замораживание" схемы базы данных, т.е. фиксация структуры таблицы 
    if (DEBUG) {
      R::debug(true, 3); //режим дебагинга - выводит на экран все SQL-запросы
    }
  }
}
