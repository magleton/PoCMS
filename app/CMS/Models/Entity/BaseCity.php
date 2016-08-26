<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\City
 *
 * @ORM\Entity(repositoryClass="CityRepository")
 * @ORM\Table(name="city", indexes={@ORM\Index(name="idx_fk_country_id", columns={"country_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseCity", "extended":"City"})
 */
class BaseCity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $city_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $city;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $country_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="city")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     */
    protected $addresses;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $country;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * Set the value of city_id.
     *
     * @param integer $city_id
     * @return \Entity\City
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Get the value of city_id.
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * Set the value of city.
     *
     * @param string $city
     * @return \Entity\City
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of country_id.
     *
     * @param integer $country_id
     * @return \Entity\City
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
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\City
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
     * Add Address entity to collection (one to many).
     *
     * @param \Entity\Address $address
     * @return \Entity\City
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove Address entity from collection (one to many).
     *
     * @param \Entity\Address $address
     * @return \Entity\City
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * Get Address entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set Country entity (many to one).
     *
     * @param \Entity\Country $country
     * @return \Entity\City
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get Country entity (many to one).
     *
     * @return \Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function __sleep()
    {
        return array('city_id', 'city', 'country_id', 'last_update');
    }
}