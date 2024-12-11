<?php


function debug($data, $die = false)
{
  echo '<pre>';

  // Определяем тип данных и выводим соответствующим образом
  if (is_array($data)) {
    // Для массивов и объектов используем var_dump для более подробного вывода
    print_r($data);
  } elseif (is_object($data)) {
    var_dump($data);
  } else {
    // Для строк, чисел и других типов выводим через echo
    echo $data;
  }

  echo '</pre>';

  if ($die) {
    die; // Завершаем выполнение, если $die true
  }
}


function h($str)
{
  return htmlspecialchars($str);
}

function redirect($http = false)
{
  if ($http) {
    $redirect = $http;
  } else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
  }
  header("location: $redirect");
  die;
}

function base_url()
{
  return PATH . '/' . (\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}

/** 
 * @param string $key Имя ключа массива $_GET.
 * @param string $type Тип данных ('i' — int, 'f' — float, 's' — string)
 * @return float|init|string Значение параметра с приведением к типу.
 */
function get($key, $type = 'i')
{
  $param = $_GET[$key] ?? ''; // Получаем значение из массива $_GET
  if ($type == 'i') {
    return (int)$param; // Приводим к целому числу
  } elseif ($type == 'f') {
    return (float)$param; // Приводим к числу с плавающей точкой
  } else {
    return trim($param); // Удаляем пробелы по краям и возвращаем строку
  }
}

/** 
 * @param string $key Имя ключа массива $_POST
 * @param string $type Тип данных ('i' — int, 'f' — float, 's' — string)
 * @return float|init|string Значение параметра с приведением к типу.
 */
function post($key, $type = 'i')
{
  $param = $_POST[$key] ?? '';
  if ($type == 'i') {
    return (int)$param;
  } elseif ($type == 'f') {
    return (float)$param;
  } else {
    return trim($param);
  }
}

function __($key)
{
  echo \wfm\Language::get($key);
}

function ___($key)
{
  return \wfm\Language::get($key);
}
