<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/10
 * Time: 0:54
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count'=>'isPositiveInteger|between:1,20'
    ];
}