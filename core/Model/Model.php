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
     * 验证指定字段是否符合规范
     *
     * @return boolean
     */
    public function validate()
    {
        $classMetadata = $this->validator->getMetadataFor($this->validateObj);
        if (!empty($this->rules)) {
            foreach ($this->rules as $property => $constraint) {
                $constraints = [];
                foreach ($constraint as $cls => $params) {
                    $class = '';
                    if (class_exists('\\Symfony\\Component\\Validator\\Constraints\\' . $cls)) {
                        $class = '\\Symfony\\Component\\Validator\\Constraints\\' . $cls;
                    } elseif (class_exists(APP_NAME . '\\Constraints\\' . $cls)) {
                        $class = APP_NAME . '\\Constraints\\' . $cls;
                    } elseif (class_exists('Core\\Constraints\\' . $cls)) {
                        $class = 'Core\\Constraints\\' . $cls;
                    }
                    if (!empty(trim($class))) $constraints[] = new $class($params);
                }
                $classMetadata->addPropertyConstraints($property, $constraints);
            }
        }
        $error = $this->validator->validate($this->validateObj);
        return $error;
    }
}