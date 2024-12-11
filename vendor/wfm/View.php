<?php

namespace wfm;

use RedBeanPHP\R;

class view
{

  public string $content = '';

  public function __construct(
    public $route = '',
    public $layout = '',
    public $view = '',
    public $meta = [],

  ) {
    if (false !== $this->layout) {
      $this->layout = $this->layout ?: LAYOUT;
    }
  }

  public function render($data)
  {
    if (is_array($data)) {
      extract($data); //если $data массив - то данный метод извлекает данные из массива и создает переменные по ключам
    }
    $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
    $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";


    if (is_file($view_file)) {
      ob_start(); //включается сбор данных буфером
      require_once $view_file;
      $this->content = ob_get_clean(); // данные из буфера перемещаются в свойство content, которое боступно в layout
    } else {
      throw new \Exception(" Not found {$view_file}", 500);
    }

    if (false !== $this->layout) {
      $layout_file = APP . "/views/layouts/{$this->layout}.php";
      if (is_file($layout_file)) {
        require_once $layout_file;
      } else {
        throw new \Exception("Layout {$layout_file} not found", 500);
      }
    }
  }

  public function getMeta()
  {
    $out = '<title>' . h($this->meta['title']) . '</title>' . PHP_EOL;
    $out .= '<meta name="description" content="' . h($this->meta['description']) . '">' . PHP_EOL;
    $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
    return $out;
  }

  public function getDbLogs()
  {
    if (DEBUG) {
      //получить объект логгера, который хранит информацию о выполненных SQL-запросах
      $logs = R::getDatabaseAdapter()
        ->getDatabase()
        ->getLogger();
      $logs = array_merge($logs->grep('SELECT'), $logs->grep('INSERT'), $logs->grep('UPDATE'), $logs->grep('DELETE'));
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
      echo "File {$file} not found...";
    }
  }
}
