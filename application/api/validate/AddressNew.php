<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/27
 * Time: 16:02
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile'=> 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city'=> 'require|isNotEmpty',
        'country'=> 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',
    ];
}