<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/8
 * Time: 14:42
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id','delete_time','update_time'];
}