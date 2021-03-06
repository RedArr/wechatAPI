<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/2
 * Time: 14:33
 */

namespace app\api\model;

use app\api\model\Product as ProductModel;


class Product extends BaseModel
{
    protected $hidden = [
        'delete_time', 'create_time', 'update_time', 'pivot', 'category_id', 'from'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    //关联PriductImage
    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    //关联ProductProperty
    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    public static function getProductsByCategoryID($cateGoryID)
    {
        $products = self::where('category_id', '=', $cateGoryID)
            ->select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        $product = self::with([
            'imgs' => function ($query) {
                $query->with(['imgUrl'])
                ->order('order','asc');
            }
        ])
            ->with(['properties'])
            ->find($id);
        return $product;
    }
}