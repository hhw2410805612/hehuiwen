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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/manage/my_shop.css"/>

</head>
<body onload="hideOnLoading()">
    <!--加载动画-->
    <div class="body-onload">
        <p>
            <img class="img-circle" src="/Public/Home/images/onloading.gif"/>
            <br/>
            加载中..
        </p>
    </div>
    
        <!--店铺头部-->
    <div class="shop-banner">
            <div class="banner-picture">
                <div class="banner-img"><img src="/Public/Home/images/shop_icon/shop_logo.png" alt=""></div>
            </div>
            <div class="shop-name">波蹙体验店望京测试</div>
            <div class="open">营业中</div>

        <a href="/index.php?s=/Home/Shop/detail/shop_id/<?php echo ($shop["shop_id"]); ?>.html"><div class="look-myshop">查看我的门店 <span class="glyphicon glyphicon-menu-right text-right"></span></div></a>
    </div>
    <div class="container">
        <div class="row money-total">
            <div class="col-xs-6 order-form text-center">
                <p class="number">0</p>
                <p>今日有效订单</p>
            </div>
            <div class="col-xs-6 text-center">
                <p class="number"><span class="glyphicon glyphicon-yen info-pict"></span>0</p>
                <p>今日营业额</p>
            </div>
        </div>
        <div class="row information-total">
            <div class="col-xs-4 information text-center">
                <p class="small-picture yellow text-center"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                <p>订单列表</p>
            </div>
            <a href="<?php echo U('detail');?>">
                <div class="col-xs-4 information text-center">
                    <p class="small-picture pale-green text-center"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                    <p>商品管理</p>
                </div>
            </a>
            <div class="col-xs-4">
                <p class="small-picture dark-blue"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                <p>餐厅公告</p>
            </div>
            <!--<div class="col-xs-4 text-center">-->
                <!--<p class="small-picture reddish-orange text-center"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>-->
                <!--<p>财务信息</p>-->
            <!--</div>-->
        </div>
        <!--<div class="row information-total">-->
            <!--<div class="col-xs-4 information">-->
                <!--<p class="small-picture light-blue"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>-->
                <!--<p>餐厅指数</p>-->
            <!--</div>-->
            <!--<div class="col-xs-4 information">-->
                <!--<p class="small-picture light-purple"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>-->
                <!--<p>商品管理</p>-->
            <!--</div>-->
            <!--<div class="col-xs-4">-->
                <!--<p class="small-picture dark-blue"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>-->
                <!--<p>餐厅公告</p>-->
            <!--</div>-->
        <!--</div>-->
    </div>

</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    


</html>