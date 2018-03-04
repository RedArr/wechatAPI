<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/2
 * Time: 16:19
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = '10001';
}