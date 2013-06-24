<?php


namespace Kitty\Controller;

use Kitty\Controller;

/**
 * Class Admin
 *
 * @package Kitty\Controller
 */
class Admin extends Controller
{

    /**
     * @return void
     */
    public function dashboardAction()
    {
        $this->render('admin/dashboard');
    }


    /**
     * @return void
     */
    public function indexAction()
    {
        /* @var \Kitty\App $app */
        $app = $this->app;

        $this->redirect($app->getBaseUrl() . '/admin/dashboard');
    }


}