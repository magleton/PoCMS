<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 17-5-26
 * Time: 上午9:46
 */

namespace CMS\Services;


use Bernard\Message\DefaultMessage;
use Polymer\Service\Service;

class EchoTimeService extends Service
{
    public function EchoTime(DefaultMessage $message)
    {
echo 'bbbbbbbbbbbbbbbb';
    }
}