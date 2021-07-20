<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.1.4 (doctrine2-annotation 3.1.3) on 2021-07-15 13:44:59.
 * Goto
 * https://github.com/mysql-workbench-schema-exporter/mysql-workbench-schema-exporter
 * for more information.
 */

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * WeiXin\Entity\Mapping\ResourceManagement
 *
 * 资源管理表
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\ResourceManagementRepository")
 * @ORM\Table(name="resource_management")
 */
class ResourceManagement
{
    /**
     * 主键
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * 目标ID
     *
     * @ORM\Column(name="`target_id`", "type="integer", nullable=true)
     */
    protected int $targetId;

    /**
     * URL
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected string $url;

    /**
     * 名字
     *
     * @ORM\Column(name="`name`", type="string", length=45, nullable=true)
     */
    protected string $name;

    /**
     * 大小
     *
     * @ORM\Column(name="`size`", type="integer", nullable=true)
     */
    protected int $size;

    /**
     * 类型:
     * 1 景区缩略图
     * 2 景区轮播图
     * 3 ....
     *
     * @ORM\Column(name="`type`", type="smallint", nullable=true)
     */
    protected int $type;

    /**
     * 创建时间
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="`created_at`" , "type="integer", nullable=true)
     */
    protected int $createdAt;

    /**
     * 更新时间
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="`updated_at`" , "type="integer", nullable=true)
     */
    protected int $updatedAt;

    public function __construct()
    {
    }

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
     * @return int
     */
    public function getTargetId(): int
    {
        return $this->targetId;
    }

    /**
     * @param int $targetId
     */
    public function setTargetId(int $targetId): void
    {
        $this->targetId = $targetId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
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
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     */
    public function setUpdatedAt(int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __sleep()
    {
        return array('id', 'targetId', 'url', 'name', 'size', 'type', 'createdAt', 'updatedAt');
    }
}