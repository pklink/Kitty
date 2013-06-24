<?php


namespace Kitty;


use Slim\Slim;
use SlimController\SlimController;

/**
 * Class Controller
 *
 * @package Kitty
 * @property App $app
 */
abstract class Controller extends SlimController {

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


    /**
     * @param string $template
     * @param array $args
     */
    protected function render($template, $args = [])
    {
        /* @var \Kitty\App $app */
        $app = $this->app;

        $args['app'] = [
            'baseUrl' => $app->getBaseUrl()
        ];

        parent::render($template, $args);
    }


}