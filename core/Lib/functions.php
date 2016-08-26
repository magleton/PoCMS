<?php
/**
 * 字节转换
 *
 * @param $size
 * @return string
 */
function convert($size)
{
    $unit = array('b', 'KB', 'MB', 'GB', 'TB', 'PB');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

/**
 * URL参数安全base64
 *
 * @author macro chen <macro_fengye@163.com>
 * @param string $string
 * @param string $operation ENCODE|DECODE
 * @return string
 */
function urlSafeBase64Code($string, $operation = 'ENCODE')
{
    $searchKws = array('+', '/', '=');
    $replaceKws = array('-', '_', '');
    if ($operation == 'DECODE') {
        $ret = base64_decode(str_replace($replaceKws, $searchKws, $string));
    } else {
        $ret = str_replace($searchKws, $replaceKws, base64_encode($string));
    }
    return $ret;
}

/**
 * discuz算法数据加解密
 *
 * @author macro chen <macro_fengye@163.com>
 * @param string $string 加解密字符串
 * @param string $key 密钥
 * @param string $operation 加密或解密操作 ENCODE|DECODE
 * @param integer $expiry 加密字符串过期时间
 * @return string
 */
function authCode($string, $key, $operation = 'DECODE', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ?
        urlSafeBase64Code(substr($string, $ckey_length), 'DECODE')
        : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . urlSafeBase64Code($result, 'ENCODE');
    }
}


/**
 * 获取客户端真实IP
 *
 * @author macro chen <macro_fengye@163.com>
 */
function getIP()
{
    if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'])
        $IP = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'])
        $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'])
        $IP = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'])
        $IP = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'])
        $IP = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'])
        $IP = $_SERVER['REMOTE_ADDR'];
    else
        $IP = '0.0.0.0';
    return $IP;
}

/**
 * PHP错误处理函数
 *
 * @author <macro_fengye@163.com> macro chen
 */
function fatal_handler()
{
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        if (\Core\Utils\CoreUtils::getContainer('logger')) {
            $msg = 'Type : ' . $error["type"] . '\nMessage : ' . $error["message"] . '\nFile : ' . $error["file"] . '\nLine : ' . $error["line"];
            \Core\Utils\CoreUtils::getContainer('logger')->error($msg);
        } else {
            $msg = 'Type : ' . $error["type"] . ' , Message : ' . $error["message"] . ' , File : ' . $error["file"] . ' , Line : ' . $error["line"];
            writeLog('Fatal Error : ', [$msg], APP_PATH . '/log/fatal_error.log', Monolog\Logger::ERROR);
            if (file_exists(TEMPLATE_PATH . 'error.twig')) {
                echo @file_get_contents(TEMPLATE_PATH . 'error.twig');
            } else {
                echo \GuzzleHttp\json_encode(['code' => 2000, 'msg' => 'Error', 'data' => []]);
            }
        }
    }
}

/**
 * 验证来源IP合法性，是否在允许IP列表内
 * checkFromIpValidity('127.0.0.1', array('127.0.0.1', '192.168.0.'))
 * 允许IP列表支持不完全匹配
 *
 * @author fengxu
 * @param string $fromIp 来源IP
 * @param array $allowIps 允许IP列表
 * @return boolean
 */
function checkFromIPValidity($fromIp = '', array $allowIps = array())
{
    $fromIp = $fromIp ? $fromIp : getIp();
    $res = false;
    if ($allowIps) {
        foreach ($allowIps as $allowIp) {
            if (!strncmp($fromIp, $allowIp, strlen($allowIp))) {
                $res = true;
                break;
            }
        }
    }
    return $res;
}

/**
 *
 * 验证密码复杂度
 *
 * @author fengxu
 * @param string $password
 * @param integer $minPwdLen 密码最小长度
 * @return integer 密码复杂度等级，安位求或
 */
function verifyPwdComplexity($password, $minPwdLen = 6)
{
    $complexity = 0;
    if (strlen($password) >= (int)$minPwdLen) {
        $complexity = 1;
        if (preg_match('@[a-zA-Z]+@', $password)) {
            $complexity |= 2;
        }
        if (preg_match('@[0-9]+@', $password)) {
            $complexity |= 4;
        }
        if (preg_match('@[A-Z]+@', $password)) {
            $complexity |= 8;
        }
        if (preg_match('@[\W]+@', $password)) { // 字母数字外的其他字符
            $complexity |= 16;
        }
    }
    return $complexity;
}

/**
 * 过滤不可见(不可打印)的字符
 *
 * @param $str
 * @return mixed
 */
function filterInvisibleCharacter($str)
{
    return preg_replace('/[^[:print:]]/', '', $str);
}

/**
 * 记录日志，便于调试
 *
 * @param $message
 * @param array $content
 * @param string $file
 * @param string $log_name
 * @param int $level
 */
function writeLog($message, array $content, $file = '', $log_name = "LOG", $level = \Monolog\Logger::WARNING)
{
    $levels = [
        100 => 'debug',
        200 => 'info',
        250 => 'notice',
        300 => 'warning',
        400 => 'error',
        500 => 'critical',
        550 => 'alert',
        600 => 'emergency'
    ];
    $logger = new \Monolog\Logger($log_name);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($file ? $file : APP_PATH . '/log/log.log', $level));
    $logger->$levels[$level]($message, $content);
}

/**
 * 请求目标URL获取请求返回的JSON字符串
 *
 * @author fengxu
 * @param string $url 目标URL
 * @param string $method 请求方式 GET|POST
 * @param array $fields 当请求方式为POST时，传递的参数
 * @param int $timeout 请求超时时间，单位‘sec’
 * @return array
 */
function getHttpJson($url, $method = 'GET', array $fields = array(), $timeout = 30)
{
    $isPost = ($method == 'POST');
    $responseFields = array();
    $reqHandle = curl_init($url);
    curl_setopt_array($reqHandle, array(
        CURLOPT_USERAGENT => 'getHttpJson',
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_RETURNTRANSFER => true,
    ));
    if ($isPost) {
        curl_setopt($reqHandle, CURLOPT_POST, true);
        // http_build_query自动urlencode传输参数，可避免参数中存在URL特殊字符的问题
        curl_setopt($reqHandle, CURLOPT_POSTFIELDS, http_build_query($fields, null, '&'));
    }
    $responseJson = curl_exec($reqHandle);
    if (!($error = curl_error($reqHandle))) {
        if ($responseJson) {
            $responseFields = json_decode($responseJson, true);
        }
    } else {
        $errMsg = sprintf("【%s】\t\t%s getHttpJson(%s, %s) \t\t%s\n",
            date('Y-m-d H:i:s', time()), $error, $url, $method,
            (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : ''));
        $logDir = 'log';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777);
        }
        file_put_contents(APP_PATH . "/log/error.log", $errMsg, FILE_APPEND);
    }
    curl_close($reqHandle);
    return $responseFields;
}
