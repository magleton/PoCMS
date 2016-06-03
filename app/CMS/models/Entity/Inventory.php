<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseInventory;

/**
 * Entity\Inventory
 *
 * @ORM\Entity(repositoryClass="InventoryRepository")
 */
class Inventory extends BaseInventory
{
}