<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/2
 * Time: 14:44
 */

namespace app\api\validate;


use app\api\model\Product;

class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];
    protected $message = [
        'ids' => 'ids必须是以逗号分隔的正整数'
    ];

    protected function checkIDs($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            }
        }
        return true;
    }
}