<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseStore;

/**
 * Blog\Entity\Store
 *
 * @ORM\Entity(repositoryClass="StoreRepository")
 */
class Store extends BaseStore
{
}