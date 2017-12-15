<?php

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {


    /* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Error/error_404');
	}


    /**
     * 操作错误跳转的快捷方法
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function error($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,0,$jumpUrl,$ajax);
    }

    /**
     * 操作成功跳转的快捷方法
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function success($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,1,$jumpUrl,$ajax);
    }

    /**
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param Boolean $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    private function dispatchJump($message,$status=1,$jumpUrl='',$ajax=false){
        if(true === $ajax || IS_AJAX) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:array();
            $data['info']   =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            var_dump($data);
            $this->ajaxReturn($data);
        }
    }

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
