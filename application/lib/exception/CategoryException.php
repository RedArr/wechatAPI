<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/12
 * Time: 1:31
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = '404';
    public  $msg = '制定类目不存在，请检查商品ID';
    public  $errorCode ='50000';
}