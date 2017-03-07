<?php
/**
 * User: macro chen <macro_fengye@163.com>
 * Date: 2016/10/26
 * Time: 19:42
 */

namespace Polymer\Model;

use Doctrine\DBAL\Sharding\PoolingShardManager;
use Doctrine\ORM\EntityManager;
use Polymer\Boot\Application;
use Polymer\Exceptions\EntityValidateErrorException;
use Polymer\Utils\Constants;
use Symfony\Component\Validator\Exception\NoSuchMetadataException;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class Model
{
    /**
     * 应用APP
     *
     * @var Application
     */
    protected $app = null;

    /**
     * 验证组件
     *
     * @var RecursiveValidator
     */
    protected $validator = null;

    /**
     * 要验证的实体对象
     *
     * @var null
     */
    private $EntityObject = null;

    /**
     * 验证器的规则
     *
     * @var array
     */
    protected $validateRules = [];

    /**
     * EntityManager实例
     *
     * @var EntityManager
     */
    protected $em = null;

    /**
     * 模型构造函数
     *
     * Model constructor.
     */
    public function __construct()
    {
        $this->app = app();
        $this->validator = $this->app->component('validator');
    }

    /**
     * 生成数据库表的实体对象
     *
     * @param int $target
     * @param array $data
     * @param null $entityFolder
     * @param array $rules
     *
     * @throws \Exception
     * @return Object
     */
    protected function make($target = Constants::MODEL_FIELD, array $data = [], $entityFolder = null, array $rules = [])
    {
        try {
            $validator = $this->app->component('validator');
            if (Constants::MODEL_OBJECT) {
                if (null === $entityFolder) {
                    $entityFolder = property_exists($this, 'entityFolder') ? $this->entityFolder : null;
                }
                if (!$this->EntityObject) {
                    $this->EntityObject = $this->app->entity($this->table, $entityFolder);
                }
                $validator = $validator->setProperty('EntityObject', $this->EntityObject);
            }
            $validateRules = $rules ?: $this->validateRules;
            $validator = $validator->setProperty('validateRules', $validateRules);
            if (property_exists($this, 'mappingField')) {
                $validator = $validator->setProperty('mappingField', $this->mappingField);
            }
            $validator->validate($target, $data, $this->table);
            if ($this->app->component('error_collection')->get($this->table)) {
                throw new EntityValidateErrorException('实体验证错误!');
            }
            return $this->EntityObject;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * 切换数据库的链接
     *
     * @param int $shardId
     * @return boolean
     * @throws \Exception
     */
    protected function switchConnect($shardId)
    {
        try {
            return $this->em->getConnection()->connect((int)$shardId);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * 获取PoolingShardManager实例，用于全局查询
     *
     * @return PoolingShardManager|null
     */
    protected function sharedManager()
    {
        if ($this->em) {
            return new PoolingShardManager($this->em->getConnection());
        }
        return null;
    }

    /**
     * 给对象新增属性
     *
     * @param $propertyName
     * @param $value
     * @return $this
     */
    protected function setProperty($propertyName, $value)
    {
        if (!isset($this->$propertyName) || !$this->$propertyName) {
            $this->$propertyName = $value;
        }
        return $this;
    }

    /**
     * 获取对象属性
     *
     * @param $propertyName
     * @return mixed
     */
    protected function getProperty($propertyName)
    {
        if (!isset($this->$propertyName)) {
            return $this->$propertyName;
        }
        return null;
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return $this
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * is triggered by calling isset() or empty() on inaccessible members.
     *
     * @param $name string
     * @return bool
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __isset($name)
    {
        return isset($this->$name);
    }
}