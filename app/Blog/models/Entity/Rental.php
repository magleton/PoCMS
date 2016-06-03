<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseRental;

/**
 * Blog\Entity\Rental
 *
 * @ORM\Entity(repositoryClass="RentalRepository")
 */
class Rental extends BaseRental
{
}