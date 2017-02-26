<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26
 * Time: 19:52
 */

namespace Blog\Models;


use Polymer\Model\Model;
use Polymer\Utils\Constants;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AddressModel extends Model
{
    /**
     * 需要链接的数据配置
     *
     * @var string
     */
    private $schemaName = 'db1';

    /**
     * 数据库表名
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * 验证规则
     *
     * @var array
     */
    protected $rules = [
        'address' => [
            'NotBlank' => ['message' => 'address不能为空'],
            'Length' => [
                'min' => 8,
                'max' => 16,
                'minMessage' => '不能少于8',
                'maxMessage' => '不能大于16'
            ],
        ]
        /*'address' => [
            'NotBlank' => ['message' => 'address不能为空'],
            'Length' => [
                'min' => 8,
                'max' => 16,
                'minMessage' => '不能少于8',
                'maxMessage' => '不能大于16'
            ],
            'Email' => [
                'message' => "The email '{{ value }}' is not a valid email.",
                'checkMX' => true
            ],
            'Regex' => [
                'pattern' => "/\d/",
                'match' => false,
                'message' => "Your name cannot contain a number"
            ],*/
        //'Callback' => ['Polymer\Utils\FuncUtils', 'validate'],

        /*'ContainsAlphanumeric'=>[
            'message'=>'mmkk'
        ]
    ],
    'info'=>[
        'NotBlank'=>['message'=>'jjkkll']
    ],*/
    ];

    protected $mappingField = [
        'dd' => 'address',
        'address_info' => 'info'
    ];

    public function save()
    {
        try {
            $addressObj = $this->make(Constants::MODEL_OBJECT);
            $userObj = $this->app->model('user');
            $em = $this->app->db();
            $em->persist($addressObj);
            $em->flush();
        } catch (\Exception $e) {
            echo $e->getMessage();
            print_r(($this->errors));
        }
    }
}