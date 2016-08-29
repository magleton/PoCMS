<?php
/**
 * Created by PhpStorm.
 * User: phil
 * Date: 2016/6/20
 * Time: 11:30
 */

$msxf_config = [

    //马上消费银行号的对应关系
    'msxf_bank_map' => [
        '0100' => '邮储银行（100）',
        '0102' => '工商银行（102）',
        '0103' => '农业银行（103）',
        '0104' => '中国银行（104）',
        '0105' => '建设银行（105）',
        '0301' => '交通银行（301）',
        '0302' => '中信银行（302）',
        '0303' => '光大银行（303）',
        '0305' => '民生银行（305）',
        '0306' => '广发银行（306）',
        '0307' => '深发银行（307）',
        '0308' => '招商银行（308）',
        '0309' => '兴业银行（309）',
        '0410' => '平安银行（410）',
    ],

    // 社会身份
    'user_identity' => [
        'SI01' => '学生',
        'SI02' => '在职人员',
        'SI03' => '自由职业',
        'SI04' => '企业负责人',
        'SI05' => '无业',
        'SI06' => '退休',
    ],

    // 婚姻状况
    'marital_status' => [
        '10' => '未婚',
        '20' => '已婚',
        '90' => '其它'
    ],

    // 居住情况
    'user_housing' => [
        '1' => '自置无按揭',
        '2' => '自置有按揭',
        '3' => '亲属楼宇',
        '4' => '集体宿舍',
        '5' => '租房',
        '7' => '其它'
    ],
];

return $msxf_config;