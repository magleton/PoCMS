<?php

namespace WeiXin\Models;

use Doctrine\ORM\Events;
use Exception;
use Polymer\Support\Collection;
use Polymer\Tests\Listener\BaseListener;
use Slim\Logger;
use WeiXin\Entity\Mapping\Admin;
use WeiXin\Entity\Mapping\User;
use WeiXin\Entity\Mapping\Users;
use WeiXin\Validators\PhoneValidator;

/**
 * @Injectable
 * Class UserModel
 * @package WeiXin\Models
 */
class UserModel
{
    /**
     * 数据库表名
     * @var string
     */
    protected string $table = 'user';

    /**
     * 验证规则
     *
     * @var array
     */
    protected array $rules = [
        'username' => [
            'Length' => [
                'min' => 2,
                'max' => 50,
                'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                'groups' => ['registration', 'add'],
            ],
            //'NotBlank' => ['groups' => ['add'], 'message' => '该字段不能为空']
        ],
        /*'address' => [
            'Callback' => [
                'callback' => [AddressValidator::class, 'validate'],
                'groups' => ['add']
            ]
        ]*/
        'phone' => [
            'Callback' => [
                'callback' => [PhoneValidator::class, 'validate'],
                'groups' => ['add', 'update']
            ]
        ]
    ];

    /**
     * 数据库配置
     * @var string
     */
    protected string $schema = 'db1';

    /**
     * 实体命名空间
     *
     * @var string
     */
    protected string $entityNamespace = 'WeiXin\Entity\Mapping';

    /**
     * 实体文件的文件系统路径
     *
     * @var string
     */
    protected string $entityFolder = ROOT_PATH . '/Entity/Models';

    /**
     * Repository的命名空间
     *
     * @var string
     */
    protected string $repositoryNamespace = 'WeiXin\Entity\Repositories';

    /**
     * 需要排除的字段
     *
     * @var array
     */
    protected array $excludeField = ['id'];

    /**
     * 映射字段
     *
     * @var array
     */
    protected array $mappingField = ['KK_NAME' => 'name'];

    /**
     * 保存数据
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function save(array $data = [])
    {
        try {
            $this->application->addEvent([Events::prePersist => ['class_name' => BaseListener::class]]);
            $obj = $this->make(Admin::class, $data)->validate($this->rules, ['add']);
            $this->em->persist($obj);
            $this->em->flush();
            return $obj->getId();
        } catch (Exception $e) {
            $this->application->get(Logger::class)->error($this->application->get(Collection::class)->all());
            throw $e;
        }
    }


    /**
     * 更新数据
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function update(array $data = [])
    {
        try {
            /*$this->app->addEvent([
                Events::preUpdate => [
                    'class_name' => TestListener::class,
                    'data' => ['address' => 'aaaaa']
                ]
            ]);*/
            $obj = $this->make(User::class, $data, ['user_id' => 1], false)->validate($this->rules, ['update']);
            $this->em->persist($obj);
            $this->em->flush();
            return $obj->getId();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 通过用户用户名密码查找用户
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @return array
     */
    public function getUserByUsernameAndPassword(string $username, string $password): Admin
    {
        $criteria = [
            'username' => $username,
            'password' => $password
        ];
        return $this->em->getRepository(Admin::class)->findOneBy($criteria);
    }

    public function getList(): array
    {
        $entityRepository = $this->em->getRepository(Users::class);
        $list = $entityRepository->findAll();
        return $list;
    }
}