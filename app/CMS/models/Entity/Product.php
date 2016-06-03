<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseProduct;

/**
 * Entity\Product
 *
 * @ORM\Entity(repositoryClass="ProductRepository")
 */
class Product extends BaseProduct
{
}