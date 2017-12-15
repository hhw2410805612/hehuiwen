<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/2
 * Time: 13:10
 */

namespace Home\Controller;


class ManageController extends HomeController
{

    /**
     * @deprecate 申请开店
     * @author 雷楚桥 on 2017/11/3:19:00
     */
    public function apply()
    {
        $this->assign("meta_title", "申请开店");
        $this->display();
    }

    /**
     * @deprecate 管理主页
     * @author 雷楚桥 on 2017/11/2 09:24
     */
    public function index()
    {
        $user_id = get_user_auth();
        $shop = D("Shop")->is_shoper($user_id);
        //得到今日有效订单
        $order_list = D("Manage")->get_today_group($shop['shop_id'], 3, 4);

        $count['order'] = count($order_list);
        $count['money'] = 0;
        foreach ($order_list as $key => $val) {
            $count['money'] += $val['money'];
        }
        $this->assign("count", $count);
        $this->assign("order_list", $order_list);
        $this->assign("shop", $shop);
        $this->assign("meta_title", "我的店铺");
        $this->display();
    }


    /**
     * @deprecate 商品管理
     * @author 雷楚桥 on 2017/11/2:13:17
     */
    public function detail($shop_id = '')
    {
        $shop = empty($shop_id) ? D("Shop")->is_shoper() : D("Shop")->get_shop($shop_id);

        $classify = D("Goods")->get_goods_classify($shop['shop_id']);
        $notice = D("Notice")->get_notices($shop['shop_id']);//公告

        $this->assign("notice", $notice);
        $this->assign("classify", $classify);
        $this->assign('shop', $shop);
        $this->assign("meta_title", "商品管理");
        $this->display();
    }


    /**
     * @deprecate 得到订单管理信息
     * @author 雷楚桥 on 2017/11/3 09:44
     */
    public function order($shop_id = '')
    {
        //得到该店铺所有的未确认订单
        $shop = empty($shop_id) ? D("Shop")->is_shoper() : D("Shop")->get_shop($shop_id);

        $groupList = D("Order")->get_appoint_group("shop_id = '{$shop['shop_id']}' AND status = 0");

        foreach ($groupList as $key => $val){
            $groupList[$key]['address'] = D("Address")->get_address($val['address_id']);
            $groupList[$key]['time'] = date("m-d H:i", $val['time']);
        }

        $this->assign("shop_id", $shop['shop_id']);
        $this->assign("groupList", $groupList);
        $this->assign("meta_title", "订单管理");
        $this->display();
    }


    /**
     * @deprecate 增加商品
     * @author 雷楚桥 on 2017/11/2:15:27
     */
    public function add_goods()
    {
        if (IS_POST) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 41000;// 设置附件上传大小
            $upload->exts = array('jpg', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $info = $upload->upload();
            if (!$info && $upload->getError() != "没有文件被上传！") {// 上传错误提示错误信息
                $this->javascriptJump($upload->getError(), U("detail"));
            } else {// 上传成功
                $data = I("post.");
                if ($upload->getError() != "没有文件被上传！")
                    $data['image'] = "/Uploads/" . $info['image']['savepath'] . $info['image']['savename'];
                $shop_id = $data['shop_id'];
                if (empty($data['goods_id'])) {
                    D("Goods")->add_goods($data);
                    $this->javascriptJump("上传成功", U("detail",array("shop_id" => $shop_id)));
                } else {
                    D("Goods")->save_goods($data);
                    $this->javascriptJump("修改成功", U("detail",array("shop_id" => $shop_id)));
                }

            }
        }

    }


    /**
     * @deprecate 更新店铺信息
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:18:50
     */
    public function update_shop()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 51200;// 设置附件上传大小
        $upload->exts = array('jpg', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        $info = $upload->upload();
        if (!$info && $upload->getError() != "没有文件被上传！") {//上传错误提示错误信息
            $this->javascriptJump($upload->getError());
        } else {// 上传成功
            $data = I("post.");
            if ($upload->getError() != "没有文件被上传！")
                $data['shop_img'] = "/Uploads/" . $info['shop_img']['savepath'] . $info['shop_img']['savename'];
            D("Shop")->save_shop($data);
            $this->javascriptJump("修改成功");
        }
    }


