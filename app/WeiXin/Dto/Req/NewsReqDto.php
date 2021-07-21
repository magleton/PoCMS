<?php

namespace WeiXin\Dto\Req;

use Cerbero\Dto\Manipulators\ArrayConverter;
use Cerbero\Dto\Manipulators\ValueConverter;
use Polymer\Dto\BaseDto;

/**
 * @property int $id
 * @property string $title
 * @property int $categoryId
 * @property string $content
 * @property array $ext
 * @property string $testTitle
 * Class NewsReqDto
 * @package WeiXin\Dto\Req
 */
class NewsReqDto extends BaseDto
{
}