<?php

namespace app\controllers;

use RedBeanPHP\R;
use app\models\Main;
// use app\controllers\AppController;
use wfm\Controller;

/** @property Main $model */
class MainController extends AppController
{
  public function indexAction()
  {
    $slides = R::findAll('slider');
    $products = $this->model->get_hits(1, 6);
    $this->set(compact('slides', 'products'));
  }
}


  // public function indexAction()
  // {
    // $this->layout = 'default';
    // $names = $this->model->get_names();
    // $this->setMeta('ISHOP', 'description...1212', 'keywords123');
    // $this->set(compact('names'));
  // }