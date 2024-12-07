<?php

namespace app\models;

use RedBeanPHP\R;
use \wfm\Model;

class AppModel extends Model
{

  public function get_names(): array
  {
    return R::findAll('names');
    // return [];
  }
}
