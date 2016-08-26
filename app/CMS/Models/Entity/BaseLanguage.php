<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Language
 *
 * @ORM\Entity(repositoryClass="LanguageRepository")
 * @ORM\Table(name="`language`")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseLanguage", "extended":"Language"})
 */
class BaseLanguage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $language_id;

    /**
     * @ORM\Column(name="`name`", type="string", length=20)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Film", mappedBy="languageRelatedByLanguageId")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     */
    protected $filmRelatedByLanguageIds;

    /**
     * @ORM\OneToMany(targetEntity="Film", mappedBy="languageRelatedByOriginalLanguageId")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="original_language_id")
     */
    protected $filmRelatedByOriginalLanguageIds;

    public function __construct()
    {
        $this->filmRelatedByLanguageIds = new ArrayCollection();
        $this->filmRelatedByOriginalLanguageIds = new ArrayCollection();
    }

    /**
     * Set the value of language_id.
     *
     * @param integer $language_id
     * @return \Entity\Language
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
     * Set the value of name.
     *
     * @param string $name
     * @return \Entity\Language
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
     * @return \Entity\Language
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
     * Add Film entity related by `language_id` to collection (one to many).
     *
     * @param \Entity\Film $film
     * @return \Entity\Language
     */
    public function addFilmRelatedByLanguageId(Film $film)
    {
        $this->filmRelatedByLanguageIds[] = $film;

        return $this;
    }

    /**
     * Remove Film entity related by `language_id` from collection (one to many).
     *
     * @param \Entity\Film $film
     * @return \Entity\Language
     */
    public function removeFilmRelatedByLanguageId(Film $film)
    {
        $this->filmRelatedByLanguageIds->removeElement($film);

        return $this;
    }

    /**
     * Get Film entity related by `language_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmRelatedByLanguageIds()
    {
        return $this->filmRelatedByLanguageIds;
    }

    /**
     * Add Film entity related by `original_language_id` to collection (one to many).
     *
     * @param \Entity\Film $film
     * @return \Entity\Language
     */
    public function addFilmRelatedByOriginalLanguageId(Film $film)
    {
        $this->filmRelatedByOriginalLanguageIds[] = $film;

        return $this;
    }

    /**
     * Remove Film entity related by `original_language_id` from collection (one to many).
     *
     * @param \Entity\Film $film
     * @return \Entity\Language
     */
    public function removeFilmRelatedByOriginalLanguageId(Film $film)
    {
        $this->filmRelatedByOriginalLanguageIds->removeElement($film);

        return $this;
    }

    /**
     * Get Film entity related by `original_language_id` collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmRelatedByOriginalLanguageIds()
    {
        return $this->filmRelatedByOriginalLanguageIds;
    }

    public function __sleep()
    {
        return array('language_id', 'name', 'last_update');
    }
}