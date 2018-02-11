<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/12
 * Time: 1:20
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time','description','update_time'];
    public function Img(){
        return $this->belongsTo('Image','topic_img_id','update_time');
    }
}