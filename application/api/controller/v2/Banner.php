<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/22
 * Time: 22:46
 */

namespace app\api\controller\v2;


use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
use think\Exception;

class Banner
{
    /**获取指定banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        return "this is v2";

    }
}