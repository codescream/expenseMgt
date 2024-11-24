<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router {
  private array $routes;

  public function register(string $requestMethod, string $route, array|callable $action): self {
    $this->routes[$requestMethod][$route] = $action;

    return $this;
  }

  public function get(string $route, array|callable $action): self {
    return $this->register('get', $route, $action);
  }

  public function post(string $route, array|callable $action): self {
    return $this->register('post', $route, $action);
  }

  public function routes(): array {
    return $this->routes;
  }

  public function resolve(string $route, string $requestMethod) {
    $route = explode("?", $route)[0];
    $action = $this->routes[strtolower($requestMethod)][$route] ?? null;

    if(! $action) {
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