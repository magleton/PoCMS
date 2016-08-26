<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BaseStaff;

/**
 * Entity\Staff
 *
 * @ORM\Entity(repositoryClass="StaffRepository")
 */
class Staff extends BaseStaff
{
}