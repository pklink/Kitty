<?php


namespace Kitty;

use SlimController\Slim;

/**
 * Class App
 *
 * @package Kitty
 */
class App extends Slim {

    /**
     * @param array $userSettings
     */
    public function __construct($userSettings = array())
    {
        // setting base URL
        if (!isset($userSettings['baseUrl']))
        {
            $userSettings['baseUrl'] = '';
        }

        // setting View
        $userSettings['view'] = new View($userSettings);

        parent::__construct($userSettings);
    }

}