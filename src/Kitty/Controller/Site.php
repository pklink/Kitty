<?php


namespace Kitty\Controller;

use Kitty\Controller;
use Kitty\Model\User;

/**
 * Class Site
 *
 * @package Kitty\Controller
 */
class Site extends Controller
{

    /**
     * @return void
     */
    public function loginAction()
    {
        /* @var \Kitty\App $app */
        $app     = $this->app;
        $request = $this->app->request();

        if ($request->isPost()) {
            $username = $request->post('username');
            $password = $request->post('password');

            $user = $this->enitityManager->getRepository('Kitty\Model\User')->findOneBy([
                'username' => $username,
                'password' => $password
            ]);

            if ($user instanceof User) {
                $app->getIdentity()->login($user->getName());
                $app->redirect($app->getBaseUrl() . '/admin');
            }
        }

        $this->render('site/login');
    }


    /**
     * @return void
     */
    public function logoutAction()
    {
        /* @var \Kitty\App $app */
        $app = $this->app;

        $app->getIdentity()->logout();
        $app->redirect($app->getBaseUrl());
    }

}