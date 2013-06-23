<?php

require_once "vendor/autoload.php";

$post = \Kitty\EntityManager::instance()->find('Kitty\Model\Post', 793);
//var_dump($post->getTitle());

echo \Kitty\Twig::instance()->render('index.twig');

