<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/3
 * Time: 18:49
 */

namespace Home\Controller;

class MineController extends HomeController
{

    /**
     * @deprecate 优惠
     * @author 雷楚桥 on 2017/11/3:18:44
     */
    public function discount()
    {
        $this->assign("meta_title", "优惠");
        $this->display();
    }

    /**
     * @deprecate 我的订单
     * @author 雷楚桥 on 2017/11/3:18:47
     */
    public function order()
    {
        $user_id = get_user_auth();

        //得到订单列表
        $groupList = D("Order")->get_group_list("user_id = '{$user_id}'");
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
        $this->assign("meta_title", "订单");
        $this->display();
    }


    /**
     * @deprecate 我的收藏
     * @author 雷楚桥 on 2017/11/3:18:53
     */
    public function collect()
    {
        $this->assign("meta_title", "收藏");
        $this->display();
    }


    /**
     * @deprecate 帮助与服务
     * @author 雷楚桥 on 2017/11/3:18:48
     */
    public function help()
    {
        $this->assign("meta_title", "帮助与服务");
        $this->display();
    }

    /**
     * @deprecated 地址管理界面
     * @author 雷楚桥 on 2017/10/21:20:06
     */
    public function address()
    {
        $addinfo = D("Address")->get_user_address(get_user_auth());
        foreach ($addinfo as $key => $val)
            $addinfo[$key]['sexname'] = $val['sex'] == 1 ? '先生' : '女士';
        $this->assign('addinfo', $addinfo);
        $this->assign("meta_title", "收货地址");
        $this->display();
    }

    /**
     * @deprecated 编辑收货地址
     * @author 雷楚桥 on 2017/10/23:9:13
     */
    public function edit()
    {
        //提交的数据
        if (IS_POST) {
            $data = I("post.");
            $data['user_id'] = get_user_auth();
            if ($data['address_id'] == null) {
                D("Address")->add_address($data);
            } else
                D("Address")->update_address($data);
            $selected_shop_id = $data['selected_shop_id'];
            if(empty($selected_shop_id))
                $this->redirect("address");
            else
                $this->redirect("Shop/detail",array("shop_id" => $selected_shop_id));

        }
        $address = D("Address")->get_address(I("address_id"));
        if ($address != null) {
            $this->assign("meta_title", "编辑收货地址");
            $this->assign("address", $address);
        } else {
            $this->assign("meta_title", "增加收货地址");
            $this->assign("shop_id", I("shop_id"));
        }
        $this->display();
    }


    /**
     * @deprecate 我是骑手
     * @author 雷楚桥 on 2017/11/4:20:27
     */
    public function courier()
    {
        $courier = D("Courier")->is_courier();
        if ($courier['status'] != 1)
            $this->javascriptJump("你还没有设置为上班哦，快去个人中心设置吧");

        $today = strtotime(date("Ymd"));//今日凌晨

        $where = "courier_id = -1 AND status = 2 AND time >= '{$today}'";

        $groupList = D("Order")->get_appoint_group($where);

        foreach ($groupList as $key => $val) {
            $address = D("Address")->get_address($val['address_id']);
            $groupList[$key]['address'] = $address;
            $groupList[$key]['time'] = date("m-d H:i", $val['time']);
            $groupList[$key]['goods'] = D("Order")->get_order_list($val['goods_group_id'], true);
            $groupList[$key]['shop'] = D("Shop")->get_shop($val['shop_id']);
        }

        $this->assign("groupList", $groupList);
        $this->assign("meta_title", "我是骑手");
        $this->display();
    }


    /**
     * @deprecate 加入我们
     * @author 雷楚桥 on 2017/11/4:21:02
     */
    public function join()
    {
        $user_id = get_user_auth();
        if (IS_POST) {
            $data = I("post.");
            $data['user_id'] = $user_id;
            D("Join")->add_join_us($data);
            $this->javascriptJump("增加成功", U("join"));
        }
        $join = D("Join")->get_join_us("user_id = '{$user_id}' AND status <= 1");
        if (!empty($join))
            $this->assign("join", $join);
        $this->display();
    }
}
