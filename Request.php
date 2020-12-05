<?php

namespace app\core;

class Request
{
  public function getPath() :string
  {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    $position = strpos($path, '?');


    if ($position === false) {
      return $path;
    }

    return substr($path, 0, $position);
  }

  public function method() :string
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function isGet() :string
  {
    return $this->method() === 'get';
  }

  public function isPost() :string
  {
    return $this->method() === 'post';
  }

  public function getBody() :array
  {
    $body = [];
    if ($this->method() == "get") {
      foreach (array_keys($_GET) as $key) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if ($this->method() == "post") {
      foreach (array_keys($_POST) as $key) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    return $body;
  }
}
