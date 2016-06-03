<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity\FilmActor
 *
 * @ORM\Entity(repositoryClass="FilmActorRepository")
 * @ORM\Table(name="film_actor", indexes={@ORM\Index(name="idx_fk_film_id", columns={"film_id"}), @ORM\Index(name="fk_film_actor_actor_idx", columns={"actor_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseFilmActor", "extended":"FilmActor"})
 */
class BaseFilmActor
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $actor_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $film_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\ManyToOne(targetEntity="Actor", inversedBy="filmActors")
     * @ORM\JoinColumn(name="actor_id", referencedColumnName="actor_id")
     */
    protected $actor;

    /**
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="filmActors")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     */
    protected $film;

    public function __construct()
    {
    }

    /**
     * Set the value of actor_id.
     *
     * @param integer $actor_id
     * @return \Entity\FilmActor
     */
    public function setActorId($actor_id)
    {
        $this->actor_id = $actor_id;

        return $this;
    }

    /**
     * Get the value of actor_id.
     *
     * @return integer
     */
    public function getActorId()
    {
        return $this->actor_id;
    }

    /**
     * Set the value of film_id.
     *
     * @param integer $film_id
     * @return \Entity\FilmActor
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
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\FilmActor
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
     * Set Actor entity (many to one).
     *
     * @param \Entity\Actor $actor
     * @return \Entity\FilmActor
     */
    public function setActor(Actor $actor = null)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * Get Actor entity (many to one).
     *
     * @return \Entity\Actor
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Set Film entity (many to one).
     *
     * @param \Entity\Film $film
     * @return \Entity\FilmActor
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

    public function __sleep()
    {
        return array('actor_id', 'film_id', 'last_update');
    }
}