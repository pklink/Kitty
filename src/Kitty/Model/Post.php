<?php

namespace Kitty\Model;

/**
 * Class Post
 *
 * @package Kitty\Model
 * @Entity @Table(name="wp_posts")
 */
class Post {

    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string", name="post_title")
     */
    protected $title;

    /**
     * @var string
     * @Column(type="string", name="post_content")
     */
    protected $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}