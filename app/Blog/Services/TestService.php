<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 2016/11/14
 * Time: 19:09
 */

namespace Blog\Services;

use Polymer\Exceptions\EntityValidateErrorException;
use Polymer\Service\Service;
use Polymer\Utils\Constants;

class TestService extends Service
{
    /**
     * 验证组件
     *
     * @var RecursiveValidator
     */
    protected $validator = null;

    protected $rules = [
        'name' => [
            'Length' => [
                'min' => 1,
                'max' => 50,
                'minMessage' => "Your first name must be at least {{ limit }} characters long",
                'maxMessage' => "Your first name cannot be longer than {{ limit }} characters"
            ]
        ]
    ];

    public function add()
    {
        try {
            return $this->app->model('company')->save();
        } catch (\Exception $e) {
            return ['errCode' => 90];
        }
    }

    public function update()
    {
        try {
            return $this->app->model('company')->update();
        } catch (\Exception $e) {
            $errors = $this->app->component('error_collection')->all();
            return ['errCode' => 90];
        }
    }
}