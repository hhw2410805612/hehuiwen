<?php

namespace Home\Controller;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {


    public function index(){
        $this->redirect("Shop/index");
    }

    public function test(){
        $today = strtotime(date("Ymd"));//今日凌晨
        $group_list = D("Order") ->get_group_list("time >= '{$today}'",true);
        $orderList = array();
        foreach($group_list as $key => $val){
            $orderList = array_merge($orderList,D("Order") -> get_order_list($val['goods_group_id']));
        }
        dump($orderList);
    }
}