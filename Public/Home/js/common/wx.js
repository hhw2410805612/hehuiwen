/**
 * Created by 雷楚桥 on 2017/10/23.
 */
var Home = '/index.php/Home/';

//文档加载就执行
$(function () {
    $.post(
        Home + "Ajax/getWxAPI", {
            'url': location.href.split("#")[0]
        }, function (result) {
            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: result['appId'], // 必填，公众号的唯一标识
                timestamp: result['timestamp'], // 必填，生成签名的时间戳
                nonceStr: result['nonceStr'], // 必填，生成签名的随机串
                signature: result['signature'],// 必填，签名，见附录1
                jsApiList: ['chooseWXPay'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });
        }
    );

    wx.ready(function () {
        $.post(
            Home + "Ajax/getWxPay", {
                'goods_name':'可乐',
                'order_index':'5110521510056943',
                'order_money':1
            }, function (result) {
                alert(JSON.stringify(result));
                //发起一个微信支付
                // wx.chooseWXPay({
                //     timestamp: result['timestamp'], // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
                //     nonceStr: result['nonce_str'], // 支付签名随机串，不长于 32 位
                //     package: result['package'], // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
                //     signType: 'MD5', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
                //     paySign: result['sign'], // 支付签名
                //     success: function (res){
                //         alert(res);
                //     },error:function(res){
                //         alert(res);
                //     }
                // });
            }
        );
    });

});
