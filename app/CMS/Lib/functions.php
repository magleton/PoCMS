<?php

use Noodlehaus\Exception\EmptyDirectoryException;

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
        $currentVersion = app()->getConfig('current_version');
        return ((float)$version !== (float)$currentVersion);
    }
}
