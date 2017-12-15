<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/1
 * Time: 18:48
 */

namespace Home\Model;

use Think\Model;

class GoodsModel extends Model
{

    /**
     * @deprecate 得到一条商品信息
     * @param $key string 查询关键字
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:18:49
     */
    function get_goods($goods_id, $key = '')
    {
        $goods = $this->where("goods_id = '$goods_id'")->find();
        return empty($key) ? $goods : $goods[$key];
    }


    /**
     * @deprecate 根据类别id得到一个类别的信息
     * @param $classify_id int 类别id
     * @param $key string 查询关键字
     * @return mixed
     * @author 雷楚桥 on 2017/12/3:17:17
     */
    function get_classify($classify_id,$key=''){
        $classify = M("Goods_classify")->where("classify_id = '$classify_id'")->find();
        return empty($key) ? $classify : $classify[$key];
    }

    /**
     * @deprecate 得到店铺的所有种类
     * @param $shop_id int 店铺id
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:13:39
     */
    function get_goods_classify($shop_id)
    {
        return M("Goods_classify")->where("shop_id = '$shop_id'")->select();
    }

    /**
     * @deprecate 增加一条商品
     * @author 雷楚桥 on 2017/11/2:15:39
     */
    function add_goods($data)
    {
        return $this->add($data);
    }

    /**
     * @deprecate 修改一条商品
     * @author 雷楚桥 on 2017/11/2:17:01
     */
    function save_goods($data)
    {
        return $this->save($data);
    }


    /**
     * @deprecate 减少商品的库存
     * @param $goods_id int 商品id
     * @param $minus int 减少数量
     * @author 雷楚桥 on 2017/11/15:13:42
     */
    function minus_stock($goods_id, $minus)
    {
        $goods = $this->get_goods($goods_id);
        $goods['stock'] -= $minus;
        if ($goods['stock'] < 0)
            $goods['stock'] = 0;
        $this->save($goods);
    }

    /**
     * @deprecate 删除一条商品
     * @param 参数
     * @author 雷楚桥 on 2017/11/2:16:04
     */
    function delete_goods($goods_id)
    {

    }

    /**
     * @deprecate 更新一条商品的状态
     * @author 雷楚桥 on 2017/11/2:16:07
     */
    function update_status($goods_id, $status)
    {
        return $this->where("goods_id = '$goods_id'")->save(array('status' => $status));
    }

    /**
     * @deprecate 增加一个类别
     * @param $data array 类别参数
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:19:58
     */
    function add_classify($data)
    {
        return M("Goods_classify")->add($data);
    }

    /**
     * @deprecate 保存一个类别
     * @param $data array 类别参数
     * @return mixed
     * @author 雷楚桥 on 2017/11/2:19:59
     */
    function save_classify($data)
    {
        return M("Goods_classify")->save($data);
    }


    /**
     * @deprecate 删除一条类别
     * @param $where string 删除条件
     * @return bool
     * @author 雷楚桥 on 2017/11/2:20:27
     */
    function delete_classify($where)
    {
        return M("Goods_classify")->where($where)->delete();
    }


    /**
     * @deprecate 更新一个商品的标签状态
     * @param $goods_id int 商品id
     * @return mixed
     * @author 雷楚桥 on 2017/12/2:12:36
     */
    function update_label($goods_id)
    {
        $count = count(D("Label")->get_all_label($goods_id));
        $map['goods_id'] = $goods_id;
        $map['have_label'] = $count > 0 ? 1 : 0;
        return $this -> save_goods($map);
    }


}