<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BasePayment;

/**
 * Blog\Entity\Payment
 *
 * @ORM\Entity(repositoryClass="PaymentRepository")
 */
class Payment extends BasePayment
{
}