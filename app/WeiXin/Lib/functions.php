<?php

use Noodlehaus\Exception\EmptyDirectoryException;
use Polymer\Boot\Application;

if (!function_exists('checkLogin')) {
    /**
     * 验证用户是否已经登录
     * @author macro chen <macro_fengye@163.com>
     */
    function checkLogin($request, $response, $next)
    {
        $session = app()->component('session');
        $path = $request->getUri()->getPath();
        preg_match("#login$#", $path, $matches);
        if (empty($session->get('username')) && !count($matches)) {
            return $response->withRedirect('/home/login');
        }
        return $next($request, $response);
    }
}

if (!function_exists('checkPermission')) {
    /**
     * 检测用户是否有权访问
     * @author macro chen <macro_fengye@163.com>
     */
    function checkPermission($request, $response, $next)
    {
        return $next($request, $response);
    }
}

if (!function_exists('routeGeneration')) {
    /**
     * 是否重新生成路由文件
     *
     * @return bool
     * @throws EmptyDirectoryException
     */
    function routeGeneration(): bool
    {
        $version = file_get_contents(APP_PATH . 'Cache' . DIRECTORY_SEPARATOR . 'router.lock');
        $currentVersion = Application::getInstance()->getConfig('current_version');
        return ((float)$version !== (float)$currentVersion);
    }
}
