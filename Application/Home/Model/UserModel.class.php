<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/10/16
 * Time: 21:05
 */

namespace Home\Model;

use Think\Model;


class UserModel extends Model
{

    /**
     * 判断用户是否已经注册
     * @param $user_id string 用户标识
     */
    public function is_exist($user_id)
    {
        $user = $this->where("user_id = '$user_id'")->find();
        return $user['Id'] > 0 ? true : false;
    }

    /**
     * 增加一条用户
     * @param $data array 用户数据
     */
    public function add_user($data)
    {
        $this->add($data);
    }

    /**
     * @deprecate 修改用户数据
     * @param $data array 修改数据
     * @author 雷楚桥 on 2017/11/6:16:56
     */
    public function save_user($data){
        $user_id = $data['user_id'];
        if(empty($user_id)) $user_id = get_user_auth();
        return $this -> where("user_id = '$user_id'") -> save($data);
    }

    /**
     * 增加一条用户,根据user_info更新
     * @param $user_info array 用户数据
     */
    public function add_user_info($user_info)
    {
        $data = array(
            'user_id' => $user_info['openid'],//用户id
            'nickname' => $user_info['nickname'],//用户昵称
            'head_img' => $user_info['headimgurl'],//用户头像
            'is_shoper' => 0//是否是店主
        );
        $this->add_user($data);
    }

    /**
     * 得到一个用户
     * @param string $user_id 用户id
     */
    public function get_user($user_id = '', $key = '')
    {
        if (empty($user_id))
            $user_id = get_user_auth();
        $user = $this->where("user_id = '$user_id'")->find();
        return empty($key) ? $user : $user[$key];
    }

    /**
     * @deprecate 得到所有的用户
     * @return array
     * @author 雷楚桥 on 2017/12/4:14:19
     */
    public function select_user(){
        return $this -> select();
    }

}