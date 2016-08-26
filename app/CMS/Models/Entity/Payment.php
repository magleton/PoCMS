<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\BasePayment;

/**
 * Entity\Payment
 *
 * @ORM\Entity(repositoryClass="PaymentRepository")
 */
class Payment extends BasePayment
{
}