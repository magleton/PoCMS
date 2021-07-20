<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="主键"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=true, options={"comment"="用户名"})
     */
    private ?string $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=true, options={"comment"="密码"})
     */
    private ?string $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="open_id", type="string", length=45, nullable=true, options={"comment"="openId"})
     */
    private ?string $openId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true, options={"comment"="电话号码"})
     */
    private ?string $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idCard", type="string", length=45, nullable=true, options={"comment"="身份证号"})
     */
    private ?string $idCard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname", type="string", length=45, nullable=true, options={"comment"="昵称"})
     */
    private ?string $nickname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_at", type="integer", nullable=true)
     */
    private ?int $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=true)
     */
    private ?int $updatedAt;

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
     * Set username.
     *
     * @param string|null $username
     *
     * @return Users
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
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
     * @return Users
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
     * @return Users
     */
    public function setOpenId($openId = null)
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * Get openId.
     *
     * @return string|null
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Users
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set idcard.
     *
     * @param string|null $idcard
     *
     * @return Users
     */
    public function setIdcard($idcard = null)
    {
        $this->idcard = $idcard;

        return $this;
    }

    /**
     * Get idcard.
     *
     * @return string|null
     */
    public function getIdcard()
    {
        return $this->idcard;
    }

    /**
     * Set nickname.
     *
     * @param string|null $nickname
     *
     * @return Users
     */
    public function setNickname($nickname = null)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname.
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set createdAt.
     *
     * @param int|null $createdAt
     *
     * @return Users
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * @return Users
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
