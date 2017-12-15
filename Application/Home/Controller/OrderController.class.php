<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17
 * Time: 14:50
 */
namespace Home\Controller;
class OrderController extends HomeController{

    //订单展示列表
    public function show_list(){

    }

    /**
     * @deprecate 取消订单组
     * @author 雷楚桥 on 2017/11/3:20:03
     */
    public function cancelGoodsGroup(){
        if(get_user_auth()){

        }
    }
}