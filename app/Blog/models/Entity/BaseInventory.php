<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog\Entity\Inventory
 *
 * @ORM\Entity(repositoryClass="Blog\InventoryRepository")
 * @ORM\Table(name="inventory", indexes={@ORM\Index(name="idx_fk_film_id", columns={"film_id"}), @ORM\Index(name="idx_store_id_film_id", columns={"store_id", "film_id"}), @ORM\Index(name="fk_inventory_store_idx", columns={"store_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseInventory", "extended":"Inventory"})
 */
class BaseInventory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $inventory_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $film_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $store_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Rental", mappedBy="inventory")
     * @ORM\JoinColumn(name="inventory_id", referencedColumnName="inventory_id", nullable=false)
     */
    protected $rentals;

    /**
     * @ORM\OneToMany(targetEntity="FilmText", mappedBy="inventory")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id", nullable=false)
     */
    protected $filmTexts;

    /**
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="inventories")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id", nullable=false)
     */
    protected $film;

    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="inventories")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id", nullable=false)
     */
    protected $store;

    public function __construct()
    {
        $this->rentals = new ArrayCollection();
        $this->filmTexts = new ArrayCollection();
    }

    /**
     * Set the value of inventory_id.
     *
     * @param integer $inventory_id
     * @return \Blog\Entity\Inventory
     */
    public function setInventoryId($inventory_id)
    {
        $this->inventory_id = $inventory_id;

        return $this;
    }

    /**
     * Get the value of inventory_id.
     *
     * @return integer
     */
    public function getInventoryId()
    {
        return $this->inventory_id;
    }

    /**
     * Set the value of film_id.
     *
     * @param integer $film_id
     * @return \Blog\Entity\Inventory
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
     * Set the value of store_id.
     *
     * @param integer $store_id
     * @return \Blog\Entity\Inventory
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Get the value of store_id.
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Inventory
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
     * Add Rental entity to collection (one to many).
     *
     * @param \Blog\Entity\Rental $rental
     * @return \Blog\Entity\Inventory
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;

        return $this;
    }

    /**
     * Remove Rental entity from collection (one to many).
     *
     * @param \Blog\Entity\Rental $rental
     * @return \Blog\Entity\Inventory
     */
    public function removeRental(Rental $rental)
    {
        $this->rentals->removeElement($rental);

        return $this;
    }

    /**
     * Get Rental entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentals()
    {
        return $this->rentals;
    }

    /**
     * Add FilmText entity to collection (one to many).
     *
     * @param \Blog\Entity\FilmText $filmText
     * @return \Blog\Entity\Inventory
     */
    public function addFilmText(FilmText $filmText)
    {
        $this->filmTexts[] = $filmText;

        return $this;
    }

    /**
     * Remove FilmText entity from collection (one to many).
     *
     * @param \Blog\Entity\FilmText $filmText
     * @return \Blog\Entity\Inventory
     */
    public function removeFilmText(FilmText $filmText)
    {
        $this->filmTexts->removeElement($filmText);

        return $this;
    }

    /**
     * Get FilmText entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmTexts()
    {
        return $this->filmTexts;
    }

    /**
     * Set Film entity (many to one).
     *
     * @param \Blog\Entity\Film $film
     * @return \Blog\Entity\Inventory
     */
    public function setFilm(Film $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get Film entity (many to one).
     *
     * @return \Blog\Entity\Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set Store entity (many to one).
     *
     * @param \Blog\Entity\Store $store
     * @return \Blog\Entity\Inventory
     */
    public function setStore(Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get Store entity (many to one).
     *
     * @return \Blog\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    public function __sleep()
    {
        return array('inventory_id', 'film_id', 'store_id', 'last_update');
    }
}