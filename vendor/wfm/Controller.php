<?php

namespace wfm;

abstract class Controller // базовый абстрактный класс (принимающий роут), от которого наследуются другие классы
{

  public array $data = []; // это данные из модели для загрузки в вид
  public array $meta = [];
  public false|string $layout = '';
  public string $view = '';
  public object $model;

  public function __construct(public $route = [])
  {
    // debug($route);
  }

  public function getModel()
  {
    $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
    if (class_exists($model)) {
      $this->model = new $model();
    }
  }

  public function getView()
  {
    $this->view = $this->view ?: $this->route['action'];
    (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
  }

  public function set($data)
  {
    $this->data = $data;
    // debug($data);
  }

  public function setMeta($title = '', $description = '', $keywords = '')
  {
    $this->meta = [
      'title' => $title,
      'description' => $description,
      'keywords' => $keywords
    ];
    // debug($this->meta);
  }
}
