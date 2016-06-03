<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseAddress;

/**
 * Entity\Address
 *
 * @ORM\Entity(repositoryClass="AddressRepository")
 */
class Address extends BaseAddress
{
}