<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/5
 * Time: 18:05
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = '80000';
}