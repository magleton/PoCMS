<?php
if (!function_exists('routeGeneration')) {
    /**
     * 是否重新生成路由文件
     *
     * @return bool
     */
    function routeGeneration()
    {
        $version = file_get_contents(APP_PATH . 'Cache' . DIRECTORY_SEPARATOR . 'router.lock');
        $currentVersion = app()->config('current_version');
        return ((float)$version !== (float)$currentVersion);
    }
}
