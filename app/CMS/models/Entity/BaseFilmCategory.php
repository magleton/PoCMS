<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity\FilmCategory
 *
 * @ORM\Entity(repositoryClass="FilmCategoryRepository")
 * @ORM\Table(name="film_category", indexes={@ORM\Index(name="fk_film_category_category_idx", columns={"category_id"}), @ORM\Index(name="fk_film_category_film_idx", columns={"film_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseFilmCategory", "extended":"FilmCategory"})
 */
class BaseFilmCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $film_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $category_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="filmCategories")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     */
    protected $film;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="filmCategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    protected $category;

    public function __construct()
    {
    }

    /**
     * Set the value of film_id.
     *
     * @param integer $film_id
     * @return \Entity\FilmCategory
     */
    public function setFilmId($film_id)
    {
        $this->film_id = $film_id;

        return $this;
    }

    /**
     * Get the value of film_id.
     *
     * @return integer
     */
    public function getFilmId()
    {
        return $this->film_id;
    }

    /**
     * Set the value of category_id.
     *
     * @param integer $category_id
     * @return \Entity\FilmCategory
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
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\FilmCategory
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
     * Set Film entity (many to one).
     *
     * @param \Entity\Film $film
     * @return \Entity\FilmCategory
     */
    public function setFilm(Film $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get Film entity (many to one).
     *
     * @return \Entity\Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set Category entity (many to one).
     *
     * @param \Entity\Category $category
     * @return \Entity\FilmCategory
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get Category entity (many to one).
     *
     * @return \Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __sleep()
    {
        return array('film_id', 'category_id', 'last_update');
    }
}