    /**
     * @deprecate 增加类别
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:19:54
     */
    public function add_classify()
    {
        if (IS_POST) {
            $data = I("post.");
            if (empty($data['classify_id']))
                D("Goods")->add_classify($data);
            else
                D("Goods")->save_classify($data);
            $shop_id = $data['shop_id'];
            $this->javascriptJump("修改成功", U("detail",array("shop_id" => $shop_id)));
        }
    }


    /**
     * @deprecate 自营店
     * @author 雷楚桥 on 2017/11/13:14:14
     */
    public function ourselves()
    {
        $shops = D("Shop")->is_ourselves();
        if (!empty($shops)) {
            if ($shops[0]['status'] == 1)
                $shops[0]['status_name'] = '营业中';
            else if ($shops[0]['status'] == 0)
                $shops[0]['status_name'] = '休息中';
            else if ($shops[0]['status'] == -1)
                $shops[0]['status_name'] = '装修中';

            $order_list = D("Manage")->get_today_group($shops[0]['shop_id'], 3, 4);
            $count['order'] = count($order_list);
            $count['money'] = 0;
            foreach ($order_list as $key => $val) {
                $count['money'] += $val['money'];
            }
            $this->assign("count", $count);
        }
        $this->assign("shops", $shops);
        $this->assign("meta_title", "代理店");
        $this->display();
    }
    /**
        * @deprecate  今日订单统计
        * @param $shop_id int 店铺id
        * @return mixed
        * @author Administrator on 2017/11/21 11:53
    */
    public function today($shop_id=''){
        //得到今日该店铺所有确认的订单
        $shop = empty($shop_id) ? D("Shop")->is_shoper() : D("Shop")->get_shop($shop_id);
        $groupList = D("Manage")->get_today_group($shop['shop_id'], -1, 4);
        $count = array();
        foreach($groupList as $key => $val){
            if(empty($count[$val['status']]))
                $count[$val['status']]['number'] = $count[$val['status']]['money'] = 0;
            $count[$val['status']]['number'] ++;
            $count[$val['status']]['money'] += $val['money'];
            switch($val['status']){
                case -1:
                    $typename = '已取消';break;
                case 0:
                    $typename = '已下单';break;
                case 1:
                    $typename = '已接单';break;
                case 2:
                    $typename = '配送中';break;
                case 3:
                    $typename = '已完成';break;
                case 4:
                    $typename = '已收货';break;
                default:
                    $typename = null;break;
            }
            $groupList[$key]['typename'] = $typename;
            $count[$val['status']]['typename'] = $typename;
        }
        foreach ($groupList as $key => $val){
            $groupList[$key]['goods'] = D("Order")->get_order_list($val['goods_group_id'], true);
        }

        $this -> assign('groupList',$groupList);
        $this -> assign("count",$count);
        $this -> display();
    }
    /**
        * @deprecate  历史订单统计
        *@param shop_is int 店铺id
        * @return mixed
        * @author Administrator on 2017/11/21 11:58
    */
    public function history($shop_id = ''){
        //得到今日以前该店铺所有确认的订单
        $shop = empty($shop_id) ? D("Shop")->is_shoper() : D("Shop")->get_shop($shop_id);
        $groupList = D("Manage")->get_history_group($shop['shop_id'], -1, 4);
        foreach($groupList as $key => $val){
            if(empty($count[$val['status']]))
                $count[$val['status']]['number'] = $count[$val['status']]['money'] = 0;
                $count[$val['status']]['number'] ++;
                $count[$val['status']]['money'] += $val['money'];
            switch($val['status']){
                case -1:
                    $typename = '已取消';break;
                case 0:
                    $typename = '已下单';break;
                case 1:
                    $typename = '已接单';break;
                case 2:
                    $typename = '配送中';break;
                case 3:
                    $typename = '已完成';break;
                case 4:
                    $typename = '已收货';break;
                default:
                    $typename = null;break;
            }
            $groupList[$key]['typename'] = $typename;
            $count[$val['status']]['typename'] = $typename;
        }
        foreach ($groupList as $key => $val){
            $groupList[$key]['goods'] = D("Order")->get_order_list($val['goods_group_id'], true);
        }

        $this -> assign('groupList',$groupList);
        $this -> assign("count",$count);
        $this -> display();
    }

}