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
class Article extends Controller
{

    /**
     * @return void
     */
    public function createAction()
    {
        $request = $this->app->request();

        if ($request->isPost())
        {
            $title   = $request->post('title');
            $content = $request->post('content');
            $date    = date('Y-m-d H:i:s');
            $status  = 'published';
            $type    = 'normal';

            $article = new \Kitty\Model\Article();
            $article->setContent($content);
            $article->setTitle($title);
            $article->setContent($content);
            $article->setDate($date);
            $article->setStatus($status);
            $article->setType($type);

            $this->enitityManager->persist($article);
            $this->enitityManager->flush();
        }

        $this->render('article/create');
    }


    /**
     * @return void
     */
    public function indexAction() {
        // get posts
        $posts = $this->enitityManager->createQuery('SELECT p FROM Kitty\Model\Post p WHERE p.type = ?1 AND p.status = ?2 ORDER BY p.id DESC');
        $posts->setParameter(1, 'post');
        $posts->setParameter(2, 'publish');

        // render index
        $this->render('article/index', [
            'posts' => $posts->getResult()
        ]);
    }


    /**
     * @param int $id
     */
    public function viewAction($id) {
        // get post
        $post = $this->enitityManager->find('Kitty\Model\Post', $id);

        $this->render('article/view', [
            'post' => $post
        ]);
    }

}