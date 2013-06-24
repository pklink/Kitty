<?php


namespace Kitty;


class Identity
{

    const SESSION_NAME = '__kitty-user';

    /**
     * @return Identity
     */
    public function __construct()
    {
        if (!isset($_SESSION[self::SESSION_NAME]))
        {
            $this->initSession();
        }
    }


    /**
     * @return void
     */
    protected function initSession()
    {
        $_SESSION[self::SESSION_NAME] = [
            'isGuest' => true,
            'name'    => '',
        ];
    }


    /**
     * @param string $key
     * @return mixed
     */
    protected function getFromSession($key)
    {
        return $_SESSION[self::SESSION_NAME][$key];
    }


    /**
     * @param string $key
     * @param mixed $value
     */
    protected function setToSesstion($key, $value)
    {
        $_SESSION[self::SESSION_NAME][$key] = $value;
    }


    /**
     * @return bool
     */
    public function isGuest()
    {
        return $this->getFromSession('isGuest');
    }


    /**
     * @param $name
     */
    public function login($name)
    {
        $this->setName($name);
        $this->setToSesstion('isGuest', false);
    }


    /**
     *@return void
     */
    public function logout()
    {
        $this->initSession();
    }


    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->setToSesstion('name', $name);
    }


    /**
     * @return String
     */
    public function getName()
    {
        return $this->getFromSession('name');
    }

}