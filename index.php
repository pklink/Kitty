<?php

require_once "vendor/autoload.php";


// get EntityManager
$em = \Kitty\EntityManager::instance();

// get posts
$posts = $em->createQuery('SELECT p FROM Kitty\Model\Post p WHERE p.type = ?1 AND p.status = ?2 ORDER BY p.id DESC');
$posts->setParameter(1, 'post');
$posts->setParameter(2, 'publish');

// render index
echo \Kitty\Twig::instance()->render('index.twig', [
    'posts' => $posts->getResult(),
]);