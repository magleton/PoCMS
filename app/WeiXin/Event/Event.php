<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 2016/6/9
 * Time: 8:59
 */

namespace WeiXin\Event;

final class Event
{
    public const FIRST_EVENT = 'lazy_pimple.first_event';

    final private function __construct()
    {
        // 防止外部new该类的对象
    }
}