<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Staff
 *
 * @ORM\Entity(repositoryClass="StaffRepository")
 * @ORM\Table(name="staff", indexes={@ORM\Index(name="idx_fk_store_id", columns={"store_id"}), @ORM\Index(name="idx_fk_address_id", columns={"address_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BaseStaff", "extended":"Staff"})
 */
class BaseStaff
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $staff_id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $address_id;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    protected $picture;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $store_id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $username;

    /**
     * @ORM\Column(name="`password`", type="string", length=40, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_update;

    /**
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="staff")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="staff_id")
     */
    protected $payments;

    /**
     * @ORM\OneToMany(targetEntity="Rental", mappedBy="staff")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="staff_id")
     */
    protected $rentals;

    /**
     * @ORM\OneToMany(targetEntity="Store", mappedBy="staff")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="manager_staff_id")
     */
    protected $stores;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="staff")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    protected $address;

    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="staff")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    protected $store;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->rentals = new ArrayCollection();
        $this->stores = new ArrayCollection();
    }

    public function __sleep()
    {
        return array('staff_id', 'first_name', 'last_name', 'address_id', 'picture', 'email', 'store_id', 'active', 'username', 'password', 'last_update');
    }
}