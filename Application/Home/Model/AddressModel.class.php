<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/10/16
 * Time: 21:05
 */

namespace Home\Model;

use Think\Model;


class AddressModel extends Model
{

    /**
     * @description:向Address表中增加一条数据
     * @param $data array 地址数据
     * @return int 操作状态
     */
    public function add_address($data)
    {
        return $this->add($data);
    }

    /**
     * @deprecated 描述
     * @param $data array 更新数组
     * @return bool
     * @author 雷楚桥 on 2017/10/17:15:42
     */
    public function update_address($data)
    {
        if (empty($data['address_id']))
            return false;
        $address_id = $data['address_id'];
        $map = array("address_id" => $address_id);
        $this->where($map)->save($data);
        return true;
    }

    /**
     * @deprecated 得到一条地址
     * @param $address_id
     * @return array 地址数组
     * @author 雷楚桥 on 2017/10/17:15:44
     */
    public function get_address($address_id)
    {
        $map = array("address_id" => $address_id);
        return $this->where($map)->find();
    }

    /**
     * @deprecated 得到用户的所有地址
     * @param $user_id string
     * @return array 地址数组
     * @author 雷楚桥 on 2017/10/17:15:46
     */
    public function get_user_address($user_id)
    {
        $map = array(
            "user_id" => $user_id,
            'status' => 1
        );
        return $this->where($map)->select();
    }

    /**
     * @deprecated 删除一条地址
     * @param $address_id int
     * @return bool
     * @author 雷楚桥 on 2017/10/17:16:01
     */
    public function delete_address($where)
    {
        $map = array(
            'status' => -1//删除
        );
        return $this->where($where)->save($map);
    }
}