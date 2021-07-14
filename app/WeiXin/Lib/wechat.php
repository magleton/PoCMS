<?php
/**
 * @Date 2017-3-23
 * @User macro chen <chen_macro@163.com>
 * @Desc 初始化微信的配置信息
 */

if (!function_exists('weChatConfig')) {
    /**
     * 初始化微信的配置信息
     *
     * @return array
     */
    function weChatConfig()
    {
        return app()->getConfig('wechat')[0];
    }
}

if (!function_exists('initAccessToken')) {
    /**
     * 初始化AccessToken中间件
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param Closure $next
     * @return mixed|\Slim\Http\Response
     */
    function initAccessToken(\Slim\Http\Request $request, \Slim\Http\Response $response, Closure $next)
    {
        app()->component('access_token');
        $response = $next($request, $response);
        return $response;
    }
}
