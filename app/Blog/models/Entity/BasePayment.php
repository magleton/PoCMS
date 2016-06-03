<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blog\Entity\Payment
 *
 * @ORM\Entity(repositoryClass="Blog\PaymentRepository")
 * @ORM\Table(name="payment", indexes={@ORM\Index(name="idx_fk_staff_id", columns={"staff_id"}), @ORM\Index(name="idx_fk_customer_id", columns={"customer_id"}), @ORM\Index(name="fk_payment_rental_idx", columns={"rental_id"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base":"BasePayment", "extended":"Payment"})
 */
class BasePayment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="smallint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $payment_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $customer_id;

    /**
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    protected $staff_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $rental_id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $payment_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_update;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="payments")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id", nullable=false)
     */
    protected $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="payments")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="staff_id", nullable=false)
     */
    protected $staff;

    /**
     * @ORM\ManyToOne(targetEntity="Rental", inversedBy="payments")
     * @ORM\JoinColumn(name="rental_id", referencedColumnName="rental_id", onDelete="SET NULL")
     */
    protected $rental;

    public function __construct()
    {
    }

    /**
     * Set the value of payment_id.
     *
     * @param integer $payment_id
     * @return \Blog\Entity\Payment
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    /**
     * Get the value of payment_id.
     *
     * @return integer
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * Set the value of customer_id.
     *
     * @param integer $customer_id
     * @return \Blog\Entity\Payment
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
     * Set the value of staff_id.
     *
     * @param integer $staff_id
     * @return \Blog\Entity\Payment
     */
    public function setStaffId($staff_id)
    {
        $this->staff_id = $staff_id;

        return $this;
    }

    /**
     * Get the value of staff_id.
     *
     * @return integer
     */
    public function getStaffId()
    {
        return $this->staff_id;
    }

    /**
     * Set the value of rental_id.
     *
     * @param integer $rental_id
     * @return \Blog\Entity\Payment
     */
    public function setRentalId($rental_id)
    {
        $this->rental_id = $rental_id;

        return $this;
    }

    /**
     * Get the value of rental_id.
     *
     * @return integer
     */
    public function getRentalId()
    {
        return $this->rental_id;
    }

    /**
     * Set the value of amount.
     *
     * @param float $amount
     * @return \Blog\Entity\Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of amount.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of payment_date.
     *
     * @param \DateTime $payment_date
     * @return \Blog\Entity\Payment
     */
    public function setPaymentDate(\DateTime $payment_date)
    {
        $this->payment_date = $payment_date;

        return $this;
    }

    /**
     * Get the value of payment_date.
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    /**
     * Set the value of last_update.
     *
     * @param \DateTime $last_update
     * @return \Blog\Entity\Payment
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
     * Set Customer entity (many to one).
     *
     * @param \Blog\Entity\Customer $customer
     * @return \Blog\Entity\Payment
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get Customer entity (many to one).
     *
     * @return \Blog\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set Staff entity (many to one).
     *
     * @param \Blog\Entity\Staff $staff
     * @return \Blog\Entity\Payment
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
     * Set Rental entity (many to one).
     *
     * @param \Blog\Entity\Rental $rental
     * @return \Blog\Entity\Payment
     */
    public function setRental(Rental $rental = null)
    {
        $this->rental = $rental;

        return $this;
    }

    /**
     * Get Rental entity (many to one).
     *
     * @return \Blog\Entity\Rental
     */
    public function getRental()
    {
        return $this->rental;
    }

    public function __sleep()
    {
        return array('payment_id', 'customer_id', 'staff_id', 'rental_id', 'amount', 'payment_date', 'last_update');
    }
}