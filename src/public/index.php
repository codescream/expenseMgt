<?php

require __DIR__ . '/../vendor/autoload.php';

// $id = new \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
 

$router = new App\Router();

// $router->register('/invoices', function() {
//   echo 'Invoices';
// });

// $router->register('/', [App\Classes\Home::class, 'index']);

// $router->register('/', [App\Classes\Invoice::class, 'index']);

// $router->register('/', [App\Classes\Invoice::class, 'create']);

$router
->register('/', [App\Classes\Home::class, 'index'])
->register('/invoices', [App\Classes\Invoice::class, 'index'])
->register('/invoices/create', [App\Classes\Invoice::class, 'create']);

echo $router->resolve($_SERVER['REQUEST_URI']);