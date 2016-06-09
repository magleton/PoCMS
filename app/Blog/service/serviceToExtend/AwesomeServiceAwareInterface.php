<?php

namespace Blog\service\serviceToExtend;

use Spiechu\LazyPimple\Service\AwesomeService;

interface AwesomeServiceAwareInterface
{
    /**
     * @param AwesomeService $awesomeService
     */
    public function setAwesomeService(AwesomeService $awesomeService);
}
