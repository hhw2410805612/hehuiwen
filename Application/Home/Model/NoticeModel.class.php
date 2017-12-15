<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/1
 * Time: 14:42
 */

namespace Home\Model;
use Think\Model;

class NoticeModel extends Model
{

    /**
     * @deprecate 根据店铺id的得到所有的公告
     * @param $shop_id int 店铺id
     * @return mixed
     * @author 雷楚桥 on 2017/11/1:14:43
     */
    public function get_notices($shop_id){
        return $this -> where("shop_id = '$shop_id'") -> select();
    }
}