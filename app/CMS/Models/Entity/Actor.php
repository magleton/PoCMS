<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseActor;

/**
 * Entity\Actor
 *
 * @ORM\Entity(repositoryClass="ActorRepository")
 */
class Actor extends BaseActor
{
}