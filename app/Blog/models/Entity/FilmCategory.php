<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseFilmCategory;

/**
 * Blog\Entity\FilmCategory
 *
 * @ORM\Entity(repositoryClass="FilmCategoryRepository")
 */
class FilmCategory extends BaseFilmCategory
{
}