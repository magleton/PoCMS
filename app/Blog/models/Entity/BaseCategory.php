<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog\Entity\Category
 *
 * @ORM\Entity(repositoryClass="Blog\CategoryRepository")
 * @ORM\Table(name="category")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseCategory", "extended":"Category"})
 */
class BaseCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $category_id;

    /**
     * @ORM\Column(name="`name`", type="string", length=25)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="FilmCategory", mappedBy="category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id", nullable=false)
     */
    protected $filmCategories;

    public function __construct()
    {
        $this->filmCategories = new ArrayCollection();
    }

    /**
     * Set the value of category_id.
     *
     * @param integer $category_id
     * @return \Blog\Entity\Category
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of category_id.
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Blog\Entity\Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Category
     */
    public function setLastUpdate(\DateTime $last_update)
    {
        $this->last_update = $last_update;

        return $this;
    }

    /**
     * Get the value of last_update.
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Add FilmCategory entity to collection (one to many).
     *
     * @param \Blog\Entity\FilmCategory $filmCategory
     * @return \Blog\Entity\Category
     */
    public function addFilmCategory(FilmCategory $filmCategory)
    {
        $this->filmCategories[] = $filmCategory;

        return $this;
    }

    /**
     * Remove FilmCategory entity from collection (one to many).
     *
     * @param \Blog\Entity\FilmCategory $filmCategory
     * @return \Blog\Entity\Category
     */
    public function removeFilmCategory(FilmCategory $filmCategory)
    {
        $this->filmCategories->removeElement($filmCategory);

        return $this;
    }

    /**
     * Get FilmCategory entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmCategories()
    {
        return $this->filmCategories;
    }

    public function __sleep()
    {
        return array('category_id', 'name', 'last_update');
    }
}