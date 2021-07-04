<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Polymer\Service\Service;

class HelloService extends Service
{
    /**
     * HelloService constructor.
     *
     * @Inject
     * @param TestService $testService
     */
    private TestService $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function hello()
    {
        return "我是HelloService返回的字符串 - >>>> " . $this->testService->add();
    }
}