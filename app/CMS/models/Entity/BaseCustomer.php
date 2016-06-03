<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Customer
 *
 * Table storing all customers. Holds foreign keys to the address table and the
 * store table where this customer is registered.
 *
 * Basic information about the customer like first and last name are stored in
 * the table itself. Same for the date the record was created and when the
 * information was last updated.
 *
 * @ORM\Entity(repositoryClass="CustomerRepository")
 * @ORM\Table(name="customer", indexes={@ORM\Index(name="idx_fk_store_id", columns={"store_id"}), @ORM\Index(name="idx_fk_address_id", columns={"address_id"}), @ORM\Index(name="idx_last_name", columns={"last_name"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseCustomer", "extended":"Customer"})
 */
class BaseCustomer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $customer_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $store_id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $address_id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $create_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $payments;

    /**
     * @ORM\OneToMany(targetEntity="Rental", mappedBy="customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     */
    protected $rentals;

    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="customers")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    protected $store;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="customers")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    protected $address;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->rentals = new ArrayCollection();
    }

    /**
     * Set the value of customer_id.
     *
     * @param integer $customer_id
     * @return \Entity\Customer
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Get the value of customer_id.
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set the value of store_id.
     *
     * @param integer $store_id
     * @return \Entity\Customer
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
     * Set the value of first_name.
     *
     * @param string $first_name
     * @return \Entity\Customer
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
     * @return \Entity\Customer
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
     * Set the value of email.
     *
     * @param string $email
     * @return \Entity\Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of address_id.
     *
     * @param integer $address_id
     * @return \Entity\Customer
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
     * Set the value of active.
     *
     * @param boolean $active
     * @return \Entity\Customer
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of active.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of create_date.
     *
     * @param \DateTime $create_date
     * @return \Entity\Customer
     */
    public function setCreateDate(\DateTime $create_date)
    {
        $this->create_date = $create_date;

        return $this;
    }

    /**
     * Get the value of create_date.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Entity\Customer
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
     * Add Payment entity to collection (one to many).
     *
     * @param \Entity\Payment $payment
     * @return \Entity\Customer
     */
    public function addPayment(Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove Payment entity from collection (one to many).
     *
     * @param \Entity\Payment $payment
     * @return \Entity\Customer
     */
    public function removePayment(Payment $payment)
    {
        $this->payments->removeElement($payment);

        return $this;
    }

    /**
     * Get Payment entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Add Rental entity to collection (one to many).
     *
     * @param \Entity\Rental $rental
     * @return \Entity\Customer
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;

        return $this;
    }

    /**
     * Remove Rental entity from collection (one to many).
     *
     * @param \Entity\Rental $rental
     * @return \Entity\Customer
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
     * Set Store entity (many to one).
     *
     * @param \Entity\Store $store
     * @return \Entity\Customer
     */
    public function setStore(Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get Store entity (many to one).
     *
     * @return \Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set Address entity (many to one).
     *
     * @param \Entity\Address $address
     * @return \Entity\Customer
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get Address entity (many to one).
     *
     * @return \Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function __sleep()
    {
        return array('customer_id', 'store_id', 'first_name', 'last_name', 'email', 'address_id', 'active', 'create_date', 'last_update');
    }
}