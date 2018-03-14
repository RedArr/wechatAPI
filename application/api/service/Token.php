<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/26
 * Time: 23:59
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
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

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        }
        else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
                return $vars[$key];
            }
            else {
                throw new Exception('token不存在');
            }
        }
    }

    public static function getCurrentUid()
    {
        //token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
    //需要用户和CMS管理员都可以访问的权限
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            }
            else {
                throw new ForbiddenException();
            }
        }
        else {
            throw new TokenException();
        }

    }
    //只有用户能访问的权限
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope = ScopeEnum::User) {
                return true;
            }
            else {
                throw new ForbiddenException();
            }
        }
        else {
            throw new TokenException();
        }

    }

    public static function isValidOperate($checkUID)
    {
        if (!$checkUID){
            throw new Exception('检测UID必须传入一个UID');
        }
        $currentOperateUID = self::getCurrentUid();
        if ($currentOperateUID == $checkUID){
            return true;
        }
        return false;
    }
}