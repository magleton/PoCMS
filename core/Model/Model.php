<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 19:42
 */

namespace Core\Model;

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

    public function __construct()
    {
        $this->app = app();
        $this->validator = $this->app->component('validator');
    }

    /**
     * 验证指定对象的指定字段
     *
     * @return mixed
     */
    public function validateObject()
    {
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
        $error = $this->validator->validate($this->validateObj);
        return $error;
    }

    /**
     * 验证用户提交的表单数据
     *
     * @param array $data
     * @throws \Exception
     */
    public function validateField(array $data)
    {
        $data = array_merge($this->app->component('request')->getParams(), $data);
        if ($data) {
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
}