<?php

namespace Kitty\Model;

/**
 * Class Post
 *
 * @package Kitty\Model
 * @Entity @Table(name="articles")
 */
class Article {

    const TYPE_NORMAL = 'normal';

    const TYPE_SHORT = 'short';

    const STATUS_PUBLISHED = 'published';

    const STATUS_DRAFT = 'draft';


    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var User
     * @ManyToOne(targetEntity="Kitty\Model\User")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $content;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $type;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $status;

    /**
     * @var string
     * @Column(type="datetime")
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
     * @param \Kitty\Model\User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return \Kitty\Model\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getExcerpt()
    {
        $content = $this->getContent();
        $end     = strpos($content, '<!--more-->');

        if ($end == 0) {
            $end = strlen($content);
        }

        return substr($content, 0, $end);
    }

}