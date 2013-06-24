<?php


namespace Kitty\Controller;

use Kitty\Controller;
use Kitty\EntityManager;
use Kitty\Twig;

/**
 * Class Post
 *
 * @package Kitty\Controller
 */
class Post extends Controller {

    /**
     * @return void
     */
    public function index() {
        // get posts
        $posts = $this->enitityManager->createQuery('SELECT p FROM Kitty\Model\Post p WHERE p.type = ?1 AND p.status = ?2 ORDER BY p.id DESC');
        $posts->setParameter(1, 'post');
        $posts->setParameter(2, 'publish');

        // render index
        $this->app->render('post/index', [
            'posts' => $posts->getResult()
        ]);
    }


    /**
     * @param int $id
     */
    public function view($id) {
        // get post
        $post = $this->enitityManager->find('Kitty\Model\Post', $id);

        $this->app->render('post/view', [
            'post' => $post
        ]);
    }

}