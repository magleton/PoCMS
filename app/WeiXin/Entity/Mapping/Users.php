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
    private string $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=45, nullable=true, options={"comment"="密码"})
     */
    private string $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="open_id", type="string", length=45, nullable=true, options={"comment"="openId"})
     */
    private string $openId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true, options={"comment"="电话号码"})
     */
    private string $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idCard", type="string", length=45, nullable=true, options={"comment"="身份证号"})
     */
    private string $idCard;

    /**
     * 扩展字段
     *
     * @ORM\Column(type="json", nullable=true)
     */
    protected array $ext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname", type="string", length=45, nullable=true, options={"comment"="昵称"})
     */
    private string $nickname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_at", type="integer", nullable=true)
     */
    private int $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=true)
     */
    private int $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getOpenId(): ?string
    {
        return $this->openId;
    }

    /**
     * @param string|null $openId
     */
    public function setOpenId(?string $openId): void
    {
        $this->openId = $openId;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getIdCard(): ?string
    {
        return $this->idCard;
    }

    /**
     * @param string|null $idCard
     */
    public function setIdCard(?string $idCard): void
    {
        $this->idCard = $idCard;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    /**
     * @param int|null $createdAt
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    /**
     * @param int|null $updatedAt
     */
    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __sleep()
    {
        return array('id', 'username', 'openId', 'nickname', 'phone', 'idCard', 'ext', 'createdAt', 'updatedAt');
    }
}
