<?php


namespace WeiXin\Aspect;


use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

class MonitorAspect implements Aspect
{
    /**
     * Method that will be called before real method
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("execution(public WeiXin\Services\HelloService->*(*))")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        echo 'Calling Before Interceptor for: ',
        $invocation,
        ' with arguments: ',
        json_encode($invocation->getArguments()),
        "<br>\n";
    }
}