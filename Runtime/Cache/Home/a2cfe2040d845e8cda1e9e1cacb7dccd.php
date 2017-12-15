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
    
    <div class="address-manage">
        <div class="container head">
            <div class="row margin-none">
                <div class="col-xs-8 text-left">
                    <span class="name">我的地址管理</span>
                </div>
                <div class="col-xs-4 text-right">
                    <span class="manager">管理</span>
                </div>
            </div>
        </div>
        <div class="container pass"></div>
        <div class="container body">
            <?php if(is_array($addinfo)): $i = 0; $__LIST__ = $addinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="row">
                <div class="col-xs-9">
                    <span class="block detail-head text-ellipsis"><?php echo ($vo["site"]); ?>&nbsp;&nbsp;<?php echo ($vo["xxsite"]); ?></span>
                    <span class="block detail-body text-ellipsis"><?php echo ($vo["name"]); ?>&nbsp;&nbsp;<?php echo ($vo["sexname"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($vo["tell"]); ?></span>
                </div>
                <div class="col-xs-3 edit text-right">
                    <span class="glyphicon glyphicon-pencil edit-icon" address-id="<?php echo ($vo["address_id"]); ?>"></span>&nbsp;
                    <span class="glyphicon glyphicon-trash delete-icon" address-id="<?php echo ($vo["address_id"]); ?>"></span>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <!--新增用户地址-->
        <div class="container footer">
            <span class="glyphicon glyphicon-plus-sign"></span>
            <span class="new">新增收货地址</span>
        </div>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/mine/mine.address.js"></script>
    <script type="text/javascript">
        //返回至主界面
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                window.location.href = Home + "Shop/mine.html";
            });
            window.history.pushState('forward', null, 'address.html');
        }
    </script>

</html>