<?php


namespace Kitty;

/**
 * Class Twig
 *
 * @package Kitty
 */
class Twig {


    /**
     * @var \Twig_Environment
     */
    protected static $instance;


    /**
     * @return void
     */
    protected static function init() {
        $basepath = realpath(__DIR__ . '/../../templates');

        $loader = new \Twig_Loader_Filesystem($basepath);
        self::$instance = new \Twig_Environment($loader, array(
            //'cache' => $basepath . '/cache',
        ));
    }


    /**
     * @return \Twig_Environment
     */
    public static function instance() {
        if (self::$instance == null) {
            self::init();
        }

        return self::$instance;
    }

}