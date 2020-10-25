<?php

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;

/**
 * WeiXin\Entity\Mapping\UserProfile
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\UserProfileRepository")
 * @ORM\Table(name="user_profile", indexes={@ORM\Index(name="fk_user_profile_user_idx", columns={"user_id"})})
*/
class UserProfile
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $profile_id;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $user_id;

	/**
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	protected $content;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $created_at;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $updated_at;

	/**
	 * @ORM\ManyToOne(targetEntity="WeiXin\Entity\Mapping\User", inversedBy="user_profiles")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
	 */
	protected $user;

	public function __construct()
	{
	}

	/**
	 * Set the value of profile_id.
	 *
	 * @param int $profile_id
	 *
	 * @return \WeiXin\Entity\Mapping\UserProfile
	 */
	public function setProfileId($profile_id)
	{
		$this->profile_id = $profile_id;

		return $this;
	}

	/**
	 * Get the value of profile_id.
	 *
	 * @return int
	 */
	public function getProfileId()
	{
		return $this->profile_id;
	}

	/**
	 * Set the value of user_id.
	 *
	 * @param int $user_id
	 *
	 * @return \WeiXin\Entity\Mapping\UserProfile
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
	 * Set the value of content.
	 *
	 * @param string $content
	 *
	 * @return \WeiXin\Entity\Mapping\UserProfile
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get the value of content.
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set the value of created_at.
	 *
	 * @param int $created_at
	 *
	 * @return \WeiXin\Entity\Mapping\UserProfile
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
	 * @return \WeiXin\Entity\Mapping\UserProfile
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
	 * Set User entity (many to one).
	 *
	 * @param \WeiXin\Entity\Mapping\User $user
	 *
	 * @return \WeiXin\Entity\Mapping\UserProfile
	 */
	public function setUser($user)
	{
		$this->user = $User;

		return $this;
	}

	/**
	 * Get User entity (many to one).
	 *
	 * @return \WeiXin\Entity\Mapping\User
	 */
	public function getUser()
	{
		return $this->user;
	}

	public function __sleep()
	{
		return array('profile_id', 'user_id', 'content', 'created_at', 'updated_at');
	}
}