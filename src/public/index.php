<?php

require __DIR__ . '/../vendor/autoload.php';

$id = new \Ramsey\Uuid\UuidFactory();

echo $id->uuid4();


// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';