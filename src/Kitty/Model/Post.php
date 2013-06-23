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
     * @var string
     * @Column(type="string", name="post_type")
     */
    protected $type;


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

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function getExcerpt()
    {
        $content = $this->getContent();
        $end     = strpos($content, '<!--more-->');

        if ($end == 0) {
            $end = null;
        }

        return substr($content, 0, $end);
    }

}