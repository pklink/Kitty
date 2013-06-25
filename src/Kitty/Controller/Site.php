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

            /* @var User $user */
            $user = $this->entityManager->getRepository('Kitty\Model\User')->findOneBy([
                'username' => $username,
            ]);

            if ($user instanceof User && $user->getPassword()->match($password)) {
                $app->getIdentity()->login($user);
                $app->redirect($app->getBaseUrl());
            }
        }

        // set head-title
        $this->setHeadArgument('title', 'Login');

        // render view
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