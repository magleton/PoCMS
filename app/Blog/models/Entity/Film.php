<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseFilm;

/**
 * Blog\Entity\Film
 *
 * @ORM\Entity(repositoryClass="FilmRepository")
 */
class Film extends BaseFilm
{
}