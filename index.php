<?php

require_once "vendor/autoload.php";


$app = new \Kitty\App([
    'debug'   => true,
    'baseUrl' => '/mdwp',
    'controller.class_prefix'    => '\\Kitty\\Controller',
]);


$app->addRoutes(array(
    '/'            => 'Post:index',
    '/article/:id' => 'Post:view',
));


// 404
$app->notFound(function () use ($app) {
    $app->render('404');
});

$app->run();