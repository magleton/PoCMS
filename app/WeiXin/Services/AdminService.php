<?php

namespace WeiXin\Services;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;
use JsonException;
use Polymer\Service\Service;
use WeiXin\Dto\AdminDto;
use WeiXin\Models\AdminModel;

/**
 * @Injectable
 * Class AdminService
 * @package WeiXin\Services
 */
class AdminService extends Service
{
    /**
     * @Inject
     * @var AdminModel
     */
    private AdminModel $adminModel;

    /**
     * 管理员登录
     * @param AdminDto $adminDto
     * @return string
     * @throws JsonException
     */
    public function login(AdminDto $adminDto): string
    {
        $username = $adminDto->username;
        $password = $adminDto->password;
        return $this->adminModel->login($username, $password);
    }

    /**
     * 根据token获取管理员信息
     * @throws JsonException
     */
    public function getAdminInfo(adminDto $adminDto): array
    {
        return $this->adminModel->getAdminInfo($adminDto->token);
    }
}