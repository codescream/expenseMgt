<?php

use App\Exceptions\RouteNotFoundException;
use App\View;

require __DIR__ . '/../vendor/autoload.php';

session_start();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

// $id = new \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';


$router = new App\Router();

// $router->register('/invoices', function() {
//   echo 'Invoices';
// });

// $router->register('/', [App\Controllers\Home::class, 'index']);

// $router->register('/invoices', [App\Controllers\Invoice::class, 'index']);

// $router->register('/invoices/create', [App\Controllers\Invoice::class, 'create']);

// $router
// ->register('/', [App\Controllers\Home::class, 'index'])
// ->register('/invoices', [App\Controllers\Invoice::class, 'index'])
// ->register('/invoices/create', [App\Controllers\Invoice::class, 'create']);
try {
  $router
    ->get('/', [App\Controllers\HomeController::class, 'index'])
    ->get('/', [App\Controllers\HomeController::class,'download'])
    ->post('/upload', [App\Controllers\HomeController::class, 'upload'])
    ->get('/invoices', [App\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [App\Controllers\InvoiceController::class, 'show'])
    ->post('/invoices/create', [App\Controllers\InvoiceController::class, 'create']);

  // echo '<pre>';
// print_r($router->routes());
// echo '</pre>';


  echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $e) {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");

  echo View::make("errors/404", "layout", ["errMessage" => $e->getMessage()]);
}
