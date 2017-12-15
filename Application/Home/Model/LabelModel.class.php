<?php

namespace Home\Model;

use Think\Model;

/**
 * @author 雷楚桥 on 2017/11/27:15:20
 */
class LabelModel extends Model
{

    /**
     * @deprecate 得到一个商品的所有标签
     * @param $goods_id int 商品id
     * @return array
     * @author 雷楚桥 on 2017/11/27:15:20
     */
    public function get_all_label($goods_id)
    {
        return $this->where("goods_id = '{$goods_id}'")->select();
    }

    /**
     * @deprecate 通过标签id得到这个标签信息
     * @param $label_id int 标签id
     * @return mixed
     * @author 雷楚桥 on 2017/12/1:21:02
     */
    public function get_label($label_id)
    {
        return $this->where("Id = '{$label_id}'")->find();
    }

    /**
     * @deprecate 保存数据
     * @param $data array 保存数据
     * @param mixed
     * @author 雷楚桥 on 2017/12/1:21:25
     */
    public function save_label($data)
    {
        return $this->save($data);
    }

    /**
     * @deprecate 增加数据
     * @param $data array 增加数据
     * @return mixed
     * @author 雷楚桥 on 2017/12/1:21:26
     */
    public function add_label($data)
    {
        return $this->add($data);
    }

    /**
     * @deprecate 根据id删除标签
     * @param $label_id int 标签id
     * @return mixed
     * @author 雷楚桥 on 2017/12/2:12:34
     */
    public function delete_label($label_id){
        return $this -> where("Id = '{$label_id}'") -> delete();
    }
}
