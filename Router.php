<?php

namespace edustef\mvcFrame;

use edustef\mvcFrame\exceptions\NotFoundException;
use edustef\mvcFrame\Application;

class Router
{
  /**
   * This stores an array of arrays with the format 
   */
  protected array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct(Request $request, Response $response)
  {
    $this->response = $response;
    $this->request = $request;
  }

  public function add($path, $callback)
  {
    $this->routes['/api' . $path] = $callback;
  }

  /**
   * and will create the controller and run it's method referenced by the callback.
   * @throws NotFoundException; 
   * @throws ForbiddenException;
   */
  public function resolve(): string
  {
    $path = $this->request->getPath();

    $callback = $this->routes[$path] ?? false;

    if ($callback === false) {
      throw new NotFoundException();
    }

    //create instance of controller
    if (is_array($callback)) {
      $controller = new $callback[0]();
      Application::$app->controller = $controller;
      $controller->action = $callback[1];
      $callback[0] = $controller;

      foreach ($controller->middlewares as $middleware) {
        $middleware[0]->execute($middleware[1]);
      }
    }

    return call_user_func($callback, $this->request, $this->response);
  }
}
