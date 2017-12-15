<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/10/16
 * Time: 21:05
 */
namespace Home\Model;

use Think\Model;


class FeatureModel extends Model
{
    /**
     * @deprecated 得到特色信息
     * @param $where array 查询条件
     * @return mixed
     * @author 雷楚桥 on 2017/10/19:12:58
     */
    public function get_features($where){
        return $this -> where($where) -> select();
    }
}