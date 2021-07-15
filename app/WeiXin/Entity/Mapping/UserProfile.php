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



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return UserProfile
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return UserProfile
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set createdAt.
     *
     * @param int|null $createdAt
     *
     * @return UserProfile
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt.
     *
     * @param int|null $updatedAt
     *
     * @return UserProfile
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set users.
     *
     * @param \WeiXin\Entity\Mapping\User $users
     *
     * @return UserProfile
     */
    public function setUsers(\WeiXin\Entity\Mapping\User $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users.
     *
     * @return \WeiXin\Entity\Mapping\User
     */
    public function getUsers()
    {
        return $this->users;
    }
}
