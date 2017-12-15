<?php
namespace Home\Controller;

use Common\Api\Wechat;

/*
 * Oauth2.0
 * */
class OauthController extends HomeController
{
    public function index()
    {
        $code = $_GET['code'];
        $wechat = new Wechat();
        $openid = $wechat -> getOpenId($code);
        if(!D("User") -> is_exist($openid)){
            $user_info = $wechat -> getUserInfo($openid);
            if(isset($user_info['openid']))
                D("User") -> add_user_info($user_info);
        }
        session("user_id",$openid);
        switch(session("auth_redirect_no")){
            //TODO://根据不同跳转值，跳转至不同的页面
            case 1:
                $this->redirect("Shop/index");//商城界面
                break;
            case 2:
                $this->redirect("Shop/detail");//商城界面
                break;
            default:
                $this->redirect("Index/index");
        }
        return true;
    }


    public function bigEcho($str){
        echo '<h1>'.$str."</h1>";
    }

}