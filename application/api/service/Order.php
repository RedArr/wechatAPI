<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/3/5
 * Time: 15:25
 */

namespace app\api\service;


use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Db;
use think\Exception;

class Order
{
    //订单商品列表，也就是客户端传递过来的products参数
    protected $oProducts;
    //从数据库中取出来的products真实商品信息(包括库存);
    protected $products;
    //
    protected $uid;

    public function place($uid, $oProducts)
    {
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
        $status = $this->getOrderStatus();
        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }

        //创建订单
        $orderSnap = $this->snapOrder($status);
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;


    }

    private function createOrder($snap)
    {
        Db::startTrans();
        try {
            $orderNo = self::makeOrderNo();
            $order = new \app\api\model\Order();
            $order->user_id = $this->uid;
            $order->total_price = $snap['orderPrice'];
            $order->order_no = $orderNo;
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);

            $order->save();

            $orderID = $order->id;
            $create_time = $order->create_time;
            foreach ($this->oProducts as &$val) {
                $val['order_id'] = $orderID;
            }
            unset($val);
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);
            Db::commit();
            return [
                'order_no' => $orderID,
                'order_id' => $orderNo,
                'order_time' => $create_time,
            ];

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N');
        $orderSn = $yCode[intval(date('Y')) - 2018] . strtoupper(dechex('m')) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }

    //生成订单快照
    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => '',
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];


        return $snap;
    }

    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id', '=', $this->uid)
        ->find();
        if (!$userAddress) {
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errorCode' => 60001
            ]);
        }
        return $userAddress->toArray();
    }


    /**
     * pass订单库存检测是否通过
     * orderPrice 订单总金额
     * pStatusArray保存订单详细信息
     */
    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalProduct'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    /**
     * @param $oPID 客户端传来商品ID
     * @param $oCount 客户端传来商品数量
     * @param $products 数据库商品信息
     *
     */
    private function getProductStatus($oPID, $oCount, $products)
    {
        $PIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,
            'count' => 0,
            'name' => '',
            'totalProduct' => 0
        ];

        for ($i = 0; $i < count($products); $i++) {
            if ($oPID == $products[$i]['id']) {
                $PIndex = $i;
            }
        }

        if ($PIndex == -1) {
            throw new OrderException([
                'msg' => '$id为' . $oPID . '的商品不存在'
            ]);
        }
        else {
            $products = $products["$PIndex"];
            $pStatus['id'] = $products['id'];
            $pStatus['name'] = $products['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalProduct'] = $products['price'] * $oCount;

            if ($products['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
            return $pStatus;
        }


    }

    public function getProductsByOrder($oProducts)
    {
        $oPIDs = [];
        foreach ($oProducts as $item) {
            array_push($oPIDs, $item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();

        return $products;
    }
}