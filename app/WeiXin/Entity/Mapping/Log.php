<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.1.4 (doctrine2-annotation 3.1.3) on 2021-07-15 13:44:59.
 * Goto
 * https://github.com/mysql-workbench-schema-exporter/mysql-workbench-schema-exporter
 * for more information.
 */

namespace WeiXin\Entity\Mapping;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeiXin\Entity\Mapping\Log
 *
 * 日志表
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\LogRepository")
 * @ORM\Table(name="log")
 */
class Log
{
	/**
	 * 主键ID
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * 目标ID
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $target_id;

	/**
	 * 目标类型
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected $target_type;

	/**
	 * 数据
	 *
	 * @ORM\Column(type="array", nullable=true)
	 */
	protected $ext;

	/**
	 * 创建时间
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $created_at;

	/**
	 * 更新时间
	 *
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $updated_at;

	public function __construct()
	{
	}

	/**
	 * Set the value of id.
	 *
	 * @param int $id
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of id.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of target_id.
	 *
	 * @param int $target_id
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setTargetId($target_id)
	{
		$this->target_id = $target_id;

		return $this;
	}

	/**
	 * Get the value of target_id.
	 *
	 * @return int
	 */
	public function getTargetId()
	{
		return $this->target_id;
	}

	/**
	 * Set the value of target_type.
	 *
	 * @param string $target_type
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setTargetType($target_type)
	{
		$this->target_type = $target_type;

		return $this;
	}

	/**
	 * Get the value of target_type.
	 *
	 * @return string
	 */
	public function getTargetType()
	{
		return $this->target_type;
	}

	/**
	 * Set the value of ext.
	 *
	 * @param array $ext
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setExt($ext)
	{
		$this->ext = $ext;

		return $this;
	}

	/**
	 * Get the value of ext.
	 *
	 * @return array
	 */
	public function getExt()
	{
		return $this->ext;
	}

	/**
	 * Set the value of created_at.
	 *
	 * @param int $created_at
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setCreatedAt($created_at)
	{
		$this->created_at = $created_at;

		return $this;
	}

	/**
	 * Get the value of created_at.
	 *
	 * @return int
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * Set the value of updated_at.
	 *
	 * @param int $updated_at
	 *
	 * @return \WeiXin\Entity\Mapping\Log
	 */
	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = $updated_at;

		return $this;
	}

	/**
	 * Get the value of updated_at.
	 *
	 * @return int
	 */
	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

	public function __sleep()
	{
		return array('id', 'target_id', 'target_type', 'ext', 'created_at', 'updated_at');
	}
}