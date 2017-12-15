<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/1
 * Time: 16:07
 */

namespace Home\Model;

class OrderModel extends BaseModel
{

    /**
     * @deprecate 创建一个订单组并将数据
     * @param $data array 数据
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:16:08
     */
    function add_order_group($data)
    {
        $jsonArr = $data['goods_select'];
        $goods_group_id = $this->get_random_id();
        $today = strtotime(date("Ymd"));
        $front_group = M("Order_group")->where("time >= '{$today}'")->order("group_no DESC")->find();
        $count = $front_group['group_no'] + 1;
        $group = array(
            'group_no' => $count + 1,
            'goods_group_id' => $goods_group_id,
            'shop_id' => $data['shop_id'],
            'user_id' => get_user_auth(),
            'address_id' => $data['address_id'],
            'courier_id' => 0,//0代表随机指派
            'comment' => $data['comment'],//备注
            'money' => $data['money'],
            'time' => time(),
            'star' => 0,//未评价
            'status' => 0 //未处理
        );
        M("Order_group")->add($group);
        foreach ($jsonArr as $key => $val) {
            if ($val['count'] <= 0) continue;
            $map = array(
                'goods_group_id' => $goods_group_id,
                'goods_id' => $val['goodsId'],
                'comment' => $val['comment'],
                'money' => $val['money'],
                'count' => $val['count']
            );
            $this->add_order($map);
        }
        return $goods_group_id;
    }

    /**
     * @deprecate 将一个订单组的每条订单插入订单表中
     * @param $map array 数据
     * @author 雷楚桥 on 2017/11/1:16:23
     */
    function add_order($map)
    {
        $this->add($map);
        D("Goods")->minus_stock($map['goods_id'], $map['count']);
    }


    /**
     * @deprecate 得到一个商品的销售量
     * @param $goods_id int 商品id
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:21:07
     */
    function get_goods_sell($goods_id)
    {
        $goods_list = $this->where("goods_id = '$goods_id'")->select();
        $count = 0;
        foreach ($goods_list as $key => $val) {
            $count += $val['count'];
        }
        return $count;
    }

    /**
     * @deprecate 得到一条订单组
     * @param $group_id int 订单组号
     * @param $is_admin bool 是否管理查询
     * @return array
     * @author 雷楚桥 on 2017/11/2:10:33
     */
    function get_order_group($group_id, $is_admin = false)
    {
        $map = array('goods_group_id' => $group_id);
        if (!$is_admin)
            $map['user_id'] = get_user_auth();
        return M("Order_group")->where($map)->find();
    }

    /**
     * @deprecate 得到所有订单组
     * @param $where string 查询条件
     * @param $is_admin bool 是否管理查询
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:18:34
     */
    function get_group_list($where = '', $is_admin = false)
    {
        $user_id = get_user_auth();
        $group = M("Order_group");
        if ($is_admin)
            $group = $group->where("user_id = '{$user_id}'");
        return $group->where($where)->order("time DESC")->select();
    }


    /**
     * @deprecate 得到订单列表
     * @param $group_id int 订单组编号
     * @param $goods_bool bool 是否直接得到的订单信息
     * @param $is_classify bool 是否显示类别[默认不显示]
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:18:41
     */
    function get_order_list($group_id, $goods_bool = false, $is_classify = false)
    {
        if ($goods_bool) {
            $goods_id_list = $this->where("goods_group_id = '$group_id'")->select();
            $goods = array();
            foreach ($goods_id_list as $key => $val) {
                $goods[$key] = D("Goods")->get_goods($val['goods_id']);
                $goods[$key]["count"] = $val['count'];
                $goods[$key]["real_money"] = $val['money'];
                $goods[$key]["comment"] = $val['comment'];
                if ($is_classify)
                    $goods[$key]['classify_name'] = D("Goods")->get_classify($goods[$key]['classify_id'], 'classify_name');
            }
            return $goods;
        } else
            return $this->where("goods_group_id = '$group_id'")->select();
    }


    /**
     * @deprecate 得到一个随机且唯一的数字串
     * @return string
     * @author 雷楚桥 on 2017/11/1:16:15
     */
    private function get_random_id()
    {
        //TODO:同一时间可能存在相同的订单号
        return "511052" . time();
    }


    /**
     * @deprecate 删除一个订单组
     * @param $group_id int 订单组号
     * @return int
     * @author 雷楚桥 on 2017/11/3:20:20
     */
    function delete_group($group_id)
    {
        M("Order_group")->where("goods_group_id = '$group_id'")->delete();
        $this->where("goods_group_id = '$group_id'")->delete();
        return 1;
    }

    /**
     * @deprecate 修改一个订单组的状态
     * @param $group_id int 订单组号
     * @param $status int 订单组号 （0：已下单，1: 已接单，2: 配送中，3：已完成，4：已评价，-1：已取消）
     * @return int
     * @author 雷楚桥 on 2017/11/3:20:20
     */
    function update_status($group_id, $status)
    {
        return M("Order_group")->where("goods_group_id = '$group_id'")->save(array("status" => $status));
    }

    /**
     * @deprecate 得到指定订单组
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:18:34
     */
    function get_appoint_group($map)
    {
        return M("Order_group")->where($map)->order("time ASC")->select();
    }

    /**
     * @deprecate 设置订单骑手
     * @param $group_id int 订单组id
     * @param $courier_id int 骑手id (骑手id为0代表自行派送，骑手id为-1则代表需要配送)
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:15:24
     */
    function set_courier($group_id, $courier_id)
    {
        return M("Order_group")->where("goods_group_id = '$group_id'")->save(array('courier_id' => $courier_id));
    }

    /**
     * @deprecate 得到骑手信息
     * @param $courier_id int 骑手id
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:15:52
     */
    function get_courier($courier_id)
    {
        return M("Courier")->where("courier_id = '$courier_id'")->find();
    }

    /**
     * @deprecate 统计商店每月订单的数量
     * @param $shop_id int 商店id
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:18:13
     */
    function count_mouth_group($shop_id, $status = 34)
    {
        if ($status == 34)
            return M("Order_group")->where("shop_id = '{$shop_id}' AND status >= 3 AND status <= 4")->count();
        return M("Order_group")->where("shop_id = '{$shop_id}' AND status = '{$status}'")->count();
    }


}