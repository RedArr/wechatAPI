<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/5
 * Time: 18:05
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在';
    public $errorCode = 30000;
}