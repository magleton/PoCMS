<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog\Entity\Film
 *
 * @ORM\Entity(repositoryClass="Blog\FilmRepository")
 * @ORM\Table(name="film", indexes={@ORM\Index(name="idx_title", columns={"title"}), @ORM\Index(name="idx_fk_language_id", columns={"language_id"}), @ORM\Index(name="idx_fk_original_language_id", columns={"original_language_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseFilm", "extended":"Film"})
 */
class BaseFilm
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $release_year;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $language_id;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
     */
    protected $original_language_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $rental_duration;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    protected $rental_rate;

    /**
     * @ORM\Column(name="`length`", type="smallint", nullable=true, options={"unsigned":true})
     */
    protected $length;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $replacement_cost;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $rating;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $special_features;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="FilmActor", mappedBy="film")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id", nullable=false)
     */
    protected $filmActors;

    /**
     * @ORM\OneToMany(targetEntity="FilmCategory", mappedBy="film")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id", nullable=false)
     */
    protected $filmCategories;

    /**
     * @ORM\OneToMany(targetEntity="Inventory", mappedBy="film")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="film_id", nullable=false)
     */
    protected $inventories;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="filmRelatedByLanguageIds")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="language_id", nullable=false)
     */
    protected $languageRelatedByLanguageId;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="filmRelatedByOriginalLanguageIds")
     * @ORM\JoinColumn(name="original_language_id", referencedColumnName="language_id")
     */
    protected $languageRelatedByOriginalLanguageId;

    public function __construct()
    {
        $this->filmActors = new ArrayCollection();
        $this->filmCategories = new ArrayCollection();
        $this->inventories = new ArrayCollection();
    }

    /**
     * Set the value of film_id.
     *
     * @param integer $film_id
     * @return \Blog\Entity\Film
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
     * @return \Blog\Entity\Film
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
     * @return \Blog\Entity\Film
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
     * Set the value of release_year.
     *
     * @param integer $release_year
     * @return \Blog\Entity\Film
     */
    public function setReleaseYear($release_year)
    {
        $this->release_year = $release_year;

        return $this;
    }

    /**
     * Get the value of release_year.
     *
     * @return integer
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * Set the value of language_id.
     *
     * @param integer $language_id
     * @return \Blog\Entity\Film
     */
    public function setLanguageId($language_id)
    {
        $this->language_id = $language_id;

        return $this;
    }

    /**
     * Get the value of language_id.
     *
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->language_id;
    }

    /**
     * Set the value of original_language_id.
     *
     * @param integer $original_language_id
     * @return \Blog\Entity\Film
     */
    public function setOriginalLanguageId($original_language_id)
    {
        $this->original_language_id = $original_language_id;

        return $this;
    }

    /**
     * Get the value of original_language_id.
     *
     * @return integer
     */
    public function getOriginalLanguageId()
    {
        return $this->original_language_id;
    }

    /**
     * Set the value of rental_duration.
     *
     * @param integer $rental_duration
     * @return \Blog\Entity\Film
     */
    public function setRentalDuration($rental_duration)
    {
        $this->rental_duration = $rental_duration;

        return $this;
    }

    /**
     * Get the value of rental_duration.
     *
     * @return integer
     */
    public function getRentalDuration()
    {
        return $this->rental_duration;
    }

    /**
     * Set the value of rental_rate.
     *
     * @param float $rental_rate
     * @return \Blog\Entity\Film
     */
    public function setRentalRate($rental_rate)
    {
        $this->rental_rate = $rental_rate;

        return $this;
    }

    /**
     * Get the value of rental_rate.
     *
     * @return float
     */
    public function getRentalRate()
    {
        return $this->rental_rate;
    }

    /**
     * Set the value of length.
     *
     * @param integer $length
     * @return \Blog\Entity\Film
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of length.
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of replacement_cost.
     *
     * @param float $replacement_cost
     * @return \Blog\Entity\Film
     */
    public function setReplacementCost($replacement_cost)
    {
        $this->replacement_cost = $replacement_cost;

        return $this;
    }

    /**
     * Get the value of replacement_cost.
     *
     * @return float
     */
    public function getReplacementCost()
    {
        return $this->replacement_cost;
    }

    /**
     * Set the value of rating.
     *
     * @param string $rating
     * @return \Blog\Entity\Film
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of rating.
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of special_features.
     *
     * @param string $special_features
     * @return \Blog\Entity\Film
     */
    public function setSpecialFeatures($special_features)
    {
        $this->special_features = $special_features;

        return $this;
    }

    /**
     * Get the value of special_features.
     *
     * @return string
     */
    public function getSpecialFeatures()
    {
        return $this->special_features;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Film
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
     * @param \Blog\Entity\FilmActor $filmActor
     * @return \Blog\Entity\Film
     */
    public function addFilmActor(FilmActor $filmActor)
    {
        $this->filmActors[] = $filmActor;

        return $this;
    }

    /**
     * Remove FilmActor entity from collection (one to many).
     *
     * @param \Blog\Entity\FilmActor $filmActor
     * @return \Blog\Entity\Film
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

    /**
     * Add FilmCategory entity to collection (one to many).
     *
     * @param \Blog\Entity\FilmCategory $filmCategory
     * @return \Blog\Entity\Film
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
     * @return \Blog\Entity\Film
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

    /**
     * Add Inventory entity to collection (one to many).
     *
     * @param \Blog\Entity\Inventory $inventory
     * @return \Blog\Entity\Film
     */
    public function addInventory(Inventory $inventory)
    {
        $this->inventories[] = $inventory;

        return $this;
    }

    /**
     * Remove Inventory entity from collection (one to many).
     *
     * @param \Blog\Entity\Inventory $inventory
     * @return \Blog\Entity\Film
     */
    public function removeInventory(Inventory $inventory)
    {
        $this->inventories->removeElement($inventory);

        return $this;
    }

    /**
     * Get Inventory entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInventories()
    {
        return $this->inventories;
    }

    /**
     * Set Language entity related by `language_id` (many to one).
     *
     * @param \Blog\Entity\Language $language
     * @return \Blog\Entity\Film
     */
    public function setLanguageRelatedByLanguageId(Language $language = null)
    {
        $this->languageRelatedByLanguageId = $language;

        return $this;
    }

    /**
     * Get Language entity related by `language_id` (many to one).
     *
     * @return \Blog\Entity\Language
     */
    public function getLanguageRelatedByLanguageId()
    {
        return $this->languageRelatedByLanguageId;
    }

    /**
     * Set Language entity related by `original_language_id` (many to one).
     *
     * @param \Blog\Entity\Language $language
     * @return \Blog\Entity\Film
     */
    public function setLanguageRelatedByOriginalLanguageId(Language $language = null)
    {
        $this->languageRelatedByOriginalLanguageId = $language;

        return $this;
    }

    /**
     * Get Language entity related by `original_language_id` (many to one).
     *
     * @return \Blog\Entity\Language
     */
    public function getLanguageRelatedByOriginalLanguageId()
    {
        return $this->languageRelatedByOriginalLanguageId;
    }

    public function __sleep()
    {
        return array('film_id', 'title', 'description', 'release_year', 'language_id', 'original_language_id', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features', 'last_update');
    }
}