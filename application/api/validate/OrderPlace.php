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
        'products' => 'checkProducts'
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger'
    ];

    protected function checkProducts($values)
    {
        if (empty($values)) {
            throw new ParameterExecption([
                'msg' => '商品列表为空'
            ]);
        }
        if (is_array($values)) {
            throw new ParameterExecption([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach ($values as $value) {
            $this->check($value);
        }
    }

    public function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $request = $validate->check($value);
        if ($request){
            throw new ParameterExecption([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}