<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseCity;

/**
 * Blog\Entity\City
 *
 * @ORM\Entity(repositoryClass="CityRepository")
 */
class City extends BaseCity
{
}