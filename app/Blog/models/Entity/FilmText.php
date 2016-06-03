<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseFilmText;

/**
 * Blog\Entity\FilmText
 *
 * @ORM\Entity(repositoryClass="FilmTextRepository")
 */
class FilmText extends BaseFilmText
{
}