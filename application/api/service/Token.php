<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/26
 * Time: 23:59
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        //32字符随机变换
        $randChars = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt盐
        $salt = config('secure.token_salt');

        return md5($randChars . $timestamp . $salt);
    }

    public static function getCurrentTokenVar($key){
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars){
            throw new TokenException();
        }else{
            if (!is_array($vars)){
                $vars = json_decode($vars,true);
                return $vars[$key];
            }else{
                throw new Exception('token不存在');
            }
        }
    }
    public static function getCurrentUid(){
        //token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}