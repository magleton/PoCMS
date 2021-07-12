<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=true, unique=false)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=true, unique=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="open_id", type="string", length=45, nullable=true, unique=false)
     */
    private $open_id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_at", type="integer", nullable=true, unique=false)
     */
    private $created_at;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=true, unique=false)
     */
    private $updated_at;

    /**
     * @var UserProfile
     *
     * @ORM\OneToOne(targetEntity="WeiXin\Entity\Mapping\UserProfile", mappedBy="users")
     */
    private $user_profile;


}
