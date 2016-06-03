<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseAddress;

/**
 * Blog\Entity\Address
 *
 * @ORM\Entity(repositoryClass="AddressRepository")
 */
class Address extends BaseAddress
{
}