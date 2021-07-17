<?php

namespace WeiXin\Dto;

use Cerbero\Dto\Manipulators\ArrayConverter;
use Cerbero\Dto\Manipulators\ValueConverter;
use Polymer\Dto\BaseDTO;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property ArrayConverter $ext
 * Class NewsDto
 * @package WeiXin\Dto
 */
class NewsDto extends BaseDTO
{
}