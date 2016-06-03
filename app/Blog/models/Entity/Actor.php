<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseActor;

/**
 * Blog\Entity\Actor
 *
 * @ORM\Entity(repositoryClass="ActorRepository")
 */
class Actor extends BaseActor
{
}