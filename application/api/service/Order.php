<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/5
 * Time: 15:25
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    //订单商品列表，也就是客户端传递过来的products参数
    protected $oProducts;
    //从数据库中取出来的products真实商品信息(包括库存);
    protected $products;
    //
    protected $uid;

    public function place($uid,$oproducts){
        $this ->oProducts = $oproducts;
        $this -> oProducts = $this ->getProductsByOrder($oproducts);
        $this ->uid = $uid;
    }

    public function getProductsByOrder($oproducts){
        $oPIDs = [];
        foreach ($oproducts as $item){
            array_push($oPIDs,$item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible(['id','price','stock','name','main_img_url'])
            ->toArray();

        return $products;
    }
}