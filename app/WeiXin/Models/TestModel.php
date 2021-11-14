<?php

namespace WeiXin\Models;

use Doctrine\ORM\Events;
use Exception;
use Polymer\Tests\Listener\BaseListener;

class TestModel
{
    /**
     * 数据库表名
     * @var string
     */
    protected string $table = 'test';

    /**
     * 验证规则
     *
     * @var array
     */
    protected array $rules = [
        'name' => [
            'Length' => [
                'min' => 1,
                'max' => 50,
                'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
                'groups' => ['registration'],
            ],
            'NotBlank' => ['groups' => ['add'], 'message' => '该字段不能为空']
        ]/*,
        'address' => [
            'Callback' => [
                'callback' => [AddressValidator::class, 'validate'],
                'groups' => ['add']
            ]
        ]*/
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
    protected string $entityFolder = ROOT_PATH . '/Entity/Mapping';

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
            //$this->app->addEvent([Events::prePersist => ['class_name' => TestListener::class]]);
            $obj = $this->make($data)->validate($this->rules, ['add']);
            $this->em->persist($obj);
            $this->em->flush();
            return $obj->getId();
        } catch (Exception $e) {
            print_r($this->application->component('error_collection')->all());
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
            $this->application->addEvent([
                Events::preUpdate => [
                    'class_name' => BaseListener::class,
                    'data' => ['address' => 'aaaaa']
                ]
            ]);
            $obj = $this->make($data, ['id' => 33], true);
            $this->em->persist($obj);
            $this->em->flush();
            return $obj->getId();
        } catch (Exception $e) {
            throw $e;
        }
    }
}