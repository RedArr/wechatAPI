<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/24
 * Time: 0:38
 */

namespace app\api\validate;


use app\lib\exception\ParameterExecption;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if (!$result) {
            $e = new ParameterExecption([
                'msg' => $this->error,
            ]);
            throw $e;
        }
        else {
            return true;
        }

    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    protected function isNotEmpty($value,$rule='',$data='',$field=''){
        if (empty($value)){
            return false;
        }else{
            return true;
        }
    }
}