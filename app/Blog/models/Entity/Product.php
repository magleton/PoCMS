<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseProduct;

/**
 * Blog\Entity\Product
 *
 * @ORM\Entity(repositoryClass="ProductRepository")
 */
class Product extends BaseProduct
{
}