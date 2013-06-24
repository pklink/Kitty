<?php


namespace Kitty\Middleware;

use Slim\Middleware;

/**
 * Class Identity
 *
 * @package Kitty
 */
class Authentication extends Middleware
{

    /**
     * @var string
     */
    public $loginUrl = '/login';


    /**
     * @var string
     */
    public $secure   = '/admin';


    /**
     * @param array $args
     */
    function __construct($args = [])
    {
        if (isset($args['loginUrl']))
        {
            $this->loginUrl = $args['loginUrl'];
        }

        if (isset($args['secure']))
        {
            $this->secure = $args['secure'];
        }
    }


    /**
     * Call
     *
     * Perform actions specific to this middleware and optionally
     * call the next downstream middleware.
     */
    public function call()
    {
        /* @var \Kitty\App $app */
        $app = $this->app;

        // get url-path
        $path = $app->request()->getPath();

        // check if requested url is in secure-path
        if (substr($path, 0, strlen($this->secure)) == $this->secure && $app->getIdentity()->isGuest()) {
            $app->redirect($this->loginUrl, 401);
        }

        $this->next->call();
    }

}