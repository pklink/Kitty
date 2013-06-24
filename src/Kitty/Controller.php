<?php


namespace Kitty;


use Slim\Slim;
use SlimController\SlimController;

/**
 * Class Controller
 *
 * @package Kitty
 */
abstract class Controller extends SlimController {

    /**
     * @var App
     */
    //protected $app;


    /**
     * @var EntityManager
     */
    protected $enitityManager;


    /**
     * @param Slim $app
     */
    public function __construct(Slim &$app)
    {
        $this->enitityManager = EntityManager::instance();
        parent::__construct($app);
    }

}