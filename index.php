<?php

require_once "vendor/autoload.php";


$app = new \Kitty\App([
    'debug'   => true,
    'baseUrl' => '/mdwp',
    'controller.class_prefix'    => '\\Kitty\\Controller',
]);

// add routes
$app->addRoutes(array(
    '/'                     => 'Article:index',
    '/article/create'       => 'Article:create',
    '/article/admin'        => 'Article:admin',
    '/article/edit/:id'     => 'Article:edit',
    '/article/delete/:id'   => 'Article:delete',
    '/article/:id'          => 'Article:view',
    '/settings'             => 'Settings:general',
    '/login'                => 'Site:login',
    '/logout'               => 'Site:logout',
));


// add middleware for authentication
$app->add(new \Kitty\Middleware\Authentication([
    'loginUrl'  => $app->getBaseUrl() . '/login',
    'secured'   => [
        $app->getBaseUrl() . '/article/admin',
        $app->getBaseUrl() . '/article/create',
        $app->getBaseUrl() . '/article/delete/',
        $app->getBaseUrl() . '/article/edit/',
        $app->getBaseUrl() . '/settings',
    ]
]));


// 404
$app->notFound(function () use ($app) {
    $app->render('404');
});

$app->run();