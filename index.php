<?php

require_once "vendor/autoload.php";


$app = new \Slim\Slim([
    'debug' => true
]);


$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

// default router
$app->get('/', function() {
    (new \Kitty\Controller\Post())->index();
});


$app->run();