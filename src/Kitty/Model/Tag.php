<?php

namespace Kitty\Model;

/**
 * Class Tag
 *
 * @package Kitty\Model
 * @Entity @Table(name="tags")
 */
class Tag {

    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;

    /**
     * @var Article[]
     * @ManyToMany(targetEntity="Kitty\Model\Article")
     * @JoinTable(name="articles_tags",
     *      joinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="id")}
     * )
     */
    protected $articles;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @param \Kitty\Model\Article[] $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return \Kitty\Model\Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

}