<?php


namespace Kitty\Controller;

use Kitty\EntityManager;
use Kitty\Twig;

/**
 * Class Post
 *
 * @package Kitty\Controller
 */
class Post {

    /**
     * @var EntityManager
     */
    protected $enitityManager;

    /**
     * @return Post
     */
    public function __construct() {
        $this->enitityManager = EntityManager::instance();
    }


    /**
     * @return void
     */
    public function index() {
        // get posts
        $posts = $this->enitityManager->createQuery('SELECT p FROM Kitty\Model\Post p WHERE p.type = ?1 AND p.status = ?2 ORDER BY p.id DESC');
        $posts->setParameter(1, 'post');
        $posts->setParameter(2, 'publish');

        // render index
        echo Twig::instance()->render('index.twig', [
            'posts' => $posts->getResult(),
        ]);
    }

}