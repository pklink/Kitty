<?php

require_once "vendor/autoload.php";


$app = new \Kitty\App([
    'debug'   => true,
    'baseUrl' => '/mdwp',
    'controller.class_prefix'    => '\\Kitty\\Controller',
]);


$app->add(new \Kitty\Middleware\Authentication([
    'loginUrl'  => $app->getBaseUrl() . '/login',
    'secure'    => $app->getBaseUrl() . '/admin'
]));


$app->addRoutes(array(
    '/'            => 'Post:index',
    '/article/:id' => 'Post:view',
    '/login'       => 'Site:login',
    '/logout'      => 'Site:logout'
));


// 404
$app->notFound(function () use ($app) {
    $app->render('404');
});

$app->run();