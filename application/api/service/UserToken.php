<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/13
 * Time: 16:04
 */

namespace app\api\service;


use app\api\model\User;
use think\Exception;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code){
        return $code;
//        $this ->$code = $code;
//        $this ->wxAppID = config('wx.app_id');
//        $this ->wxAppSecret = config('wx.app_secret');
//        $this ->wxLoginUrl = sprintf(config('wx.login_url'),
//            $this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get($code)
    {
//        $result = curl_get($this->wxLoginUrl);
//        $wxResult = json_decode($result,true);
//        if (empty($wxResult)){
//            throw new Exception('获取错误');
//        }else{
//            $loginFail = array_key_exists('errcode',$wxResult);
//            if ($loginFail){
//
//            }else{
//
//            }
//        }
//        return $this ->wxLoginUrl;
    }
}