<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/2
 * Time: 14:33
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = [
        'delete_time'
    ];
}