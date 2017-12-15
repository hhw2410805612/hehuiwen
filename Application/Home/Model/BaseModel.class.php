<?php
/**
 * Created by PhpStorm.
 * User: 雷楚桥
 * Date: 2017/11/6
 * Time: 14:38
 */
namespace Home\Model;

use Think\Model;
class BaseModel extends Model{

    /**
     * @deprecate 用户提示，并跳转
     * @param $msg string 提示信息
     * @param $url string 跳转路径
     * @author 雷楚桥 on 2017/11/2:13:24
     */
    protected function javascriptJump($msg, $url='')
    {
        echo '<meta charset="utf-8">';
        if(empty($url))
            echo '<script language="javascript"> alert("' . $msg . '"); window.history.back(-1); </script>';
        else
            echo '<script type="text/javascript">alert("' . $msg . '");location.href="' . $url . '";</script>';
    }
}