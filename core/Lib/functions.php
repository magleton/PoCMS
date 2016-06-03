<?php
/**
 * 字节转换
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
 * @author <macro_fengye@163.com> macro chen
 */
function fatal_handler()
{
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        $msg = 'Type : ' . $error["type"] . '\nMessage : ' . $error["message"] . '\nFile : ' . $error["file"] . '\nLine : ' . $error["line"];
        \Boot\Bootstrap::getContainer('logger')->error($msg);
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
 * 生成用户的salt加密串
 * @param int $len
 * @param int $type (1=>数字 , 2=>字母 , 3=>混合)
 * @return string
 */
function generateSalt($len = 32, $type = 3)
{
    $arr[1] = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $arr[2] = ["b", "c", "d", "f", "g", "h", "j", "k", "m", "n", "p", "q", "r", "s", "t", "u", "v", "w", "x", "z"];
    $arr[3] = ["b", "c", "d", "f", "g", "h", "j", "k", "m", "n", "p", "q", "r", "s", "t", "u", "v", "w", "x", "z", "2", "3", "4", "5", "6", "7", "8", "9"];
    $word = '';
    $cnt = count($arr[$type]) - 1;
    srand((float)microtime() * 1000000);
    shuffle($arr[$type]);
    for ($i = 0; $i < $len; $i++) {
        $word .= $arr[$type][\Zend\Math\Rand::getInteger(0, $cnt, false)];
    }
    if (strlen($word) > $len) {
        $word = substr($word, 0, $len);
    }
    return $word;
}

/**
 * 过滤不可见(不可打印)的字符
 * @param $str
 * @return mixed
 */
function filterInvisibleCharacter($str)
{
    return preg_replace('/[^[:print:]]/', '', $str);
}

/**
 * 记录日志，便于调试
 * @param $message
 * @param array $content
 * @param string $file
 * @param string $log_name
 * @param int $level
 */
function writeLog($message, array $content, $file, $log_name = "LOG", $level = \Monolog\Logger::WARNING)
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
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($file, $level));
    $logger->$levels[$level]($message, $content);
}

