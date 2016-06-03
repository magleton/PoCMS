<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseCountry;

/**
 * Blog\Entity\Country
 *
 * @ORM\Entity(repositoryClass="CountryRepository")
 */
class Country extends BaseCountry
{
}