<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use Polymer\Service\Service;
use WeiXin\Models\UserModel;

class HelloService extends Service
{
    /**
     * HelloService constructor.
     *
     * @Inject
     * @param TestService $testService
     */
    private TestService $testService;
    /**
     * @Inject
     * @var UserModel
     */
    private UserModel $userModel;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function hello(): string
    {
        return "我是HelloService返回的字符串 - >>>> " . $this->testService->add() . $this->getDiContainer()->get("username");
    }
}