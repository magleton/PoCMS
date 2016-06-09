<?php
function registerCustomerContainer($pimpleContainer)
{
    $pimpleContainer['event_dispatcher'] = function (\Slim\Container $container) {
        return new \Symfony\Component\EventDispatcher\EventDispatcher();
    };
    // imgine awesome service is expensive and should be lazy loaded
    $pimpleContainer['awesome_service'] = function (\Slim\Container $container) {
        return $container['lazy_service_factory']->getLazyServiceDefinition(\Blog\Service\AwesomeService::class, function () {
            return new \Blog\Service\AwesomeService();
        });
    };
    $pimpleContainer['another_service'] = function (\Slim\Container $container) {
        // this one will receive proxy object
        return new \Blog\Service\AnotherService($container['awesome_service']);
    };
    $pimpleContainer['event_emitting_service'] = function (\Slim\Container $container) {
        return new \Blog\Service\EventEmittingService($container['event_dispatcher']);
    };
    $pimpleContainer['first_subscriber'] = function (\Slim\Container $container) {
        // subscriber has no idea it will be lazy loaded
        return new \Blog\subscriber\FirstSubscriber($container['awesome_service']);
    };
    $pimpleContainer['awesome_service_aware'] = function (\Slim\Container $container) {
        return new \Blog\service\serviceToExtend\AwesomeServiceAwareClass();
    };
    $pimpleContainer['both_interfaces_aware'] = function (\Slim\Container $container) {
        return new \Blog\service\serviceToExtend\BothInterfacesAwareClass();
    };
    $pimpleContainer->register(new \Spiechu\LazyPimple\DependencyInjection\MultiServiceAwareExtender([
        new \Spiechu\LazyPimple\DependencyInjection\ExtendServiceDefinition('awesome_service', \Blog\service\serviceToExtend\AwesomeServiceAwareInterface::class, 'setAwesomeService'),
        new \Spiechu\LazyPimple\DependencyInjection\ExtendServiceDefinition('event_dispatcher', \Blog\service\serviceToExtend\EventDispatcherAwareInterface::class, 'setEventDispatcher'),
    ]));
    $pimpleContainer->register(new \Spiechu\LazyPimple\DependencyInjection\LazyEventSubscriberServiceProvider(
        $pimpleContainer['lazy_service_factory'],
        // we're defining which service resolves to EventDispatcher
        'event_dispatcher',
        [
            // we're defining subscribers
            'first_subscriber' => \Blog\subscriber\FirstSubscriber::class,
        ]
    ));
    return $pimpleContainer;
}