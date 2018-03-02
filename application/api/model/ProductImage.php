<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/28
 * Time: 20:47
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id','delete_time','product_id'];

    public function imgUrl(){
        return $this->belongsTo('image','img_id','id');
    }
}