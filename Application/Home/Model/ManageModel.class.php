<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/3
 * Time: 13:55
 */

namespace Home\Model;

use Think\Model;

/**
 * 商店管理模型
 * Class ManageModel
 * @package Home\Controller
 */
class ManageModel extends Model
{

    /**
     * @deprecate 得到商店的所有订单
     * @param $shop_id int 商店id
     * @param $statusF int 订单状况范围开始
     * @param $statusE int 订单状况范围结束
     * @return mixed
     * @author 雷楚桥 on 2017/11/3:13:56
     */
    public function get_order_list($shop_id, $statusF, $statusE)
    {
        return M("Order_group")->where("shop_id = '$shop_id' AND status >= '$statusF' AND status <= '$statusE'")->order("time DESC")->select();
    }

    /**
     * @deprecate 得到今日订单
     * @param $shop_id int 商店id
     * @param $statusF int 订单状况范围开始
     * @param $statusE int 订单状况范围结束
     * @return mixed
     * @author 雷楚桥 on 2017/11/7:13:45
     */
    public function get_today_group($shop_id='',$statusF,$statusE){
        if(empty($shop_id))
        $shop_id = D("User") -> get_user(get_user_auth(),'shop_id');
        $time = strtotime(date("Ymd"));
        return M("Order_group") -> where("shop_id = '$shop_id' AND status >= '$statusF' AND status <= '$statusE' AND time >= '$time'") -> select();
    }
    /**
        * @deprecate 得到历史订单
        * @param $shop_id int 商店id
        * @return mixed
        * @author Administrator on 2017/11/21 18:24
    */
    public function get_history_group($shop_id='',$statusF,$statusE){
        if(empty($shop_id))
        $shop_id = D("User") -> get_user(get_user_auth(),'shop_id');
        $time = strtotime(date("Ymd"));
        return M("Order_group") -> where("shop_id = '$shop_id' AND status >= '$statusF' AND status <= '$statusE' AND time <= '$time'") -> select();

    }

    /**
     * @deprecate 申请一个骑手
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:15:16
     */
    public function get_courier()
    {
        return M("Courier")->where("status = 1")->find();
    }


}