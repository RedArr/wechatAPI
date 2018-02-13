<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/13
 * Time: 15:49
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code='')
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken();
        $token = $ut ->get($code);
        return $token;
    }
}