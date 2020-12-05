<?php

namespace app\core;

class View
{
  public string $layout = 'main';
  public string $title = '';

  public function renderView($view, $params = []): string
  {
    $viewContent = $this->viewContent($view, $params);
    $layoutContent = $this->layoutContent();
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  private function layoutContent(): string
  {
    ob_start();
    include_once Application::$ROOT_DIR . 'views/layouts/' . $this->layout . '.php';
    return ob_get_clean();
  }

  private function viewContent($view, $params): string
  {
    // creates variables based on the key name and value
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once Application::$ROOT_DIR . 'views/' . $view . '.php';
    return ob_get_clean();
  }

  public function setLayout($layout)
  {
    $this->layout = $layout;
  }
}
