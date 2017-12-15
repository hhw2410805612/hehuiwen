<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/25
 * Time: 18:40
 */

namespace Home\Controller;
class AdminController extends HomeController
{
    /**
     * @deprecate 管理员首页
     * @author Administrator on 2017/11/25 18:45
     */
    public function index()
    {
        $this->display();
    }

    /**
     * @deprecate 店铺展示列表
     * @param
     * @return mixed
     * @author Administrator on 2017/11/28 20:54
     */
    public function show_list()
    {
        $shopList = D("Shop")->select();
        $this->assign('shopList', $shopList);
        $this->display();
    }

    /**
     * @deprecate 添加店铺
     * @param
     * @return mixed
     * @author Administrator on 2017/11/30 13:59
     */
    public function insert()
    {
        //得到店铺特色
        $getFeatures = D('Feature')->get_features();
        $this->assign('getFeatures', $getFeatures);
        //添加信息
        if (IS_POST) {
            $post = I("post.");
            $data = array(
                'name' => $post['name'],
                'shop_tell' => $post['shop_tell'],
                'address' => $post['address'],
                'is_ourselves' => $post['is_ourselves']
            );
            $result = D('Shop')->add_shop($data);
            if ($result) {
                $shop_id = $result;
            }
            foreach ($post['feature_no'] as $key => $val) {
                $data = array(
                    'shop_id' => $shop_id,
                    'feature_no' => $val['feature_no']
                );
                D("Shop_feature")->add($data);
            }
        }
        $this->display();
    }

    /**
     * @deprecate 修改店铺信息
     * @param $shop_id int
     * @return int
     * @author Administrator on 2017/11/30 17:04
     */
    public function modify($shop_id)
    {
        //得到店铺特色
        $getFeatures = D('Feature')->get_features();
        $this->assign('getFeatures', $getFeatures);
        //根据shop_id得到店铺信息
        $shopInfo = D("Shop")->get_shop($shop_id);

        $feature = D('Shop_feature')->find($shop_id);

        $this->assign('shopInfo', $shopInfo);
        $this->assign('feature_no', $feature['feature_no']);
        //修改店铺信息
        if (IS_POST) {
            $post = I("post.");
            $data = array(
                'shop_id' => $post['shop_id'],
                'name' => $post['name'],
                'shop_tell' => $post['shop_tell'],
                'notice' => $post['notice'],
                'address' => $post['address'],
                'status' => $post['status'],
                'is_ourselves' => $post['is_ourselves']
            );
            D('Shop')->update_shop($data);
            foreach ($post['feature_no'] as $key => $val) {
                $data = array(
                    'shop_id' => $shop_id,
                    'feature_no' => $val['feature_no']
                );
                D("Shop_feature")->save($data);
            }
        }
        $this->display();
    }

    /**
     * @deprecate 用户列表
     * @author Administrator on 2017/12/1 14:16
     */
    public function user_list()
    {

        $userInfo = D("User")->select_user();
        $this->assign('userInfo', $userInfo);
        $this->display();
    }

    /**
     * @deprecate 修改用户信息
     * @param $user_id 用户id
     * @author Administrator on 2017/12/1 17:07
     */
    public function edit($user_id)
    {
        $userInfo = D('User')->where("user_id ='$user_id'")->find();
        $this->assign('userInfo', $userInfo);
        if (IS_POST) {
            $data = array(
                'user_id' => I('user_id'),
                'nickname' => I('nickname'),
                'tell' => I('tell'),
                'shop_id' => I('shop_id'),
                'is_courier' => I('is_courier'),
                'is_admin' => I('is_admin')
            );

            D("User")->save_user($data);
        }

        $this->display();
    }

    /**
     * @deprecate 所有店铺订单
     * @author 雷楚桥 on 2017/12/4:15:12
     */
    public function count()
    {
        //得到所有的店铺
        $shop_list = D('Shop')->select();
        $this->assign("shop_list", $shop_list);
        $this->display();
    }

    /**
     * @deprecate 店铺页面
     * @author Administrator on 2017/12/2 21:30
     */
    public function order()
    {

        $this->display();
    }

    public function pay()
    {
        $this->display();
    }

    public function pay2()
    {
        ini_set('date.timezone', 'Asia/Shanghai');
        require_once __ROOT__."/pay/lib/WxPay.Api.php";
        require_once __ROOT__."/pay/example/WxPay.JsApiPay.php";
        require_once __ROOT__."/pay/example/log.php";

        //初始化日志
        $logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);


        //①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        foreach ($order as $key => $value) {
            echo "<font color='#00ff55;'>$key</font> : $value <br/>";
        }

        $jsApiParameters = $tools->GetJsApiParameters($order);

        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();

        $this -> assign('editAddress',$editAddress);
        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
    }
}