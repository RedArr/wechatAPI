<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/2
 * Time: 16:43
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Controller;
use \app\api\service\Order as orderService;
use app\api\service\Token as TokenService;
use \app\api\model\Order as OrderModel;

class order extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getSummaryByUser','getDetail'],
    ];

    public function getSummaryOrderBySUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid = \app\api\service\Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty()) {
            return [
                'data' => [],
                'current_page' => $pagingOrders->getCurrentPage()
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address', 'prepay_id'])->toArray();
        return [
            'data' => $data,
            'current_page' => $pagingOrders->getCurrentPage()
        ];
    }

    public function placeOrder()
    {
        (new OrderPlace())
            ->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
        $order = new orderService();
        $status = $order->place($uid, $products);
        return $status;
    }

    public function getDetail($id){
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }
}