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
 * WeiXin\Entity\Mapping\Appointment
 *
 * 预约
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\AppointmentRepository")
 * @ORM\Table(name="appointment")
 */
class Appointment
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected int $id;

	/**
	 * 名称
	 *
	 * @ORM\Column(name="`name`", type="string", length=45, nullable=true)
	 */
	protected string $name;

	/**
	 * 电话
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected string $phone;

	/**
	 * 身份证号
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected string $idCard;

	/**
	 * 状态:
	 * 1 待预约
	 * 2 预约中
	 * 3 已经预约
	 * 4 待使用
	 * 5 已使用
	 *
	 * @ORM\Column(name="`status`", type="string", length=45, nullable=true)
	 */
	protected string $status;

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
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $createdAt;

	/**
	 * 更新时间
	 *
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $updatedAt;

	/**
	 * 景区ID
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $scenicAreaId;

	/**
	 * 景区套餐ID
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $scenicSpotPlanId;

	/**
	 * 代理商ID
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $agencyId;

	public function __construct()
	{
	}

	/**
	 * Set the value of id.
	 *
	 * @param int $id
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setId(int $id): Appointment
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
	 * Set the value of name.
	 *
	 * @param string $name
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of phone.
	 *
	 * @param string $phone
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * Get the value of phone.
	 *
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * Set the value of id_card.
	 *
	 * @param string $id_card
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setIdCard($id_card)
	{
		$this->id_card = $id_card;

		return $this;
	}

	/**
	 * Get the value of id_card.
	 *
	 * @return string
	 */
	public function getIdCard()
	{
		return $this->id_card;
	}

	/**
	 * Set the value of status.
	 *
	 * @param string $status
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * Get the value of status.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Set the value of ext.
	 *
	 * @param array $ext
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
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
	 * @return \WeiXin\Entity\Mapping\Appointment
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
	 * @return \WeiXin\Entity\Mapping\Appointment
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

	/**
	 * Set the value of scenic_area_id.
	 *
	 * @param int $scenic_area_id
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setScenicAreaId($scenic_area_id)
	{
		$this->scenic_area_id = $scenic_area_id;

		return $this;
	}

	/**
	 * Get the value of scenic_area_id.
	 *
	 * @return int
	 */
	public function getScenicAreaId()
	{
		return $this->scenic_area_id;
	}

	/**
	 * Set the value of scenic_spot_plan_id.
	 *
	 * @param int $scenic_spot_plan_id
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setScenicSpotPlanId($scenic_spot_plan_id)
	{
		$this->scenic_spot_plan_id = $scenic_spot_plan_id;

		return $this;
	}

	/**
	 * Get the value of scenic_spot_plan_id.
	 *
	 * @return int
	 */
	public function getScenicSpotPlanId()
	{
		return $this->scenic_spot_plan_id;
	}

	/**
	 * Set the value of agency_id.
	 *
	 * @param int $agency_id
	 *
	 * @return \WeiXin\Entity\Mapping\Appointment
	 */
	public function setAgencyId($agency_id)
	{
		$this->agency_id = $agency_id;

		return $this;
	}

	/**
	 * Get the value of agency_id.
	 *
	 * @return int
	 */
	public function getAgencyId()
	{
		return $this->agency_id;
	}

	public function __sleep()
	{
		return array('id', 'name', 'phone', 'id_card', 'status', 'ext', 'created_at', 'updated_at', 'scenic_area_id', 'scenic_spot_plan_id', 'agency_id');
	}
}