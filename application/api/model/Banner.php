<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/1/24
 * Time: 15:22
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends BaseModel
{

    protected $hidden = ['delete_time', 'update_time'];

//  关联函数
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getBannerByID($id)
    {
        $banner = self::with(['items', 'items.img'])->find($id);
        return $banner;
    }
}