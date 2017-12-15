<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/10/24
 * Time: 16:09
 */

namespace Home\Model;
use Think\Model;


class WxModel extends Model
{
    /**
     * @deprecated 保存token到数据
     * @param $data array 保存数据
     * @author 雷楚桥 on 2017/10/24:19:02
     */
    public function setToken($data){
        $name  =$data['name'];
        if(!$this -> where("name = '$name'") -> find()){
            $this -> add(array('name' => $name));
        };
        $this -> where("name = '$name'") -> save($data);
    }

    /**
     * @deprecated 通过name得到token
     * @param $name string token名
     * @return mixed
     * @author 雷楚桥 on 2017/10/24:19:04
     */
    public function getToken($name){
        return $this -> where("name = '$name'") -> find();
    }
}