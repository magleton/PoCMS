<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseInventory;

/**
 * Blog\Entity\Inventory
 *
 * @ORM\Entity(repositoryClass="InventoryRepository")
 */
class Inventory extends BaseInventory
{
}