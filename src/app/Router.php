<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router {
  private array $routes;

  public function register(string $route, array $action): self {
    $this->routes[$route] = $action;

    return $this;
  }

  public function resolve(string $route) {
    $route = explode("?", $route)[0];
    $action = $this->routes[$route] ?? null;

    if( ! $action) {
      throw new RouteNotFoundException();
    }

    if(is_array( $action )) {
      [$class, $method] = $action;

      if(class_exists( $class )) {
        $class = new $class();

        if(method_exists($class, $method)) {
          return call_user_func([$class, $method], []);
        }
      }
    }

    throw new RouteNotFoundException();
  }
}