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
    private $createdAt;

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param int|null $createdAt
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return User
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set openId.
     *
     * @param string|null $openId
     *
     * @return User
     */
    public function setOpenId($openId = null)
    {
        $this->open_id = $openId;

        return $this;
    }

    /**
     * Get openId.
     *
     * @return string|null
     */
    public function getOpenId()
    {
        return $this->open_id;
    }

    /**
     * Get createdAt.
     *
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param int|null $updatedAt
     *
     * @return User
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
     * Set userProfile.
     *
     * @param \WeiXin\Entity\Mapping\UserProfile|null $userProfile
     *
     * @return User
     */
    public function setUserProfile(\WeiXin\Entity\Mapping\UserProfile $userProfile = null)
    {
        $this->user_profile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile.
     *
     * @return \WeiXin\Entity\Mapping\UserProfile|null
     */
    public function getUserProfile()
    {
        return $this->user_profile;
    }
}
