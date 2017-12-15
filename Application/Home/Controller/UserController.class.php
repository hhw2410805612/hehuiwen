<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17
 * Time: 14:03
 */
namespace Home\Controller;
use Common\Api\Wechat;

class UserController extends HomeController
{

    //用户地址管理页面
    public function listing()
    {
        $addinfo = D("Address")->get_user_address(get_user_auth());
        $this->assign('addinfo', $addinfo);
        $this->display();
    }

    //添加用户地址
    public function insert()
    {
        if (IS_POST) {
            if (D("Address")->add_address(I("post.")))
                $this->success("添加成功！", 'User/listing');
            else
                $this->error('添加失败!');
        }
        $this->display();
    }

    //编辑用户地址
    public function modify($address_id)
    {
        $useradd = D("Address")->get_address($address_id);
        $this->assign('useradd', $useradd);
        if (IS_POST) {
            if (D("Address")->update_address(I("post.")))
                $this->success("修改成功！", 'User/listing');
            else
                $this->error('修改失败！');
        }
        $this->display();
    }

    //删除用户地址
    public function del($address_id)
    {
        if (D("Address")->delete_address($address_id))
            $this->success("删除成功！", 'User/listing');
        else
            $this->error('删除失败！');
    }


    //用户定位
    public function location(){
        $this -> display();
    }

}