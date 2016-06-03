<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Actor
 *
 * @ORM\Entity(repositoryClass="ActorRepository")
 * @ORM\Table(name="actor", indexes={@ORM\Index(name="idx_actor_last_name", columns={"last_name"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseActor", "extended":"Actor"})
 */
class BaseActor
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $actor_id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="FilmActor", mappedBy="actor")
     * @ORM\JoinColumn(name="actor_id", referencedColumnName="actor_id")
     */
    protected $filmActors;

    public function __construct()
    {
        $this->filmActors = new ArrayCollection();
    }

    /**
     * Set the value of actor_id.
     *
     * @param integer $actor_id
     * @return \Entity\Actor
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
     * Set the value of first_name.
     *
     * @param string $first_name
     * @return \Entity\Actor
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of first_name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of last_name.
     *
     * @param string $last_name
     * @return \Entity\Actor
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of last_name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\Actor
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
     * Add FilmActor entity to collection (one to many).
     *
     * @param \Entity\FilmActor $filmActor
     * @return \Entity\Actor
     */
    public function addFilmActor(FilmActor $filmActor)
    {
        $this->filmActors[] = $filmActor;

        return $this;
    }

    /**
     * Remove FilmActor entity from collection (one to many).
     *
     * @param \Entity\FilmActor $filmActor
     * @return \Entity\Actor
     */
    public function removeFilmActor(FilmActor $filmActor)
    {
        $this->filmActors->removeElement($filmActor);

        return $this;
    }

    /**
     * Get FilmActor entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmActors()
    {
        return $this->filmActors;
    }

    public function __sleep()
    {
        return array('actor_id', 'first_name', 'last_name', 'last_update');
    }
}