<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/13
 * Time: 16:03
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }
}