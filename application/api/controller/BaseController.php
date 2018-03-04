<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/4
 * Time: 22:03
 */

namespace app\api\controller;


use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
    protected function CheckPrimaryScope(){
        TokenService::needPrimaryScope();
    }
    protected function checkExclusiveScope(){
        TokenService::needExclusiveScope();
    }

}