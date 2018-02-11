<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/12
 * Time: 0:31
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = '404';
    public $msg = '指定参数不存在，请检查参数';
    public $errorCode = '20000';
}