<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/12
 * Time: 1:20
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\ProductException;


class Category
{
    /**
     * @url z.cn/api/v1/category/all
     * @return false|static[]
     */
    public function getAllCategory(){
        $categories = CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new ProductException();
        }
        return $categories;
    }
}