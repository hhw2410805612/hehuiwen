<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/6
 * Time: 14:38
 */

namespace Home\Model;

class CourierModel extends BaseModel
{

    /**
     * @deprecate 得到骑手信息
     * @param $courier_id int 骑手id
     * @return mixed
     * @author 雷楚桥 on 2017/11/5:15:52
     */
    function get_courier($courier_id)
    {
        return $this->where("courier_id = '$courier_id'")->find();
    }

    /**
     * @deprecate 查找是否有骑手
     * @return bool
     * @author 雷楚桥 on 2017/11/6:13:26
     */
    public function have_courier()
    {
        $courier = $this->where("status = 1")->find();
        return $courier > 0 ? false : true;
    }

    /**
     * @deprecate 判断是否是骑手
     * @param $user_id string 用户id
     * @param $is_back bool 是否退出
     * @return mixed
     * @author 雷楚桥 on 2017/11/6:14:34
     */
    function is_courier($user_id = '', $is_back = true)
    {
        if (empty($user_id))
            $user_id = get_user_auth();
        $is_courier = D("User")->get_user($user_id, 'is_courier');
        if ($is_courier == 1) {
            $courier = $this->where("user_id = '$user_id'")->find();
            if (empty($courier)) {
                $map = array(
                    'user_id' => $user_id,
                    'name' => D("User")->get_user($user_id, 'nickname')
                );
                $this->add($map);
                $courier = $this->where("user_id = '$user_id'")->find();
            }
            return $courier;
        } else if ($is_back)
            $this->javascriptJump("你还不是骑手哦");
        else
            return null;
    }


    /**
     * @deprecate 保存骑手信息
     * @param $data array 骑手信息
     * @author 雷楚桥 on 2017/11/6:14:51
     */
    public function save_courier($data)
    {
        if (empty($data['courier_id'])) {
            $user_id = get_user_auth();
            $this->where("user_id = '$user_id'")->save($data);
        } else
            $this->save($data);
    }

}