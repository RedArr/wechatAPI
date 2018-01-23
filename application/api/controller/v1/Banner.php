<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/22
 * Time: 22:46
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePostiveInt;

class Banner
{
    /**获取指定banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $data = [
            'id' => $id
        ];
        $validate = new IDMustBePostiveInt();
        $result = $validate->batch()
            ->check($data);
        if ($result) {

        } else {

        }
    }
}