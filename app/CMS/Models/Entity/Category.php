<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseCategory;

/**
 * Entity\Category
 *
 * @ORM\Entity(repositoryClass="CategoryRepository")
 */
class Category extends BaseCategory
{
}