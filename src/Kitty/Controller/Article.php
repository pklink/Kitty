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
        // get all articles
        $articles = $this->entityManager->getRepository('Kitty\Model\Article')->findAll();

        // set head-title
        $this->setHeadArgument('title', 'Artikel erstellen');

        // render view
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
        $model   = new \Kitty\Model\Article();

        if ($request->isPost())
        {
            /* @var App $app */
            $app = $this->app;

            $model->setTitle($request->post('title'));
            $model->setContent($request->post('content'));
            $model->setDate(new \DateTime('now'));
            $model->setStatus($request->post('status'));
            $model->setType($request->post('type'));

            $this->entityManager->persist($model);
            $this->entityManager->flush();

            $app->flash('success', 'Artikel wurde erstellt.');
            $this->redirect($app->getBaseUrl() . '/article/admin');
        }

        // set head-title
        $this->setHeadArgument('title', 'Artikel erstellen');

        // render view
        $this->render('article/create', [
            'model' => $model
        ]);
    }


    /**
     * @param int $id
     * @return \Kitty\Model\Article
     */
    protected function getModel($id)
    {
        // get post
        $model = $this->entityManager->find('Kitty\Model\Article', $id);

        if ($model == null)
        {
            $this->app->notFound();
        }

        return $model;
    }


    /**
     * @param int $id
     */
    public function editAction($id)
    {
        /* @var App $app */
        $app     = $this->app;
        $request = $app->request();
        $model   = $this->getModel($id);

        // form was submitted
        if ($request->isPost())
        {
            // set attributes to model
            $model->setTitle($request->post('title'));
            $model->setContent($request->post('content'));
            $model->setType($request->post('type'));
            $model->setStatus($request->post('status'));

            // save model
            $this->entityManager->persist($model);
            $this->entityManager->flush();

            $app->flash('success', 'Artikel wurde aktualisiert.');
            $app->redirect($app->getBaseUrl() . '/article/admin');
        }

        // set head-title
        $this->setHeadArgument('title', 'Artikel bearbeiten');

        // render view
        $this->render('article/edit', [
            'model' => $model
        ]);
    }


    /**
     * @param int $id
     */
    public function deleteAction($id)
    {
        // get post
        $model = $this->getModel($id);

        $this->entityManager->remove($model);
        $this->entityManager->flush();

        /* @var App $app; */
        $app = $this->app;
        $app->flash('success', 'Artikel wurde gelöscht');
        $app->redirect($app->getBaseUrl() . '/article/admin');
    }


    /**
     * @return void
     */
    public function indexAction() {
        // get posts
        $models = $this->entityManager->getRepository('Kitty\Model\Article')->findBy([
            'status' => \Kitty\Model\Article::STATUS_PUBLISHED,
            'type'   => \Kitty\Model\Article::TYPE_NORMAL
        ], ['id' => 'DESC']);

        // set head-title
        $this->setHeadArgument('title', 'Artikelübersicht');

        // render index
        $this->render('article/index', [
            'posts' => $models
        ]);
    }


    /**
     * @param int $id
     */
    public function viewAction($id) {
        // get article
        $model = $this->getModel($id);

        // set head-title
        $this->setHeadArgument('title', $model->getTitle());

        // render view
        $this->render('article/view', [
            'model' => $model
        ]);
    }

}