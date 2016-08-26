<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseCustomer;

/**
 * Entity\Customer
 *
 * @ORM\Entity(repositoryClass="CustomerRepository")
 */
class Customer extends BaseCustomer
{
}