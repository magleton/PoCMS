<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseCategory;

/**
 * Blog\Entity\Category
 *
 * @ORM\Entity(repositoryClass="CategoryRepository")
 */
class Category extends BaseCategory
{
}