<?php

namespace app\core;

use app\core\middlewares\Middleware;

class Controller
{
  public array $middlewares = [];
  public string $action = '';

  public function render($view, $params = [])
  {
    return Application::$app->view->renderView($view, $params);
  }

  public function registerMiddleware(Middleware $middleware)
  {
    $this->middlewares[] = $middleware;
  }
}