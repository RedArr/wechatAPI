<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/26
 * Time: 15:44
 */

namespace app\lib\exception;


class ParameterExecption extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}