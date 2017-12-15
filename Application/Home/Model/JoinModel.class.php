<?php

namespace Home\Model;
use Think\Model;

/**
 * @author 雷楚桥 on 2017/11/14:13:42
 */
class JoinModel extends Model{

    /**
     * @deprecate 增加一条加入我们数据
     * @param $data array 增加数据
     * @author 雷楚桥 on 2017/11/14:13:42
     */
    public function add_join_us($data){
        return M("Join_us") -> add($data);
    }

    /**
     * @deprecate 根据条件，得到join_us信息
     * @param $where string 查询条件
     * @return mixed
     * @author 雷楚桥 on 2017/11/14:13:49
     */
    public function get_join_us($where){
        return M("Join_us") -> where($where) -> find();
    }
}
