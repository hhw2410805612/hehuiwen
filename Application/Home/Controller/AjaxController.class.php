<?php

namespace Home\Controller;

use Common\WxPay\JsApiPay;
use Common\WxPay\Wechat;

/**
 * 获取ajax数据
 */
class AjaxController extends HomeController
{


    /**
     * @deprecated 得到所有店铺的特色
     * @param $top_no int 上级no
     * @author 雷楚桥 on 2017/10/19:11:54
     */
    public function getFeatures()
    {
        if (IS_AJAX)
            $this->ajaxReturn(D("Feature")->get_features(I("post.")));
    }


    /**
     * @deprecated 删除地址
     * @param mixed array 删除参数
     * @author 雷楚桥 on 2017/10/23:8:47
     */
    public function addressDelete()
    {
        if (IS_AJAX)
            $this->ajaxReturn(D("Address")->delete_address(I("post.")));

    }

    /**
     * @deprecated 得到指定的商店列表
     * @param json array 查询参数
     * @author 雷楚桥 on 2017/10/30:9:22
     */
    public function getShopList()
    {
        if (IS_AJAX) {
            $shopSelect = I("post.shopSelect");
            $shop_list = D("Shop")->get_shop_list($shopSelect[0]);
            $ajax = array(
                "status" => 1,
                "data" => $shop_list
            );
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 得到该商品类型的所有商品
     * @param $classify_id int 商品类型
     * @return array
     * @author 雷楚桥 on 2017/10/31:20:46
     */
    public function getGoods($classify_id)
    {
        $goods = D("Shop")->get_goods($classify_id);
        foreach ($goods as $key => $val) {
            $goods[$key]['sell'] = D("Order")->get_goods_sell($val['goods_id']);
        }
        $ajax = array(
            'status' => 1,
            'data' => $goods,
            'car' => D("Car")->get_all_record(true)
        );
        $this->ajaxReturn($ajax);
    }


    /**
     * @deprecate 检查订单状态
     * @param post
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:20:18
     */
    public function checkOrder()
    {
        if (IS_POST) {
            $ajax = array();
            $shop = D("Shop")->get_shop(I("post.shop_id"));
            if ($shop['status'] == 1) {
                $user_id = get_user_auth();
                $address = D("Address")->get_user_address($user_id);
                if (empty($address))
                    $ajax['status'] = 2;
                else {
                    $ajax['status'] = 1;
                    $ajax['address'] = $address;
                }
            } else
                $ajax['status'] = $shop['status'];
            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 保存订单信息
     * @param post
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:15:22
     */
    public function saveOrder()
    {
        if (IS_POST) {
            $order_group_id = D("Order")->add_order_group(I("post."));
            $ajax['status'] = 1;
            $ajax['group_id'] = $order_group_id;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecated 返回微信的api返回值
     * @return mixed
     * @author 雷楚桥 on 2017/10/23:19:21
     */
    public function getWxAPI()
    {
        $wechat = new Wechat();
        $jspai_ticket = $wechat->getJsApiTicket();

        $timestamp = time();
        $noncestr = $wechat->getNonceStr();
        $url = I("url");
        $str = "jsapi_ticket=" . $jspai_ticket . "&noncestr=" . $noncestr . "&timestamp=" . $timestamp . "&url=" . $url;
        $signature = sha1($str);
        $ajax = array(
            'appId' => $wechat->getAppId(),
            'timestamp' => $timestamp,
            'nonceStr' => $noncestr,
            'signature' => $signature
        );
        $this->ajaxReturn($ajax);
    }

    /**
     * @deprecate 得到微信支付的参数
     * @author 雷楚桥 on 2017/12/5:14:34
     */
    public function getWxPay()
    {

        $wechat = new Wechat();
        $tools = new JsApiPay();

        $order = $wechat->wxPayAction(I("post."));

        $ajax['status'] = 1;
        $ajax['jsApiParameters'] = $tools->GetJsApiParameters($order);

        //获取共享收货地址js函数参数
        $ajax['editAddress'] = $tools->GetEditAddressParameters();
        $this->ajaxReturn($ajax);
    }


    /**
     * @deprecate 删除商品
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:16:03
     */
    public function deleteGoods()
    {
        if (IS_POST) {
            $goods_id = I("post.goods_id");
            D("Goods")->update_status($goods_id, -1);
            $ajax = array('status' => 1);
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 得到对应的商品信息
     * @param $need_label bool 是否需要标签
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:16:41
     */
    public function getGoodsById()
    {
        if (IS_POST) {
            $goods_id = I("goods_id");
            $need_label = I("need_label");

            $ajax = array(
                'status' => $goods_id,
                'data' => D("Goods")->get_goods($goods_id)
            );
            if ($need_label)
                $ajax['label'] = D("Label")->get_all_label($goods_id);

            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 根据商店id得到商店信息
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:18:45
     */
    public function getShop()
    {
        if (IS_POST) {
            $shop_id = I("post.shop_id");
            $ajax['status'] = 1;
            $ajax['data'] = D("Shop")->get_shop($shop_id);
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 删除一个类别
     * @param $classify_id int 类别id
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:20:24
     */
    public function deleteClassify()
    {
        if (IS_POST) {
            $classify_id = I("post.classify_id");
            $ajax['status'] = 1;
            $ajax['data'] = D("Goods")->delete_classify("classify_id = '$classify_id'");
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 订单管理顶部导航刷新，得到对应数据
     * @author 雷楚桥 on 2017/12/4:16:46
     */
    public function updateCountSelect()
    {
        if (IS_POST) {
            $select_arr = I("select_arr");
            $ajax['status'] = 1;
            if ($select_arr[0] != 0)
                $ajax['classify'] = D("Goods")->get_goods_classify($select_arr[0]);
            if ($select_arr[1] != 0)
                $ajax['goods'] = D("Shop")->get_goods($select_arr[1]);

            //今日凌晨
            $today = strtotime(date("Ymd"));
            $group_list = D("Order")->get_group_list("time >= '{$today}'", true);

            $orderList = array();
            foreach ($group_list as $key => $val) {
                if ($select_arr[0] != 0 && $select_arr[0] != $val['shop_id'])
                    continue;
                $orderList = array_merge($orderList, D("Order")->get_order_list($val['goods_group_id'], true));
            }
            $ajax['orderList'] = $orderList;

            if ($select_arr[1] != 0) {
                $classifyList = array();
                foreach ($ajax['orderList'] as $key => $val) {
                    if ($select_arr[1] != 0 && $select_arr[1] != $val['classify_id'])
                        continue;
                    $classifyList[$key] = $val;
                }
                $ajax['orderList'] = $classifyList;
            }

            if ($select_arr[2] != 0) {
                $goodsList = array();
                foreach ($ajax['orderList'] as $key => $val) {
                    if ($select_arr[2] != 0 && $select_arr[2] != $val['goods_id'])
                        continue;
                    $goodsList[$key] = $val;
                }
                $ajax['orderList'] = $goodsList;
            }


            if ($select_arr[2] != 0)
                $ajax['orderList'] = $goodsList;

            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 取消一个订单组
     * @author 雷楚桥 on 2017/11/3:20:18
     */
    public function cancelGroup()
    {
        if (IS_POST) {
            $group_id = I("post.group_id");
            $order = D("Order")->get_order_group($group_id, false);
            if ($order['status'] >= 1)
                $ajax['status'] = 2;
            else if (D("Order")->update_status($group_id, -1))
                $ajax['status'] = 1;
            else
                $ajax['status'] = -1;//更新失败
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 删除一个订单组
     * @author 雷楚桥 on 2017/11/3:20:37
     */
    public function deleteGroup()
    {
        if (IS_POST) {
            $group_id = I("post.group_id");
            $order = D("Order")->get_order_group($group_id, false);
            if ($order['status'] >= 0)
                $ajax['status'] = -1;
            else if (D("Order")->delete_group($group_id))
                $ajax['status'] = 1;
            else
                $ajax['status'] = -1;//删除失败
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 得到指定店铺的指定状态订单
     * @param $shop_id int 商店id
     * @param $status int 订单状态
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:13:40
     */
    public function getGroup($shop_id, $status)
    {
        if (IS_POST) {
            $groupList = D("Order")->get_appoint_group("shop_id = '$shop_id' AND status = '$status'");
            foreach ($groupList as $key => $val) {
                $address = D("Address")->get_address($val['address_id']);
                $groupList[$key]['address'] = $address;
                $groupList[$key]['goods'] = D("Order")->get_order_list($val['goods_group_id'], true);
                $groupList[$key]['time'] = date("m-d H:i", $val['time']);
                if (!empty($val['courier_id']))
                    $groupList[$key]['courier'] = D("Order")->get_courier($val['courier_id']);
            }
            $ajax['status'] = 1;
            $ajax['data'] = $groupList;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 根据订单id得到一个订单组
     * @param $group_id int 订单组id
     * @param $is_classify bool 是否显示类别[默认不显示]
     * @return array
     * @author Administrator on 2017/11/22 14:51
     */
    public function getGroupById($group_id, $is_classify = false)
    {
        if (IS_POST) {
            $group = D("Order")->get_order_group($group_id, true);
            $group['address'] = D("Address")->get_address($group['address_id']);
            $group['goods'] = D("Order")->get_order_list($group['goods_group_id'], true, $is_classify);
            $group['date'] = date("m-d H:i", $group['time']);
            $group['time'] = date("H:i", $group['time']);
            if (!empty($group['courier_id']))
                $group['courier'] = D("Order")->get_courier($group['courier_id']);

            $ajax['data'] = $group;
            $ajax['status'] = 1;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 更新订单组的状态
     * @param $group_id int 订单id
     * @param $now int 当前状态
     * @param $status int 修改后状态
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:13:15
     */
    public function updateGroup($group_id, $now, $status)
    {
        if (IS_POST) {
            $data = array('goods_group_id' => $group_id, 'status' => $now);
            $order = D("Order")->get_appoint_group($data);
            if (empty($order)) {
                $ajax['status'] = -1;
                $ajax['msg'] = '该订单不存在';
            } else {
                D("Order")->update_status($group_id, $status);
                $ajax['status'] = 1;
            }
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 申请骑手配送
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:15:12
     */
    public function applyExpress($group_id, $now)
    {
        $data = array('goods_group_id' => $group_id, 'status' => $now);
        $order = D("Order")->get_appoint_group($data);
        if (empty($order)) {
            $ajax['status'] = -1;
            $ajax['msg'] = '该订单不存在';
        } else {
            if (D("Courier")->have_courier()) {
                $ajax['status'] = -1;
                $ajax['msg'] = '当前没有空闲的骑手';
            } else {
                D("Order")->update_status($group_id, 2);
                D("Order")->set_courier($group_id, -1);
                $ajax['status'] = 1;
            }
        }
        $ajax['sql'] = M("Courier")->getLastSql();
        $this->ajaxReturn($ajax);
    }


    /**
     * @deprecate 检查该商店是否有新订单
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:20:48
     */
    public function getNewGroup()
    {
        if (IS_POST) {
            $shop_id = I("shop_id");
            $ajax['shop_id'] = $shop_id;
            if (D("Order")->get_appoint_group(array("shop_id" => $shop_id, 'status' => 0)))
                $ajax['status'] = 1;
            else
                $ajax['status'] = 0;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 检查自营店商店是否有新订单
     * @return mixed
     * @author 雷楚桥 on 2017/11/16:20:08
     */
    public function getOurGroup()
    {
        if (IS_POST) {
            $shops = D("Shop")->is_ourselves();
            $ajax['status'] = 0;
            foreach ($shops as $key => $val) {
                if ($val['status'] != 1) continue;//不理会未营业的店铺
                $shop_id = $val['shop_id'];
                $group_count = count(D("Order")->get_appoint_group(array("shop_id" => $shop_id, 'status' => 0)));
                if ($group_count > 0) {
                    if ($ajax['status'] == 0) $ajax['status'] = 1;
                    $ajax['data'][$shop_id] = $group_count;
                }
            }
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 检查是否有新的订单需要配送
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:21:07
     */
    public function getNewRunning()
    {
        if (IS_POST) {
            $map = array(
                'status' => I("status"),
                'courier_id' => I("courier_id")
            );
            if (D("Order")->get_appoint_group($map))
                $ajax['status'] = 1;
            else
                $ajax['status'] = 0;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 得到不同状态的订单
     * @param $status int 订单状态
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:14:34
     */
    public function getStatusRunning($status)
    {
        if (IS_POST) {
            $courier = D("Courier")->is_courier(get_user_auth());
            $where = '';
            $today = strtotime(date("Ymd"));//今日凌晨

            if ($status == 1)
                $where = "courier_id = -1 AND status = 2 ";
            else if ($status == 2) {
                $where = "courier_id = {$courier['courier_id']} AND status = 2";
            } else if ($status == 3) {
                $where = "courier_id = {$courier['courier_id']} AND status >= 3";
            }
            $where .= " AND time >= '{$today}'";

            $groupList = D("Order")->get_appoint_group($where);

            foreach ($groupList as $key => $val) {
                $address = D("Address")->get_address($val['address_id']);
                $groupList[$key]['address'] = $address;
                $groupList[$key]['time'] = date("m-d H:i", $val['time']);
                $groupList[$key]['goods'] = D("Order")->get_order_list($val['goods_group_id'], true);
                $groupList[$key]['shop'] = D("Shop")->get_shop($val['shop_id']);
            }
            $ajax['status'] = 1;
            $ajax['data'] = $groupList;
            $this->ajaxReturn($ajax);
        }

    }


    /**
     * @deprecate 骑手抢单
     * @param 参数
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:16:16
     */
    public function courierAccept()
    {
        if (IS_POST) {
            $map = array(
                'goods_group_id' => I("group_id"),
                'courier_id' => -1,
                'status' => 2
            );
            $group = D("Order")->get_appoint_group($map);
            if (empty($group)) {
                $ajax['status'] = -1;
                $ajax['msg'] = '该订单不存在';
            } else {
                $courier = D("Courier")->is_courier(get_user_auth());
                D("Order")->set_courier(I("group_id"), $courier['courier_id']);
                $ajax['status'] = 1;
            }
            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 得到商品的详情
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:20:34
     */
    public function getGoodsDetail()
    {
        if (IS_POST) {
            $goods_id = I("goods_id");
            $ajax['data'] = D("Goods")->get_goods($goods_id);
            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 得到店铺的今日统计
     * @return mixed
     * @author 雷楚桥 on 2017/11/13:18:00
     */
    public function getShopTodayCount()
    {
        if (IS_POST) {
            $ajax['shop'] = D("Shop")->get_shop(I("shop_id"));
            if ($ajax['shop']['status'] == 1)
                $ajax['shop']['status_name'] = '营业中';
            else if ($ajax['shop']['status'] == 0)
                $ajax['shop']['status_name'] = '休息中';
            else if ($ajax['shop']['status'] == -1)
                $ajax['shop']['status_name'] = '装修中';

            $order_list = D("Manage")->get_today_group(I("shop_id"), 3, 4);
            $ajax['count']['order'] = count($order_list);
            $ajax['count']['money'] = 0;
            foreach ($order_list as $key => $val) {
                $ajax['count']['money'] += $val['money'];
            }
            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 更新购物车
     * @return mixed
     * @author 雷楚桥 on 2017/11/26:14:43
     */
    public function updateCar()
    {
        if (IS_POST) {
            $ajax['status'] = 1;
            $ajax['post'] = I("post.");
            $ajax['data'] = D("Car")->touch_goods(I("goods_id"), I("count"));
            $ajax['sql'] = M("Car")->getLastSql();
            $this->ajaxReturn($ajax);
        }
    }


    /**
     * @deprecate 通过商品id得到这个商品的所有标签
     * @return mixed
     * @author 雷楚桥 on 2017/11/27:15:19
     */
    public function getLabel()
    {
        if (IS_POST) {
            $goods_id = I("goods_id");
            if (!empty($goods_id)) {
                $ajax['status'] = 1;
                $ajax['label'] = D("Label")->get_all_label($goods_id);
                $ajax['goods'] = D("Goods")->get_goods($goods_id);
            } else
                $ajax['status'] = 0;

            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 通过id得到标签
     * @param $label_id int 标签id
     * @return mixed
     * @author 雷楚桥 on 2017/12/1:21:00
     */
    public function getLabelById()
    {
        if (IS_POST) {
            $label_id = I("label_id");
            if (!empty($label_id)) {
                $ajax['status'] = 1;
                $ajax['label'] = D("Label")->get_label($label_id);
            } else
                $ajax['status'] = 0;

            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 修改标签
     * @return mixed
     * @author 雷楚桥 on 2017/12/1:21:22
     */
    public function updateLabel()
    {
        if (IS_POST) {
            $label_id = I("label_id");
            $data = array(
                'goods_id' => I("goods_id"),
                'label' => I("label"),
                'money' => I("money")
            );
            if ($label_id > 0) {//修改
                $data['Id'] = $label_id;
                D("Label")->save_label($data);
            } else {
                D("Label")->add_label($data);
            }
            D("Goods")->update_label(I("goods_id"));
            $ajax['status'] = 1;
            $this->ajaxReturn($ajax);
        }
    }

    /**
     * @deprecate 删除一个标签
     * @return mixed
     * @author 雷楚桥 on 2017/12/2:12:30
     */
    public function deleteLabel()
    {
        if (IS_POST) {
            $label_id = I("label_id");
            $label = D("Label")->get_label($label_id);
            D("Label")->delete_label($label_id);
            D("Goods")->update_label($label['goods_id']);
            $ajax['status'] = 1;
            $this->ajaxReturn($ajax);
        }
    }

}