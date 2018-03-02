<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/27
 * Time: 0:29
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期';
    public $errorCode = 10001;
}