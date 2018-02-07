<?php
/**
 * Created by PhpStorm.
 * User: Mx
 * Date: 2018/2/2
 * Time: 14:32
 */

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;

/**
 * Class Theme
 * @package app\api\controller\v1
 * @Url /theme?ids=id1,id2,id3
 * @return 一组Theme模型
 */
class Theme
{
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);
        if (!$result) {
            throw new ThemeException();
        }
        return $result;
    }

    /***
     * @param $id
     */
    public function getComplexOne($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if (!$theme){
            throw new ThemeException();
        }
        return $theme;


    }
}