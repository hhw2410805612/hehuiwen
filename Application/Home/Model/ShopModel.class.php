<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/10/30
 * Time: 9:35
 */

namespace Home\Model;

use Think\Model;

/**
 * 商店模型
 */
class ShopModel extends Model
{

    /**
     * @deprecated 根据特色得到商店
     * @param feature_id int 特色id
     * @return mixed shop 商店列表
     * @author 雷楚桥 on 2017/10/30:9:35
     */
    public function get_shop_list($feature_no = null)
    {
        if (!empty($feature_no)) {
            $shop_list_id = M("Shop_feature")->where("feature_no = $feature_no")->field("shop_id") -> order("shop_id ASC")->select();
            $shop_list = array();
            foreach ($shop_list_id as $key => $val) {
                $shop_id = $val['shop_id'];
                $shop = $this->where("shop_id = '$shop_id' AND status >= 0")->find();
                if (!empty($shop))
                    $shop_list[] = $shop;
            }
        } else {
            $shop_list = $this->where("status >= 0") -> order("shop_id ASC")->select();
        }
        foreach ($shop_list as $key => $val) {
            $shop_list[$key]['mouth_sell'] = D("Order")->count_mouth_group($val['shop_id']);
        }
        //默认排序
        $shop_list = $this->shop_list_sort($shop_list);

        return $shop_list;
    }


    /**
     * @deprecate 商店排序
     * @param $shop_list array 排序前的商店
     * @param $type int 排序方式[1:'默认排序']
     * @return mixed
     * @author 雷楚桥 on 2017/11/15:14:16
     */
    public function shop_list_sort($shop_list)
    {
        $temp = array();
        foreach ($shop_list as $key => $val) {
            if ($val['status'] == 1)
                $temp[] = $val;
        }
        foreach ($shop_list as $key => $val) {
            if ($val['status'] == 0)
                $temp[] = $val;
        }
        return $temp;
    }

    /**
     * @deprecate 得到一个商店的信息
     * @param $shop_id
     * @return array
     * @author 雷楚桥 on 2017/10/31:13:26
     */
    public function get_shop($shop_id)
    {
        return $this->where("shop_id = '$shop_id' AND status != -2")->find();
    }

    /**
     * @deprecate 根据条件得到一个店铺
     * @param $map string 查询条件
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:13:31
     */
    public function get_info($map)
    {
        return $this->where($map)->where("status >= 0")->find();
    }

    /**
     * @deprecate 得到一个商店的所有商品类别
     * @param $shop_id
     * @return array
     * @author 雷楚桥 on 2017/10/31:20:25
     */
    public function get_classify($shop_id)
    {
        return M("Goods_classify")->where("shop_id = '$shop_id'")->select();
    }


    /**
     * @deprecate 得到该类型的所有正常售卖商品
     * @param $classify_id int 类型id
     * @return mixed
     * @author 雷楚桥 on 2017/10/31:20:49
     */
    public function get_goods($classify_id)
    {
        return M("Goods")->where("classify_id = '$classify_id' AND status != -1")->select();
    }

    /**
     * @deprecate 更新一个店铺的信息
     * @param $data array 更新数据
     * @return bool
     * @author 雷楚桥 on 2017/11/2:18:52
     */
    public function save_shop($data)
    {
        return $this->save($data);
    }

    /**
     * @deprecate 根据店主在，增加一个店铺
     * @param 店主id
     * @author 雷楚桥 on 2017/11/2:20:41
     */
    public function add_user_shop($user_id)
    {
        $user = D("User")->get_user($user_id);
        $data = array(
            'shop_id' => $user['shop_id'],
            'shop_img' => $user['head_img'],
            'name' => $user['nickname'] . "的小铺",
            'status' => 0
        );
        $this->add($data);
        return $data['shop_id'];
    }

    /**
     * @deprecate 判断是否是店主
     * @author 雷楚桥 on 2017/11/5:10:05
     */
    public function is_shoper($user_id = '')
    {
        if (empty($user_id))
            $user_id = get_user_auth();
        $shop_id = D("User")->get_user($user_id, "shop_id");
        if ($shop_id == 0)
            javascriptJump("你还不是店主哦！");
        if ($shop_id == -1) {
            $shop = $this->where("is_ourselves = '1'")->select();
        } else {
            $shop = $this->where("shop_id = '{$shop_id}'")->find();
            if (empty($shop)) {
                $shop_id = $this->add_user_shop($user_id);
                $shop = $this->get_shop($shop_id);
            }
        }
        return $shop;
    }

    /**
     * @deprecate 判断是否是自营店
     * @author 雷楚桥 on 2017/11/13:14:33
     */
    public function is_ourselves($user_id = '')
    {
        if (empty($user_id))
            $user_id = get_user_auth();
        $shop_id = D("User")->get_user($user_id, "shop_id");
        if ($shop_id >= 0)
            javascriptJump("你还不是内部人员哦！");
        $shops = $this->where("is_ourselves = '1'")->select();
        return $shops;
    }

}