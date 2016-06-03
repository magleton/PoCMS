<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseCountry;

/**
 * Entity\Country
 *
 * @ORM\Entity(repositoryClass="CountryRepository")
 */
class Country extends BaseCountry
{
}