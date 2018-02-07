<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/23
 * Time: 18:28
 */

namespace app\api\validate;


class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPositiveInteger'
    ];
    protected $message = [
        'id'=>'id必须是正整数'
    ];
}