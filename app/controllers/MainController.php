<?php

namespace app\controllers;

use wfm\Controller;

/** @property Main $model */
class MainController extends Controller
{

  public function indexAction()
  {
    // $this->layout = 'default';
    $names = $this->model->get_names();
    $this->setMeta('ISHOP', 'description...1212', 'keywords123');
    $this->set(compact('names'));
  }
}
