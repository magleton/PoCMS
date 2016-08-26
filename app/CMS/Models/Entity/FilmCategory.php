<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseFilmCategory;

/**
 * Entity\FilmCategory
 *
 * @ORM\Entity(repositoryClass="FilmCategoryRepository")
 */
class FilmCategory extends BaseFilmCategory
{
}