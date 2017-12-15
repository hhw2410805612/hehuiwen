<?php

namespace Home\Controller;

/**
 * 商城控制器
 * 管理商城
 */
class ShopController extends HomeController
{

    /**
     * @deprecate 商城主页
     * @author 雷楚桥 on 2017/11/16:13:10
     */
    public function index()
    {

        session("auth_redirect_no", 1);
        get_user_auth();

        $this->assign("meta_title", "小商城");//设置标题
        $this->display();
    }


    /**
     * @deprecate 订单列表
     * @author 雷楚桥 on 2017/11/16:13:17
     */
    public function order()
    {
        $user_id = get_user_auth();

        //得到订单列表
        $today_time = strtotime(date("Ymd"));

        $groupList = D("Order")->get_group_list("time >= {$today_time} AND user_id = '{$user_id}'");
        $orderList = array();
        foreach ($groupList as $key => $val) {
            $orderList[$key]['goods_group_id'] = $val['goods_group_id'];
            $orderList[$key]['status'] = $val['status'];
            $orderList[$key]['money'] = $val['money'];
            $goods_list = D("Order")->get_order_list($val['goods_group_id']);

            if (!empty($goods_list[0]['goods_id'])) {//判断店铺是否存在
                $shop_id = D("Goods")->get_goods($goods_list[0]['goods_id'], "shop_id");
                $orderList[$key]['shop'] = D("Shop")->get_shop($shop_id);
            }

            foreach ($goods_list as $k => $v) {
                $orderList[$key]['goods'][$k]['count'] = $v['count'];
                $orderList[$key]['goods'][$k]['name'] = D("Goods")->get_goods($v['goods_id'], "name");
            }
        }
        $this->assign("orderList", $orderList);
        $this->assign("meta_title", "今日订单");//设置标题
        $this->display();
    }


    /**
     * @deprecate 个人中心
     * @author 雷楚桥 on 2017/11/16:13:18
     */
    public function mine(){
        //个人信息修改
        if (IS_POST) {
            $data = array(
                'name' => I("name"),
                'nickname' => I("name"),
                'tell' => I("tell"),
                'status' => I("status")
            );
            D("User")->save_user($data);
            D("Courier")->save_courier($data);
            $this->redirect("mine");
        }
        session("auth_redirect_no", 1);
        $user_id = get_user_auth();
        $user = D("User")->get_user($user_id);
        $this->assign("user", $user);

        //判断是否是骑手
        $courier = D("Courier")->is_courier($user_id, false);
        $this->assign("courier", $courier);

        $this->assign("meta_title", "我的");//设置标题
        $this -> display();
    }

    /**
     * @deprecated 商店详情界面
     * @param $shop_id int 店铺id
     * @param $classify int 进入自营店的指定模块
     * @author 雷楚桥 on 2017/10/20:17:23
     */
    public function detail($shop_id = '', $classify = 0)
    {
        if (!empty($shop_id))
            session("oauth_shop_id", $shop_id);
        else
            $shop_id = session("oauth_shop_id");
        session("auth_redirect_no", 2);
        get_user_auth();

        $shop = D("Shop")->get_shop($shop_id);//得到该商店的信息
        $goods_classify = D("Shop")->get_classify($shop_id);//得到该商店的所有类别

        $this->assign("classify", $classify);
        $this->assign("goods_classify", $goods_classify);
        $this->assign("meta_title", $shop['name']);//设置标题
        $this->assign("shop", $shop);
        $this->display();
    }


    /**
     * @deprecate 订单组详情
     * @param $group_id int 订单组号
     * @author 雷楚桥 on 2017/11/1:10:16
     */
    public function order_detail($group_id)
    {
        if (empty($group_id))
            $this->redirect("Error/error_404");
        $group = D("Order")->get_order_group($group_id);
        $goodsList = D("Order")->get_order_list($group_id);
        $shop = D("Shop")->get_shop($group['shop_id']);

        foreach ($goodsList as $key => $val)
            $goodsList[$key]['goods'] = D("Goods")->get_goods($val['goods_id']);

        $group['time'] = date("Y-m-d H:i:s", $group['time']);//下单时间
        $group['group_id'] = $group_id;//订单组号码
        $address = D("Address")->get_address($group['address_id']);

        $this->assign('shop', $shop);
        $this->assign('address', $address);
        $this->assign("goodsList", $goodsList);
        $this->assign('group', $group);
        $this->assign("meta_title", "订单详情");
        $this->display();
    }

}