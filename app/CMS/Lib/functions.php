<?php
function haha()
{
    echo "ooooooooo";
}

/**
 * 检测用户是否已经登录
 * @author macro chen <macro_fengye@163.com>
 * @param $request
 * @param $response
 * @param $next
 * @return mixed
 */
function checkLogin($request, $response, $next)
{
    return $next($request, $response);
}

/**
 * 检测用户是否有权限访问
 * @author macro chen <macro_fengye@163.com>
 * @param $request
 * @param $response
 * @param $next
 * @return mixed
 */
function checkPermission($request, $response, $next)
{
    return $next($request, $response);
}
