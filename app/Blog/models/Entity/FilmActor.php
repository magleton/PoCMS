<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseFilmActor;

/**
 * Blog\Entity\FilmActor
 *
 * @ORM\Entity(repositoryClass="FilmActorRepository")
 */
class FilmActor extends BaseFilmActor
{
}