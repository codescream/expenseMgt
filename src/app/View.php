<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
  public function __construct(protected string $viewPath, protected string $layoutPath, protected array $params = [])
  {
  }

  public static function make(string $viewPath, string $layoutPath = "", array $params = []): View
  {
    return new static($viewPath, $layoutPath, $params);
  }

  public function render(string $layout = null): string
  {
    // $params = $this->params; //makes the params array available to any script included || can be referred by $params['foo']

    // extract($this->params); // converts the array to variables with the key being the variable name e.g $foo

    foreach ($this->params as $key => $value) {
      $$key = $value;
    }


    $layoutPath = $layout ? VIEW_PATH . '/' . $layout . '.php' : '';
    $view = VIEW_PATH . '/' . $this->viewPath . '.php';
    ob_start();
    include $view;
    $viewContent = ob_get_clean();

    if (!file_exists($view)) {
      throw new ViewNotFoundException();
    }
    
    if (file_exists($layoutPath)) {
      ob_start();
      include $layoutPath;
      $content = ob_get_clean();

      $layoutContent = str_replace("{{content}}", $viewContent, $content);
    } 
    
    return $layoutContent;
  }

  public function __tostring(): string
  {
    return $this->render($this->layoutPath ?? '');
  }

  public function __get(string $name) {
    return $this->params[$name] ?? null; // array values can be accessed in any included file by $this->foo
  }
}