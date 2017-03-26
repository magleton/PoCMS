<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 2016/11/14
 * Time: 19:09
 */

namespace WeiXin\Services;

use Polymer\Exceptions\EntityValidateErrorException;
use Polymer\Service\Service;
use Polymer\Utils\Constants;

class TestService extends Service
{
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
            return $this->app->model('company', ['schema' => 'db1'])->update();
        } catch (\Exception $e) {
            echo $e->getMessage();
            $errors = $this->app->component('error_collection')->all();
            print_r($errors);
            return ['errCode' => 90];
        }
    }
}