<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

Route::get('api/:version/theme', 'api/:version.Theme/getSimpleList');

Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

//Route::get('api/:version/product/recent','api/:version.Product/getRecent');
//Route::get('api/:version/product/by_category','api/:version.Product/getAllIncategory');
//Route::get('api/:version/product/:id','api/:version.product/getOne',[],['id'=>'\d+']);
Route::group('api/:version/product',function (){
    Route::get('by_category','api/:version.Product/getAllIncategory');
    Route::get('recent','api/:version.Product/getRecent');
    Route::get(':id','api/:version.product/getOne',[],['id'=>'\d+']);
});
Route::get('api/:version/category/all','api/:version.Category/getAllCategory');

Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
//测试
Route::post('api/:version/test', 'api/:version.Address/test');

Route::post('api/:version/order','api/:version.Order/placeOrder');
//获取用户订单列表
Route::get('api/:version/order/by_user','api/:version.Order/getSummaryOrderBySUser');
Route::get('api/:version/order/:id','api/:version.Order/getDetail',[],['id'=>'\d+']);
//支付
Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');

Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');