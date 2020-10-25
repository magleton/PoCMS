<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 2017/3/31
 * Time: 20:43
 */

namespace WeiXin\Validators;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class PhoneValidator
{
    /**
     * 验证手机号码
     *
     * @param $object
     * @param ExecutionContextInterface $context
     * @param $payload
     * @return bool
     */
    public static function validate($object, ExecutionContextInterface $context, $payload): ?bool
    {
        if (strlen($object) < 12) {
            return $context->buildViolation('长度必须大于10')
                ->addViolation();
        }
        return true;
    }
}