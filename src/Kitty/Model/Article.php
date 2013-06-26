<?php

namespace Kitty\Model;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Kitty\EntityManager;

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
     * @var Tag[]
     * @ManyToMany(targetEntity="Kitty\Model\Tag")
     * @JoinTable(name="articles_tags",
     *      joinColumns={@JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */
    protected $tags;


    /**
     * @return Article
     */
    function __construct()
    {
        $this->tags = new ArrayCollection();
    }


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


    /**
     * @return Article|null
     */
    public function getNext()
    {
        $sql   = 'SELECT a FROM Kitty\Model\Article a WHERE a.id > ?1';
        $query = EntityManager::instance()->createQuery($sql);
        $query->setParameter(1, $this->getId());
        $query->setMaxResults(1);

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * @return Article|null
     */
    public function getPrevious()
    {
        $sql   = 'SELECT a FROM Kitty\Model\Article a WHERE a.id < ?1';
        $query = EntityManager::instance()->createQuery($sql);
        $query->setParameter(1, $this->getId());
        $query->setMaxResults(1);

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * @param \Kitty\Model\Tag[] $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return \Doctrine\ORM\PersistentCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

}