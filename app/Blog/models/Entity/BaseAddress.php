<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog\Entity\Address
 *
 * @ORM\Entity(repositoryClass="Blog\AddressRepository")
 * @ORM\Table(name="address", indexes={@ORM\Index(name="idx_fk_city_id", columns={"city_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseAddress", "extended":"Address"})
 */
class BaseAddress
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $address_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $district;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $city_id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $postal_code;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id", nullable=false)
     */
    protected $customers;

    /**
     * @ORM\OneToMany(targetEntity="Staff", mappedBy="address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id", nullable=false)
     */
    protected $staff;

    /**
     * @ORM\OneToMany(targetEntity="Store", mappedBy="address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id", nullable=false)
     */
    protected $stores;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="addresses")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id", nullable=false)
     */
    protected $city;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->stores = new ArrayCollection();
    }

    /**
     * Set the value of address_id.
     *
     * @param integer $address_id
     * @return \Blog\Entity\Address
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;

        return $this;
    }

    /**
     * Get the value of address_id.
     *
     * @return integer
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * Set the value of address.
     *
     * @param string $address
     * @return \Blog\Entity\Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address2.
     *
     * @param string $address2
     * @return \Blog\Entity\Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get the value of address2.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set the value of district.
     *
     * @param string $district
     * @return \Blog\Entity\Address
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get the value of district.
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set the value of city_id.
     *
     * @param integer $city_id
     * @return \Blog\Entity\Address
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
     * Set the value of postal_code.
     *
     * @param string $postal_code
     * @return \Blog\Entity\Address
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Get the value of postal_code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set the value of phone.
     *
     * @param string $phone
     * @return \Blog\Entity\Address
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Address
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
     * Add Customer entity to collection (one to many).
     *
     * @param \Blog\Entity\Customer $customer
     * @return \Blog\Entity\Address
     */
    public function addCustomer(Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove Customer entity from collection (one to many).
     *
     * @param \Blog\Entity\Customer $customer
     * @return \Blog\Entity\Address
     */
    public function removeCustomer(Customer $customer)
    {
        $this->customers->removeElement($customer);

        return $this;
    }

    /**
     * Get Customer entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Add Staff entity to collection (one to many).
     *
     * @param \Blog\Entity\Staff $staff
     * @return \Blog\Entity\Address
     */
    public function addStaff(Staff $staff)
    {
        $this->staff[] = $staff;

        return $this;
    }

    /**
     * Remove Staff entity from collection (one to many).
     *
     * @param \Blog\Entity\Staff $staff
     * @return \Blog\Entity\Address
     */
    public function removeStaff(Staff $staff)
    {
        $this->staff->removeElement($staff);

        return $this;
    }

    /**
     * Get Staff entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Add Store entity to collection (one to many).
     *
     * @param \Blog\Entity\Store $store
     * @return \Blog\Entity\Address
     */
    public function addStore(Store $store)
    {
        $this->stores[] = $store;

        return $this;
    }

    /**
     * Remove Store entity from collection (one to many).
     *
     * @param \Blog\Entity\Store $store
     * @return \Blog\Entity\Address
     */
    public function removeStore(Store $store)
    {
        $this->stores->removeElement($store);

        return $this;
    }

    /**
     * Get Store entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * Set City entity (many to one).
     *
     * @param \Blog\Entity\City $city
     * @return \Blog\Entity\Address
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get City entity (many to one).
     *
     * @return \Blog\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    public function __sleep()
    {
        return array('address_id', 'address', 'address2', 'district', 'city_id', 'postal_code', 'phone', 'last_update');
    }
}