<?php

namespace edustef\mvcFrame;

class Response
{
  public function setStatusCode(int $code)
  {
    http_response_code($code);
  }

  public function redirect(string $path)
  {
    header('Location: ' . $path);
  }

  public function json($data, $statusCode = 200)
  {
    header('Content-Type: application/json');
    $this->setStatusCode($statusCode);
    return json_encode($data);
  }
}
