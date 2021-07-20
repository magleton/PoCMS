<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.1.4 (doctrine2-annotation 3.1.3) on 2021-07-15 13:44:59.
 * Goto
 * https://github.com/mysql-workbench-schema-exporter/mysql-workbench-schema-exporter
 * for more information.
 */

namespace WeiXin\Entity\Mapping;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * WeiXin\Entity\Mapping\Category
 *
 * 分类表
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category
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
     * 名字
     *
     * @ORM\Column(name="`name`", type="string", length=45, nullable=true)
     */
    protected string $name;

    /**
     * 父级ID
     *
     * @ORM\Column(name="`parent_id`", type="integer", nullable=true)
     */
    protected int $parentId;

    /**
     * 路径
     *
     * @ORM\Column(name="`path`", type="string", length=255, nullable=true)
     */
    protected string $path;

    /**
     * 扩展字段
     *
     * @ORM\Column(name="`ext`" , type="json", nullable=true)
     */
    protected array $ext;

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
    protected int $updatedAt;

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
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
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
        return array('id', 'name', 'parentId', 'path', 'ext', 'createdAt', 'updatedAt');
    }
}