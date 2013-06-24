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
     * @var string
     */
    protected $baseUrl = '';


    /**
     * @var Identity
     */
    protected $identity;


    /**
     * @param array $userSettings
     */
    public function __construct($userSettings = array())
    {
        // start session
        session_start();

        // setting base URL
        if (isset($userSettings['baseUrl']))
        {
            $this->setBaseUrl($userSettings['baseUrl']);
            unset($userSettings['baseUrl']);
        }

        // create View
        $userSettings['view'] = new View($userSettings);

        // create Identity
        $this->identity = new Identity();

        parent::__construct($userSettings);
    }


    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }


    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }


    /**
     * @return \Kitty\Identity
     */
    public function getIdentity()
    {
        return $this->identity;
    }

}