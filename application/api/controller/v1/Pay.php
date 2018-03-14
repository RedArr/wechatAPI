<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/12
 * Time: 15:04
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use \app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id = '')
    {
        (new IDMustBePostiveInt())
            ->goCheck();
        $pay = new PayService($id);
        $pay->pay();
    }

    public function receiveNotify()
    {
        //通知频率 15 15 30 180
        //检测库存
        //更新订单状态

    }
}