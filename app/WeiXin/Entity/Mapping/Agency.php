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
 * WeiXin\Entity\Mapping\Agency
 *
 * 代理商
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\AgencyRepository")
 * @ORM\Table(name="agency")
 * @ORM\Embedded
 */
class Agency
{
	/**
	 * 主键ID
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected int $id;

	/**
	 * 公司名字
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected $company_name;

	/**
	 * 银行账户
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected string $bankAccount;

	/**
	 * 开户行
	 *
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected string $bankDeposit;

	/**
	 * 余额
	 *
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected int $balance;

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

	public function __construct()
	{
	}

	/**
	 * Set the value of id.
	 *
	 * @param int $id
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
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
	 * Set the value of company_name.
	 *
	 * @param string $company_name
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
	 */
	public function setCompanyName($company_name)
	{
		$this->company_name = $company_name;

		return $this;
	}

	/**
	 * Get the value of company_name.
	 *
	 * @return string
	 */
	public function getCompanyName()
	{
		return $this->company_name;
	}

	/**
	 * Set the value of bank_account.
	 *
	 * @param string $bank_account
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
	 */
	public function setBankAccount($bank_account)
	{
		$this->bank_account = $bank_account;

		return $this;
	}

	/**
	 * Get the value of bank_account.
	 *
	 * @return string
	 */
	public function getBankAccount()
	{
		return $this->bank_account;
	}

	/**
	 * Set the value of bank_deposit.
	 *
	 * @param string $bank_deposit
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
	 */
	public function setBankDeposit($bank_deposit)
	{
		$this->bank_deposit = $bank_deposit;

		return $this;
	}

	/**
	 * Get the value of bank_deposit.
	 *
	 * @return string
	 */
	public function getBankDeposit()
	{
		return $this->bank_deposit;
	}

	/**
	 * Set the value of balance.
	 *
	 * @param int $balance
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
	 */
	public function setBalance($balance)
	{
		$this->balance = $balance;

		return $this;
	}

	/**
	 * Get the value of balance.
	 *
	 * @return int
	 */
	public function getBalance()
	{
		return $this->balance;
	}

	/**
	 * Set the value of created_at.
	 *
	 * @param int $created_at
	 *
	 * @return \WeiXin\Entity\Mapping\Agency
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
	 * @return \WeiXin\Entity\Mapping\Agency
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

	public function __sleep()
	{
		return array('id', 'company_name', 'bank_account', 'bank_deposit', 'balance','ext', 'created_at', 'updated_at');
	}
}