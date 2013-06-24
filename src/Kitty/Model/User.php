<?php


namespace Kitty\Model;


/**
 * Class User
 *
 * @package Kitty\Model
 * @Entity @Table(name="users")
 */
class User
{

    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;


    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;


    /**
     * @var string
     * @Column(type="string")
     */
    protected $username;


    /**
     * @var string
     * @Column(type="string")
     */
    protected $email;


    /**
     * @var string
     * @Column(type="string")
     */
    protected $password;


    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}