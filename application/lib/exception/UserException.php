<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/27
 * Time: 23:43
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 999;
}