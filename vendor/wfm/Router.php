<?php

namespace wfm;

class Router
{
  protected static array $routes = [];
  protected static array $route = [];

  public static function add($regexp, $route = [])
  {
    self::$routes[$regexp] = $route;
  }

  public static function getRoutes(): array
  {
    return self::$routes;
  }

  public static function getRoute(): array
  {
    return self::$route;
  }

  public static function removeQueryString($url)
  {
    if ($url) {
      $params = explode('?', $url, 2); //делим строку $url по символу ? на 2 части
      if (false === str_contains($params[0], '=')) {
        return rtrim($params[0], '/');
      }
      return '';
    }
  }

  public static function dispatch($url) //Функция dispatch предназначена для маршрутизации запросов в приложении
  {
    $url = self::removeQueryString($url);

    if (self::matchRoute($url)) {
      // debug(self::$route);
      if (!empty(self::$route['lang'])) {
        App::$app->setProperty('lang', self::$route['lang']); //передача lang из массива роута в глобальный массив App::$app
      }
      $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
      if (class_exists($controller)) {
        // /**@var Controller $controllerObject */
        $controllerObject = new $controller(self::$route);

        $controllerObject->getModel();

        $action = self::lowerCamelCase(self::$route['action'] . 'Action');

        if (method_exists($controllerObject, $action)) {
          $controllerObject->$action();
          $controllerObject->getView();
        } else {
          throw new \Exception("Action {$action} inside {$controller} not found", 404);
        }
      } else {
        throw new \Exception("Controller {$controller} not found", 404);
      }
    } else {
      throw new \Exception("The page not found", 404);
    }
  }

  public static function matchRoute($url): bool   //сравнивает поступивший url с описанными шаблонами в routes.php и находит совпадение
  {
    foreach (self::$routes as $pattern => $route) {
      if (preg_match("#{$pattern}#", $url, $matches)) { //поиск соответствий регулярных выражений в строках
        foreach ($matches as $k => $v) {
          if (is_string($k)) {
            $route[$k] = $v;
          }
        }
        if (empty($route['action'])) {
          $route['action'] = 'index';
        }
        if (!isset($route['admin_prefix'])) {
          $route['admin_prefix'] = '';
        } else {
          $route['admin_prefix'] .= '\\';
        }

        $route['controller'] = self::upperCamelCase($route['controller']);
        // debug($route);
        self::$route = $route;
        return true;
      }
    }
    return false;
  }

  protected static function upperCamelCase($name): string //преобразование формата new-product => NewProduct
  {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
  }

  protected static function lowerCamelCase($name): string //преобразование формата new-product => newProduct
  {
    return lcfirst(self::upperCamelCase($name));
  }
}
