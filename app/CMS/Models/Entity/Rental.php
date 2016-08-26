<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseRental;

/**
 * Entity\Rental
 *
 * @ORM\Entity(repositoryClass="RentalRepository")
 */
class Rental extends BaseRental
{
}