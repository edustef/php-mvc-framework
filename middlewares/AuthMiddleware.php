<?php

namespace edustef\mvcFrame\middlewares;

use edustef\mvcFrame\Application;
use edustef\mvcFrame\exceptions\ForbiddenException;

class AuthMiddleware extends Middleware
{

  public array $actions;

  public function __construct(array $actions = [])
  {
    $this->actions = $actions;
  }

  public function execute()
  {
    if (Application::isGuest()) {
      if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
        throw new ForbiddenException();
      }
    }
  }
}
