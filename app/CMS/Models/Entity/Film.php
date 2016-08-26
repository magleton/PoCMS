<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseFilm;

/**
 * Entity\Film
 *
 * @ORM\Entity(repositoryClass="FilmRepository")
 */
class Film extends BaseFilm
{
}