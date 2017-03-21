<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 2016/11/14
 * Time: 19:09
 */

namespace Blog\Services;

use Polymer\Service\Service;

class TestService extends Service
{
    public function test()
    {
        return [
            'name' => 'Macro Chen',
            'age' => 12
        ];
    }

    public function abc()
    {
        return 3;
    }

    public function add()
    {
        try {
            return $this->app->model('address')->save();
        } catch (\Exception $e) {
            return ['errCode' => 90];
        }
    }
}