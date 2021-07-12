<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserProfile
 *
 * @ORM\Table(name="user_profile", indexes={@ORM\Index(name="fk_user_profile_users_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\UserProfileRepository")
 */
class UserProfile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false, unique=false)
     */
    private $user_id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=true, unique=false)
     */
    private $address;

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
     * @var \WeiXin\Entity\Mapping\User
     *
     * @ORM\OneToOne(targetEntity="WeiXin\Entity\Mapping\User", inversedBy="user_profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true, nullable=false)
     * })
     */
    private $users;


}
