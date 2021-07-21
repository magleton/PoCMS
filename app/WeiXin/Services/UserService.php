<?php

namespace WeiXin\Services;

use Cerbero\Dto\Exceptions\UnknownDtoPropertyException;
use DI\Annotation\Inject;
use JsonException;
use Polymer\Service\Service;
use WeiXin\Dto\UserLoginDto;
use WeiXin\Dao\UserDao;

class UserService extends Service
{
    /**
     * @Inject
     * @var UserDao
     */
    private UserDao $userModel;

    /**
     * 用户登录
     * @param UserLoginDto $userLoginDto
     * @return string
     * @throws UnknownDtoPropertyException
     * @throws JsonException
     */
    public function login(UserLoginDto $userLoginDto): string
    {
        $tokenSecretKey = $this->application->getConfig('tokenSecretKey');
        $username = $userLoginDto->get('username');
        $password = $userLoginDto->get('password');
        $user = $this->userModel->getUserByUsernameAndPassword($username, $password);
        $data = [
            'userId' => $user->getId(),
            'phone' => $user->getPhone(),
            'username' => $user->getUsername()
        ];
        return authCode(json_encode($data, JSON_THROW_ON_ERROR), $tokenSecretKey, 'ENCODE');
    }
}