<?php

namespace CMS\Services;

use Bernard\Message\DefaultMessage;
use Polymer\Service\Service;

class OtherService extends Service
{
    public function EchoTime(\Bernard\Message\DefaultMessage $message)
    {
        echo 'hello message queue'.$message->time;
    }
}
