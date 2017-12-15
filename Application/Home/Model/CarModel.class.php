<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/26
 * Time: 14:25
 */

namespace Home\Model;

use Think\Model;

class CarModel extends Model
{
    /**
     * @deprecate 增加购物车一条商品，如果有，就返回这个商品
     * @param $goods_id int 商品id
     * @param $count int 商品数量
     * @return mixed
     * @author 雷楚桥 on 2017/11/26:14:26
     */
    public function touch_goods($goods_id, $count)
    {
        $map = array(
            'user_id' => get_user_auth(),
            'shop_id' => D("Goods") -> get_goods($goods_id,'shop_id'),
            'goods_id' => $goods_id
        );
        if ($count <= 0)
            return $this->where($map)->delete();

        $goods = $this->where($map)->find();

        if (empty($goods)) {
            $map['count'] = $count;
            $this->add($map);
        } else {
            $goods['count'] = $count;
            $this->save($goods);
        }
        return $this->where($map)->find();
    }

    /**
     * @deprecate 得到用户购物车的所有记录
     * @param $is_detail bool 是否显示商品详情
     * @return mixed
     * @author 雷楚桥 on 2017/11/26:16:15
     */
    public function get_all_record($is_detail = false)
    {
        $user_id = get_user_auth();
        $goods_list = $this->where("user_id = '{$user_id}'")->select();
        if ($is_detail)
            foreach ($goods_list as $key => $val) {
                $goods_list[$key]['goods'] = D("Goods")->get_goods($val['goods_id']);
            }
        return $goods_list;
    }
}