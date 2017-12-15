<?php

define("REDIRECT_URI", "http://yhd.lbmonkey.xin/index.php?Home/Oauth/index");

/**
 *
 */
/**
 * @deprecate 得到用户认证信息
 * @return $user_id string 用户id
 * @author 雷楚桥 on 2017/10/30:16:29
 */
function get_user_auth()
{
    $user_id = session('user_id');
    $wechat = new \Common\Api\Wechat();
    return !empty($user_id) ? $user_id : $wechat->getCode(U('Oauth/index'));
}


/**
 * @deprecate 对一个数组根据规则排序(选择排序法)
 * @param $array array 要排序的数组
 * @param $row string 排序依据列
 * @param $type string 排序类型[asc or desc]
 * @return array 排序好的数组
 * @author 雷楚桥 on 2017/10/30:16:49
 */
function array_sort($shop_list, $row, $type)
{
    if ($type == 'ASC') {
        foreach ($shop_list as $key => $val) {
            foreach ($shop_list as $k => $v) {
                echo "key:".$key." k:".$k." if:".($shop_list[$key][$row] > $shop_list[$k][$row])." \n";
                if ($shop_list[$key][$row] > $shop_list[$k][$row]) {
                    $temp = $shop_list[$k];
                    $shop_list[$k] = $shop_list[$key];
                    $shop_list[$key] = $temp;
                }
            }
        }
    } else if ($type == 'DESC')
        foreach ($shop_list as $key => $val) {
            foreach ($shop_list as $k => $v) {
                echo "key:".$key." k:".$k." if:".($shop_list[$key][$row] > $shop_list[$k][$row])." \n";
                if ($shop_list[$key][$row] < $shop_list[$k][$row]) {
                    $temp = $shop_list[$k];
                    $shop_list[$k] = $shop_list[$key];
                    $shop_list[$key] = $temp;
                }
            }
        }
    return $shop_list;
}


/**
 * @deprecate 用户提示，并跳转
 * @param $msg string 提示信息
 * @param $url string 跳转路径
 * @author 雷楚桥 on 2017/11/2:13:24
 */
function javascriptJump($msg, $url='')
{
    echo '<meta charset="utf-8">';
    if(empty($url))
        echo '<script language="javascript"> alert("' . $msg . '"); window.history.back(-1); </script>';
    else
        echo '<script type="text/javascript">alert("' . $msg . '");location.href="' . $url . '";</script>';
}

/**
 * @deprecate 得到user的信息
 * @param $user_id string 查询用户id
 * @param $key string 查询值
 * @return mixed
 * @author 雷楚桥 on 2017/11/5:10:18
 */
function getUser($user_id='',$key=''){
    return D("User") -> get_user($user_id,$key);
}

