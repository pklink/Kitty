<?php


namespace Kitty;


abstract class Controller {

    /**
     * @var App
     */
    protected $app;


    /**
     * @var EntityManager
     */
    protected $enitityManager;


    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app            = $app;
        $this->enitityManager = EntityManager::instance();
    }

}