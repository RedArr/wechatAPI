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
use app\api\validate\IDCollection;
use app\api\validate\IDMustBePostiveInt;
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
    public function getAllIncategory($id){
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if ($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }
}