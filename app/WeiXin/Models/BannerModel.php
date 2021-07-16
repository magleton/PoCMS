<?php

namespace WeiXin\Models;

use Polymer\Model\Model;
use WeiXin\Dto\BannerDto;

class BannerModel extends Model
{
    /**
     * 添加banner
     * @param BannerDto $bannerDto
     * @return int
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(BannerDto $bannerDto): int
    {
        $obj = $this->make(['filename' => 'aaaa', 'url' => 'http://www.baidu.com']);
        $this->em->persist($obj);
        return 0;
    }
}