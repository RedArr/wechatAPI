<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/23
 * Time: 18:28
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPositiveInteger'
    ];

    protected function isPositiveInteger($value,$rule='',$data='',$field = '')
    {
        if(is_numeric($value) && is_int($value + 0) && ($value +0) > 0){
            return true;
        }
        else{
            return $field."必须是整数";
        }
    }
}