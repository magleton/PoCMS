<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="主键ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * 订单号
     *
     * @ORM\Column(name="`order_no`", type="string", length=50, nullable=true)
     */
    private string $orderNo;

    /**
     * 用户ID
     *
     * @ORM\Column(name="`user_id`", type="integer", length=50, nullable=true)
     */
    private int $userId;

    /**
     * 价格(单位: 分)
     *
     * @ORM\Column(name="`price`", type="integer", length=50, nullable=true)
     */
    private int $price;

    /**
     * 状态
     *
     * @ORM\Column(name="`status`", type="integer", length=50, nullable=true)
     */
    private int $status;

    /**
     * 扩展数据
     *
     * @ORM\Column(name="`ext`", type="json", nullable=true)
     */
    private array $ext;

    /**
     * 创建时间
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="`created_at`" , type="integer", nullable=true)
     */
    protected int $createdAt;

    /**
     * 更新时间
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="`updated_at`" , type="integer", nullable=true)
     */
    protected int $updateAt;

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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOrderNo(): string
    {
        return $this->orderNo;
    }

    /**
     * @param string $orderNo
     */
    public function setOrderNo(string $orderNo): void
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getExt(): array
    {
        return $this->ext;
    }

    /**
     * @param array $ext
     */
    public function setExt(array $ext): void
    {
        $this->ext = $ext;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getUpdateAt(): int
    {
        return $this->updateAt;
    }

    /**
     * @param int $updateAt
     */
    public function setUpdateAt(int $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    public function __sleep()
    {
        return array('id', 'orderNo', 'userId', 'price', 'status', 'ext', 'created_at', 'updated_at');
    }
}
