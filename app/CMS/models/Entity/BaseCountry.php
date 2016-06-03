<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Country
 *
 * @ORM\Entity(repositoryClass="CountryRepository")
 * @ORM\Table(name="country")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseCountry", "extended":"Country"})
 */
class BaseCountry
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $country_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $country;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    /**
     * Set the value of country_id.
     *
     * @param integer $country_id
     * @return \Entity\Country
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * Get the value of country_id.
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Set the value of country.
     *
     * @param string $country
     * @return \Entity\Country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\Country
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
     * Add City entity to collection (one to many).
     *
     * @param \Entity\City $city
     * @return \Entity\Country
     */
    public function addCity(City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove City entity from collection (one to many).
     *
     * @param \Entity\City $city
     * @return \Entity\Country
     */
    public function removeCity(City $city)
    {
        $this->cities->removeElement($city);

        return $this;
    }

    /**
     * Get City entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function __sleep()
    {
        return array('country_id', 'country', 'last_update');
    }
}