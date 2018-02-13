<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/13
 * Time: 15:51
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule =[
        'code' => 'require|isNotEmpty'
    ];
    protected $message = [
        'code'=>'没有code'
    ];
}