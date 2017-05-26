<?php
/**
 * User: macro chen <chen_macro163.com>
 * Date: 17-3-31
 * Time: 上午9:18
 */

namespace CMS\Services;

use Polymer\Service\Service;

class TestService extends Service
{
    public function testService()
    {
        return $this->app->repository('company')->findOneBy(['id' => 1]);
    }
}