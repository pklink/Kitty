<?php


namespace Kitty;


use Kitty\Model\User;

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
     * @param User $user
     */
    public function login(User $user)
    {
        $this->setToSesstion('isGuest', false);
        $this->setToSesstion('user', $user);
    }


    /**
     * @return User
     */
    public function getModel()
    {
        return EntityManager::instance()->find('Kitty\Model\User', $this->get('id'));
    }


    /**
     * @param string $name
     * @return string
     */
    public function get($name)
    {
        $methodName = 'get' . ucfirst($name);
        return $this->getFromSession('user')->$methodName();
    }


    /**
     *@return void
     */
    public function logout()
    {
        $this->initSession();
    }

}