<?php


namespace Kitty\Controller;

use Kitty\App;
use Kitty\Controller;
use Kitty\EntityManager;
use Kitty\Model\User;
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
    public function adminAction()
    {
        $articles = $this->entityManager->getRepository('Kitty\Model\Article')->findAll();
        $this->render('article/admin', [
            'articles' => $articles
        ]);
    }


    /**
     * @return void
     */
    public function createAction()
    {
        $request = $this->app->request();

        if ($request->isPost())
        {
            /* @var App $app */
            $app = $this->app;

            $title   = $request->post('title');
            $content = $request->post('content');
            $date    = new \DateTime("now");
            $status  = \Kitty\Model\Article::STATUS_PUBLISHED;
            $type    = \Kitty\Model\Article::TYPE_NORMAL;

            $article = new \Kitty\Model\Article();
            $article->setContent($content);
            $article->setTitle($title);
            $article->setContent($content);
            $article->setDate($date);
            $article->setStatus($status);
            $article->setType($type);

            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $app->flash('success', 'Artikel wurde erstellt.');
            $this->redirect($app->getBaseUrl() . '/article/admin');
        }

        $this->render('article/create');
    }


    /**
     * @return void
     */
    public function indexAction() {
        // get posts
        $posts = $this->entityManager->getRepository('Kitty\Model\Article')->findBy([
            'status' => \Kitty\Model\Article::STATUS_PUBLISHED,
            'type'   => \Kitty\Model\Article::TYPE_NORMAL
        ], ['id' => 'DESC']);

        // render index
        $this->render('article/index', [
            'posts' => $posts
        ]);

        $user = new User();
        $user->setUsername('peter');
        $user->setPassword('password');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }


    /**
     * @param int $id
     */
    public function viewAction($id) {
        // get post
        $post = $this->entityManager->find('Kitty\Model\Article', $id);

        if ($post == null)
        {
            $this->app->notFound();
        }

        $this->render('article/view', [
            'post' => $post
        ]);
    }

}