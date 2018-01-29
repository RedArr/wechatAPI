<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/24
 * Time: 16:29
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的banner不存在';
    public $errorCode = 40000;

}