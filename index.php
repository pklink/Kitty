<?php

require_once "vendor/autoload.php";


$app = new \Kitty\App([
    'debug'   => true,
    'baseUrl' => '/mdwp'
]);


$app->get('/article/:id', function ($id) use ($app) {
    (new \Kitty\Controller\Post($app))->view($id);
});

// default router
$app->get('/', function() use ($app) {
    (new \Kitty\Controller\Post($app))->index();
});


// 404
$app->notFound(function () use ($app) {
    $app->render('404');
});

$app->run();