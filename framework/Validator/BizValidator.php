<?php
/**
 * User: macro chen <macro_fengye@163.com>
 * Date: 17-3-7
 * Time: 上午9:57
 */

namespace Polymer\Validator;

use Symfony\Component\Validator\Validator\RecursiveValidator;
use Polymer\Boot\Application;
use Polymer\Utils\Constants;
use Symfony\Component\Validator\Exception\NoSuchMetadataException;

class BizValidator
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
     * 验证器的规则
     *
     * @var array
     */
    protected $validateRules = [];

    /**
     * 要验证的实体对象
     *
     * @var null
     */
    private $EntityObject = null;

    /**
     * 表单映射字段
     *
     * @var array
     */
    private $mappingField = [];

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        try {
            $this->app = app();
            $this->validator = $this->app->component('biz_validator');
        } catch (\InvalidArgumentException $e) {
            $this->validator = null;
        }
    }

    /**
     * 验证对象,可通过参数指定要验证的目标
     *
     * @param array $data 验证数据
     * @param int $target 验证类型
     * @param string $key 错误信息的key，用于获取错误信息
     *
     * @throws \Exception
     */
    public function validate($target = Constants::MODEL_FIELD, array $data = [], $key = 'error')
    {
        $key = $key ?: 'error';
        $data = $this->mergeParams($data);
        $target === Constants::MODEL_FIELD ? $this->validateFields($data, $key) : $this->validateObject($data, $key);
    }

    /**
     * 根据自定义的规则验证数据字段
     *
     * @param array $data 验证数据
     * @param string $key 错误信息的key，用于获取错误信息
     * @return array
     */
    private function validateFields(array $data = [], $key = 'error')
    {
        $returnData = [];
        if ($this->validateRules) {
            foreach ($data as $property => $val) {
                if (isset($this->validateRules[$property])) {
                    $constraints = $this->propertyConstraints($property);
                    $errors = $this->validator->validate($val, $constraints);
                    if (count($errors)) {
                        foreach ($errors as $error) {
                            $returnData[$property] = $error->getMessage();
                        }
                    }
                }
            }
        }
        $returnData === [] ?: $this->app->component('error_collection')->set($key, $returnData);
    }

    /**
     * 给对象赋值并且验证对象的值是否合法
     *
     * @param array $data 验证数据
     * @param string $key 错误信息的key,用于获取错误信息
     * @throws NoSuchMetadataException
     * @return array
     */
    private function validateObject(array $data = [], $key = 'error')
    {
        if ($this->EntityObject) {
            foreach ($data as $k => $v) {
                $setMethod = 'set' . ucfirst(str_replace(' ', '', lcfirst(ucwords(str_replace('_', ' ', $k)))));
                if (method_exists($this->EntityObject, $setMethod)) {
                    $this->EntityObject->$setMethod($v);
                }
            }
            try {
                $classMetadata = $this->validator->getMetadataFor($this->EntityObject);
                foreach ($classMetadata->getReflectionClass()->getProperties() as $val) {
                    if (!isset($data[$val->getName()])) {
                        $data[$val->getName()] = '';
                    }
                }
                if ($this->validateRules) {
                    foreach ($data as $property => $val) {
                        if (isset($this->validateRules[$property])) {
                            $constraints = $this->propertyConstraints($property);
                            $classMetadata->addPropertyConstraints($property, $constraints);
                        }
                    }
                }
                $errors = $this->validator->validate($this->EntityObject);
                if (count($errors)) {
                    foreach ($errors as $error) {
                        $returnData[$error->getPropertyPath()] = $error->getMessage();
                    }
                    $this->app->component('error_collection')->set($key, $returnData);
                }
            } catch (NoSuchMetadataException $e) {
                throw $e;
            }
        } else {
            throw new NoSuchMetadataException();
        }
    }

    /**
     * 实例化指定属性的验证器类
     *
     * @param string $property
     * @return array
     */
    private function propertyConstraints($property)
    {
        $constraints = [];
        foreach ($this->validateRules[$property] as $cls => $params) {
            if (is_numeric($cls)) {
                $cls = $params;
                $params = null;
            }
            $class = $this->getConstraintClass($cls);
            if (!empty(trim($class))) {
                $constraints[] = new $class($params);
            }
        }
        return $constraints;
    }

    /**
     * 根据类名获取类的全名
     *
     * @param string $cls
     * @return string
     */
    private function getConstraintClass($cls = '')
    {
        $class = '';
        if (class_exists('\\Symfony\\Component\\Validator\\Constraints\\' . $cls)) {
            $class = '\\Symfony\\Component\\Validator\\Constraints\\' . $cls;
            return $class;
        } elseif (class_exists(APP_NAME . '\\Constraints\\' . $cls)) {
            $class = APP_NAME . '\\Constraints\\' . $cls;
            return $class;
        } elseif (class_exists('Polymer\\Constraints\\' . $cls)) {
            $class = 'Polymer\\Constraints\\' . $cls;
            return $class;
        }
        return $class;
    }

    /**
     * 合并请求参数数据与自定义参数数据
     *
     * @param array $data 需要验证的数据
     * @return array
     * @throws \Exception
     */
    private function mergeParams(array $data = [])
    {
        $data = array_merge($this->app->component('request')->getParams(), $data);
        if ($this->mappingField) {
            $combineData = [];
            foreach ($data as $key => $value) {
                isset($this->mappingField[$key]) ? $combineData[$this->mappingField[$key]] = $value : $combineData[$key] = $value;
            }
            return $combineData;
        }
        return $data;
    }

    /**
     * 给对象新增属性
     *
     * @param $propertyName
     * @param $value
     * @return $this
     */
    public function setProperty($propertyName, $value)
    {
        $this->$propertyName = $value;
        return $this;
    }

    /**
     * 获取对象属性
     *
     * @param $propertyName
     * @return mixed
     */
    public function getProperty($propertyName)
    {
        if (isset($this->$propertyName)) {
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