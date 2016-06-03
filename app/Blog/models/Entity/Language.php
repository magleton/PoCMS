<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Blog\Entity\BaseLanguage;

/**
 * Blog\Entity\Language
 *
 * @ORM\Entity(repositoryClass="LanguageRepository")
 */
class Language extends BaseLanguage
{
}