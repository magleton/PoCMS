<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseCustomer;

/**
 * Blog\Entity\Customer
 *
 * @ORM\Entity(repositoryClass="CustomerRepository")
 */
class Customer extends BaseCustomer
{
}