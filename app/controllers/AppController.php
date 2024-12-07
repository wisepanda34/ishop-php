<?php

namespace app\controllers;

use wfm\Controller;

class AppController extends Controller
{
  public function __construct($route = [])
  {
    parent::__construct($route);
  }
}

// public function indexAction()
// {
  // $this->layout = 'default';
  // $names = $this->model->get_names();
  // $this->setMeta('ISHOP', 'description...1212', 'keywords123');
  // $this->set(compact('names'));
// }