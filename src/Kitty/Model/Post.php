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
     * @var string
     * @Column(type="string", name="post_status")
     */
    protected $status;

    /**
     * @var string
     * @Column(type="string", name="post_date")
     */
    protected $date;


    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @param string $content
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
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
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