<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/10
 * Time: 0:51
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $reCent = ProductModel::getMostRecent($count);
        if (!$reCent) {
            throw new ProductException();
        }
        $reCent = $reCent ->hidden(['summary']);
        return $reCent;
    }
}