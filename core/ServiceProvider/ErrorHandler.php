<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-26
 * Time: 下午4:17
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ErrorHandler implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['errorHandler'] = function ($container) {
            return function ($request, $response, $exception) use ($container) {
                $container->register(new \Core\ServiceProvider\LoggerService());
                $container['logger']->error($exception->__toString());
                if (\Core\Utils\CoreUtils::getConfig('customer')['is_rest']) {
                    return $container['response']
                        ->withStatus(500)
                        ->withHeader('Content-Type', 'application/json')
                        ->withJson(['code' => 500, 'msg' => '500 status', 'data' => []]);
                } else {
                    $body = new \Slim\Http\Body(@fopen(TEMPLATE_PATH . 'error.twig', 'r'));
                    return $container['response']
                        ->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->withBody($body);
                };
            };
        };
    }

}