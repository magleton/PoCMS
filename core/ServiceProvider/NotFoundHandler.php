<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-8-26
 * Time: 下午4:21
 */

namespace Core\ServiceProvider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class NotFoundHandler implements ServiceProviderInterface
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
        $pimple['notFoundHandler'] = function ($container) {
            return function ($request, $response) use ($container) {
                if (\Core\Utils\CoreUtils::getConfig('customer')['is_rest']) {
                    return $container['response']
                        ->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->withJson(['code' => 1, 'msg' => '404', 'data' => []]);
                } else {
                    $body = new \Slim\Http\Body(@fopen(TEMPLATE_PATH . '404.twig', 'r'));
                    return $container['response']
                        ->withStatus(404)
                        ->withHeader('Content-Type', 'text/html')
                        ->withBody($body);
                }
            };
        };
    }

}