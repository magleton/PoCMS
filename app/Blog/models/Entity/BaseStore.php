<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Blog\Entity\Store
 *
 * @ORM\Entity(repositoryClass="Blog\StoreRepository")
 * @ORM\Table(name="store", indexes={@ORM\Index(name="idx_fk_address_id", columns={"address_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_manager", columns={"manager_staff_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseStore", "extended":"Store"})
 */
class BaseStore
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $store_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $manager_staff_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $address_id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="store")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id", nullable=false)
     */
    protected $customers;

    /**
     * @ORM\OneToMany(targetEntity="Inventory", mappedBy="store")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id", nullable=false)
     */
    protected $inventories;

    /**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="stores")
     * @ORM\JoinColumn(name="manager_staff_id", referencedColumnName="staff_id", nullable=false)
     */
    protected $staff;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="stores")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id", nullable=false)
     */
    protected $address;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->inventories = new ArrayCollection();
    }

    /**
     * Set the value of store_id.
     *
     * @param integer $store_id
     * @return \Blog\Entity\Store
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
     * Set the value of manager_staff_id.
     *
     * @param integer $manager_staff_id
     * @return \Blog\Entity\Store
     */
    public function setManagerStaffId($manager_staff_id)
    {
        $this->manager_staff_id = $manager_staff_id;

        return $this;
    }

    /**
     * Get the value of manager_staff_id.
     *
     * @return integer
     */
    public function getManagerStaffId()
    {
        return $this->manager_staff_id;
    }

    /**
     * Set the value of address_id.
     *
     * @param integer $address_id
     * @return \Blog\Entity\Store
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
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Store
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
     * @return \Blog\Entity\Store
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
     * @return \Blog\Entity\Store
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
     * Add Inventory entity to collection (one to many).
     *
     * @param \Blog\Entity\Inventory $inventory
     * @return \Blog\Entity\Store
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
     * @return \Blog\Entity\Store
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
     * Set Staff entity (many to one).
     *
     * @param \Blog\Entity\Staff $staff
     * @return \Blog\Entity\Store
     */
    public function setStaff(Staff $staff = null)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get Staff entity (many to one).
     *
     * @return \Blog\Entity\Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set Address entity (many to one).
     *
     * @param \Blog\Entity\Address $address
     * @return \Blog\Entity\Store
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get Address entity (many to one).
     *
     * @return \Blog\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function __sleep()
    {
        return array('store_id', 'manager_staff_id', 'address_id', 'last_update');
    }
}