<?php

namespace WeiXin\Models;

use Doctrine\ORM\ORMException;
use Polymer\Model\Model;
use WeiXin\Dto\BannerDto;

class BannerModel extends Model
{
    /**
     * 数据库配置
     * @var string
     */
    protected string $schema = 'db1';
    /**
     * 数据库表名
     * @var string
     */
    protected string $table = 'banner';

    /**
     * 添加banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws ORMException
     */
    public function save(BannerDto $bannerDto): int
    {
        $obj = $this->make(['filename' => 'aaaa', 'url' => 'http://www.baidu.com'] );
        $this->em->persist($obj);
        $this->em->flush();
        return 0;
    }
}