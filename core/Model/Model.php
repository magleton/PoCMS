<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 19:42
 */

namespace Core\Model;

use Core\Utils\Constants;

class Model
{
    /**
     * 数据库表名
     *
     * @var string
     */
    protected $table = '';

    /**
     * 验证规则
     *
     * @var array
     */
    protected $rules = [];

    /**
     * 应用APP
     *
     * @var null
     */
    protected $app = null;

    /**
     * 验证组件
     *
     * @var null
     */
    protected $validator = null;

    /**
     * 要验证的对象
     *
     * @var null
     */
    protected $validateObj = null;

    /**
     * 表单字段映射
     *
     * @var array
     */
    protected $mappingField = [];

    /**
     * 表的主键
     * @var string
     */
    protected $primaryKey = '';

    /**
     * 验证器的分组
     *
     * @var array
     */
    protected $validateGroups = [];

    public function __construct()
    {
        $this->app = app();
        $this->validator = $this->app->component('validator');
        $this->validateObj = $this->app->entity($this->table);
    }

    /**
     * 生成数据库表的实体对象，并设置值
     *
     * @param int $target
     * @param array $data
     */
    protected function makeEntity($target = Constants::MODEL_FIELD, array $data = [])
    {
        try {
            $this->validate(Constants::MODEL_FIELD, $data);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $cls
     *
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
        } elseif (class_exists('Core\\Constraints\\' . $cls)) {
            $class = 'Core\\Constraints\\' . $cls;
            return $class;
        }
        return $class;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function mergeParams(array $data = [])
    {
        if ($this->mappingField) {
            $data = array_merge(array_combine($this->mappingField, $this->app->component('request')->getParams()), $data);
            return $data;
        } else {
            $data = array_merge($this->app->component('request')->getParams(), $data);
            return $data;
        }
        return $data;
    }

    /**
     * 给实体验证对象设置值
     * @param int $target
     * @param array $data
     * @throws \Exception
     * @return mixed
     */
    private function validate($target = Constants::MODEL_FIELD, array $data = [])
    {
        $data = $this->mergeParams($data);
        switch ($target) {
            case Constants::MODEL_FIELD:
                foreach ($data as $key => $val) {
                    if (isset($this->rules[$key])) {
                        $constraints = [];
                        foreach ($this->rules[$key] as $cls => $params) {
                            $class = $this->getConstraintClass($cls);
                            if (!empty(trim($class))) $constraints[] = new $class($params);
                        }
                        $errors = $this->validator->validate($val, $constraints);
                        if (count($errors)) {
                            $errorsString = (string)$errors;
                            throw new \Exception($errorsString);
                        }
                    }
                }
                break;
            case Constants::MODEL_OBJECT:
                foreach ($data as $k => $v) {
                    $setMethod = 'set' . ucfirst(str_replace(' ', '', lcfirst(ucwords(str_replace('_', ' ', $k)))));
                    if (method_exists($this->validateObj, $setMethod)) {
                        $this->validateObj->$setMethod($v);
                    }
                }
                $classMetadata = $this->validator->getMetadataFor($this->validateObj);
                if (!empty($this->rules)) {
                    foreach ($this->rules as $property => $constraint) {
                        $constraints = [];
                        foreach ($constraint as $cls => $params) {
                            $class = $this->getConstraintClass($cls);
                            if (!empty(trim($class))) $constraints[] = new $class($params);
                        }
                        $classMetadata->addPropertyConstraints($property, $constraints);
                    }
                }
                $errors = $this->validator->validate($this->validateObj);
                if (count($errors)) {
                    $errorsString = (string)$errors;
                    throw new \Exception($errorsString);
                }
                break;
            default:
                break;
        }
        return $this->validateObj;
    }
}