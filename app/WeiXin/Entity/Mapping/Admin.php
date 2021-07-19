<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.1.4 (doctrine2-annotation 3.1.3) on 2021-07-17 02:43:05.
 * Goto
 * https://github.com/mysql-workbench-schema-exporter/mysql-workbench-schema-exporter
 * for more information.
 */

namespace WeiXin\Entity\Mapping;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * WeiXin\Entity\Mapping\Admin
 *
 * @ORM\Entity(repositoryClass="WeiXin\Entity\Repositories\AdminRepository")
 * @ORM\Table(name="admin")
 */
class Admin
{
    /**
     * 主键
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * 用户名
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $username;

    /**
     * 密码
     *
     * @ORM\Column(name="`password`", type="string", length=45, nullable=true)
     */
    protected $password;

    /**
     * 电话号码
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $phone;

    /**
     * 电子邮箱
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $email;

    /**
     * 昵称
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $nickname;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $updated_at;

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
     * Set the value of id.
     *
     * @param int $id
     *
     * @return Admin
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Set the value of username.
     *
     * @param string $username
     *
     * @return Admin
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     *
     * @return Admin
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Set the value of phone.
     *
     * @param string $phone
     *
     * @return Admin
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of idCard.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of idCard.
     *
     * @param string $email
     *
     * @return Admin
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nickname.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname.
     *
     * @param string $nickname
     *
     * @return Admin
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

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
     * Set the value of created_at.
     *
     * @param int $created_at
     *
     * @return Admin
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

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
     * Set the value of updated_at.
     *
     * @param int $updated_at
     *
     * @return Admin
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function __sleep()
    {
        return array('id', 'username', 'password', 'open_id', 'phone', 'idCard', 'nickname', 'created_at', 'updated_at');
    }
}