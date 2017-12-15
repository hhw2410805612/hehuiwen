<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- IE浏览器兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- 关键字 SEO优化 -->
<meta name="keywords" content="">
<meta name="description" content="">

<!-- 移动设备显示适配 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- 苹果设备参数 -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- 禁用电话号码探测 -->
<meta name="format-detection" content="telephone=no">
<!-- 手持设备优化 -->
<meta name="HandheldFriendly" content="true">

<!-- 禁止缓存 -->
<!--
-->
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">


<link href="/Public/static/bs/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="/Public/Home/css/base.css" rel="stylesheet" type="text/css"/>


<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
<![endif]--><!--[if gte IE 9]><!-->
<script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>

<script type="text/javascript" src="/Public/static/bs/js/bootstrap.min.js"></script>
    <title><?php echo ($meta_title); ?></title>
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/mine/address.css"/>

</head>
<body>
    <!--加载动画-->
    <!--<div class="body-onload">-->
        <!--<p>-->
            <!--<img class="img-circle" src="/Public/Home/images/onloading.gif"/>-->
            <!--<br/>-->
            <!--加载中..-->
        <!--</p>-->
    <!--</div>-->
    
    <div class="address-edit">
        <form action="<?php echo U('edit');?>" method="post">
            <input type="hidden" name="address_id" value="<?php echo ($address["address_id"]); ?>"/>
            <input type="hidden" name="selected_shop_id" value="<?php echo ($shop_id); ?>"/>

            <div class="container head">联系人</div>
            <div class="container body">
                <div class="row">
                    <div class="col-xs-3">
                        <span class="edit-label text-ellipsis">姓名</span>
                    </div>
                    <div class="col-xs-9">
                        <input name="name" placeholder="请填写收货人姓名" value="<?php echo ($address["name"]); ?>" autocomplete="off" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <span class="edit-label"></span>
                    </div>
                    <div class="col-xs-9">
                        <?php if($address['sex'] == null): ?><input type="hidden" name="sex" value="1"/>
                            <?php else: ?>
                            <input type="hidden" name="sex" value="<?php echo ($address["sex"]); ?>"/><?php endif; ?>
                        <span class='sex' sex-type="1">
                            <?php if($address['sex'] == 2): ?><span class="glyphicon glyphicon-ok-circle"></span>
                                <?php else: ?>
                                    <span class="glyphicon glyphicon-ok-circle" style="color: #d59405;"></span><?php endif; ?>
                        <span class="sex-name">先生</span>
                    </span>
                        <span class='sex' sex-type="2">
                        <?php if($address['sex'] == 2): ?><span class="glyphicon glyphicon-ok-circle" style="color: #d59405;"></span>
                                <?php else: ?>
                                    <span class="glyphicon glyphicon-ok-circle"></span><?php endif; ?>
                        <span class="sex-name">女士</span>
                    </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <span class="edit-label text-ellipsis">手机</span>
                    </div>
                    <div class="col-xs-9">
                        <input type="number" name="tell" value="<?php echo ($address["tell"]); ?>" placeholder="请填写收货手机号"
                               autocomplete="off" maxlength="11" required/>
                    </div>
                </div>
            </div>
            <div class="container head">收货地址</div>
            <div class="container body">
                <div class="row">
                    <div class="col-xs-5">
                        <span class="edit-label text-ellipsis">学校</span>
                    </div>
                    <div class="col-xs-7">
                        <input name="site" disabled value="宜宾学院" autocomplete="off" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-5">
                        <span class="edit-label text-ellipsis">楼号-门牌号</span>
                    </div>
                    <div class="col-xs-7">
                        <input name="xxsite" placeholder="例：A区13舍515寝室" value="<?php echo ($address["xxsite"]); ?>" autocomplete="off" required/>
                    </div>
                </div>
            </div>

            <div class="container save">
                <button class="btn btn-warning btn-block btn-lg">保存</button>
            </div>
        </form>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/mine/mine.address.js"></script>
    <script type="text/javascript">
        alert("目前只支持宜宾学院内配送");
        var shop_id = "<?php echo $shop_id ?>";

        //返回至主界面
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                if (shop_id == "" || shop_id == null)
                    window.location.href = Home + "Mine/address.html";
                else
                    window.location.href = Home + "Shop/detail/shop_id/" + shop_id + ".html";

            });
            window.history.pushState('forward', null, 'Home/Mine/edit.html');
        }
    </script>

</html>