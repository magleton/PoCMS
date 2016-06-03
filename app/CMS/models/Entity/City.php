<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseCity;

/**
 * Entity\City
 *
 * @ORM\Entity(repositoryClass="CityRepository")
 */
class City extends BaseCity
{
}