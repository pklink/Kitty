<?php

require_once "vendor/autoload.php";


$app = new \Kitty\App([
    'debug'   => true,
    'baseUrl' => '/mdwp',
    'controller.class_prefix'    => '\\Kitty\\Controller',
]);


$app->add(new \Kitty\Middleware\Authentication([
    'loginUrl'  => $app->getBaseUrl() . '/login',
    'secured'   => [
        $app->getBaseUrl() . '/admin',
        $app->getBaseUrl() . '/article/create',
    ]
]));


$app->addRoutes(array(
    '/'                => 'Article:index',
    '/article/create'  => 'Article:create',
    '/article/:id'     => 'Article:view',
    '/login'           => 'Site:login',
    '/logout'          => 'Site:logout',
    '/admin'           => 'Admin:index',
    '/admin/dashboard' => 'Admin:dashboard',
));


// 404
$app->notFound(function () use ($app) {
    $app->render('404');
});

$app->run();