<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
use wfm\App;
use wfm\Controller;

class AppController extends Controller
{
  public function __construct($route = [])
  {
    parent::__construct($route);
    new AppModel();

    App::$app->setProperty('languages', Language::getLanguages()); //запрос из БД массив доступных языков и запись в свойства приложения
    App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages'))); //определение текущего языка и запись в глобальные свойства

    $lang = App::$app->getProperty('language');
    \wfm\Language::load($lang['code'], $this->route);
  }
}

// public function indexAction()
// {
  // $this->layout = 'default';
  // $names = $this->model->get_names();
  // $this->setMeta('ISHOP', 'description...1212', 'keywords123');
  // $this->set(compact('names'));
// }