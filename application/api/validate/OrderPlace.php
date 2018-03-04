<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/4
 * Time: 22:30
 */

namespace app\api\validate;


use app\lib\exception\ParameterExecption;

class OrderPlace extends BaseValidate
{
    protected $rule = [

    ];

    protected function checkProducts($values){
        if (empty($values)){
            throw new ParameterExecption([
                'msg'=>'商品列表为空'
            ]);
        }
    }
}