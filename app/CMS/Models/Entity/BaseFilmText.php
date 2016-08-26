<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity\FilmText
 *
 * @ORM\Entity(repositoryClass="FilmTextRepository")
 * @ORM\Table(name="film_text", indexes={@ORM\Index(name="fk_film_text_idx", columns={"film_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseFilmText", "extended":"FilmText"})
 */
class BaseFilmText
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $film_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory", inversedBy="filmTexts")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     */
    protected $inventory;

    public function __construct()
    {
    }

    /**
     * Set the value of film_id.
     *
     * @param integer $film_id
     * @return \Entity\FilmText
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
     * Set the value of title.
     *
     * @param string $title
     * @return \Entity\FilmText
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of description.
     *
     * @param string $description
     * @return \Entity\FilmText
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Inventory entity (many to one).
     *
     * @param \Entity\Inventory $inventory
     * @return \Entity\FilmText
     */
    public function setInventory(Inventory $inventory = null)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Get Inventory entity (many to one).
     *
     * @return \Entity\Inventory
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    public function __sleep()
    {
        return array('film_id', 'title', 'description');
    }
}