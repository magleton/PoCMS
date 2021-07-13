<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use Polymer\Service\Service;
use WeiXin\Models\UserModel;

/**
 * @Injectable()
 * Class HelloService
 * @package WeiXin\Services
 */
class HelloService extends Service
{
    /**
     * HelloService constructor.
     *
     * @Inject
     *
     * @param TestService
     */
    private TestService $testService;
    /**
     * @Inject
     * @var UserModel
     */
    private UserModel $userModel;

    public function hello(): string
    {
        return "我是HelloService返回的字符串 - >>>> " . $this->testService->add() . $this->getDiContainer()->get("username");
    }

    public function getList(): array
    {
        $list = $this->userModel->getList();
        return $list;
    }

    public function save(array $data)
    {
        $save = $this->userModel->save($data);
        print_r($save);
    }
}