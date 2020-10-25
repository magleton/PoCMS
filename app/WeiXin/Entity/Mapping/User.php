<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeiXin\Entity\Mapping\User
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $user_id;

	/**
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected $username;

	/**
	 * @ORM\Column(type="string", length=11, nullable=true)
	 */
	protected $phone;

	/**
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected $open_id;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $last_login_at;

	/**
	 * @ORM\Column(type="integer", nullable=true, options={"unsigned": true})
	 */
	protected $cerated_at;

	/**
	 * @ORM\Column(type="integer", nullable=true, options={"unsigned": true})
	 */
	protected $updated_at;

	/**
	 * @ORM\OneToMany(targetEntity="WeiXin\Entity\Mapping\UserProfile", mappedBy="user")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
	 */
	protected $user_profiles;

	public function __construct()
	{
		$this->user_profiles = new ArrayCollection();
	}

	/**
	 * Set the value of user_id.
	 *
	 * @param int $user_id
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function setUserId($user_id)
	{
		$this->user_id = $user_id;

		return $this;
	}

	/**
	 * Get the value of user_id.
	 *
	 * @return int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Set the value of username.
	 *
	 * @param string $username
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get the value of username.
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set the value of phone.
	 *
	 * @param string $phone
	 *
	 * @return \WeiXin\Entity\Mapping\User
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
	 * Set the value of open_id.
	 *
	 * @param string $open_id
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function setOpenId($open_id)
	{
		$this->open_id = $open_id;

		return $this;
	}

	/**
	 * Get the value of open_id.
	 *
	 * @return string
	 */
	public function getOpenId()
	{
		return $this->open_id;
	}

	/**
	 * Set the value of last_login_at.
	 *
	 * @param int $last_login_at
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function setLastLoginAt($last_login_at)
	{
		$this->last_login_at = $last_login_at;

		return $this;
	}

	/**
	 * Get the value of last_login_at.
	 *
	 * @return int
	 */
	public function getLastLoginAt()
	{
		return $this->last_login_at;
	}

	/**
	 * Set the value of cerated_at.
	 *
	 * @param int $cerated_at
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function setCeratedAt($cerated_at)
	{
		$this->cerated_at = $cerated_at;

		return $this;
	}

	/**
	 * Get the value of cerated_at.
	 *
	 * @return int
	 */
	public function getCeratedAt()
	{
		return $this->cerated_at;
	}

	/**
	 * Set the value of updated_at.
	 *
	 * @param int $updated_at
	 *
	 * @return \WeiXin\Entity\Mapping\User
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
	 * Add UserProfile entity to collection (one to many).
	 *
	 * @param \WeiXin\Entity\Mapping\UserProfile $user_profile
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function addUserProfile($user_profile)
	{
		$this->user_profiles[] = $user_profile;

		return $this;
	}

	/**
	 * Remove UserProfile entity from collection (one to many).
	 *
	 * @param \WeiXin\Entity\Mapping\UserProfile $user_profile
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function removeUserProfile($user_profile)
	{
		$this->user_profiles->removeElement($user_profile);

		return $this;
	}

	/**
	 * Get UserProfile entity collection (one to many).
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getUserProfiles()
	{
		return $this->user_profiles;
	}

	public function __sleep()
	{
		return array('user_id', 'username', 'phone', 'open_id', 'last_login_at', 'cerated_at', 'updated_at');
	}
}