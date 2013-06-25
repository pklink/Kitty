<?php

namespace Kitty;

use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;

/**
 * Class EntityManager
 * @package Kitty
 */
class EntityManager {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected static $instance;


    /**
     * @return void
     */
    protected static function init() {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

        // database configuration parameters
        $conn = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'bitnami',
            'dbname'   => 'pekar_wp',
            'host'     => '127.0.0.1',

        );

        // obtaining the entity manager
        self::$instance = \Doctrine\ORM\EntityManager::create($conn, $config);

        // add password-type
        Type::addType('password', 'Cpliakas\Password\Doctrine\PasswordType');
    }


    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public static function instance() {
        if (self::$instance == null) {
            self::init();
        }

        return self::$instance;
    }

}