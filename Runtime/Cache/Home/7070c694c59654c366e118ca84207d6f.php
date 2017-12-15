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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/shop/shop.css"/>

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
    

    <!--商城主页-->
    <div class="shop-index">

        <!--顶部图片-->
        <div class="container padding-none fl">
            <img src="/Public/Home/images/shop_top_bg.jpg"/>
        </div>

        <!--商品种类-->
        <div class="container padding-none goods-type fl">
            <div class="container-fluid center-block">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-3 text-center feature-icon" classify-id="1">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/087.png"/>
                            <span class="text-ellipsis">宿舍小铺</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="2">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/090.png"/>
                            <span class="text-ellipsis">夜宵</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="3">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/068.png"/>
                            <span class=" text-ellipsis">下午茶</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="7">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/064.jpg"/>
                            <span class=" text-ellipsis">一元快递</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 text-center feature-icon" classify-id="5">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/001.png"/>
                            <span class=" text-ellipsis">美食外卖</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="6">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/065.png"/>
                            <span class=" text-ellipsis">蛋糕餐厅</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="4">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/006.png"/>
                            <span class=" text-ellipsis">水果</span>
                        </div>
                        <div class="col-xs-3 text-center feature-icon" classify-id="8">
                            <img class="img-circle center-block" src="/Public/Home/images/shop_icon/064.png"/>
                            <span class=" text-ellipsis">校园微店</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--类型列表-->
        <div class="container padding-none goods-select fl ">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4">
                        <span class="center-block select-span text-ellipsis" type="button" data-toggle="modal"
                              data-target="#shopSelect" id="selectClassify" onclick="showSelectModel(this)">
                            <span>全部商店</span>
                            <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        </span>
                    </div>
                    <div class="col-xs-4 span-col">
                        <span class="center-block select-span text-ellipsis" type="button" data-toggle="modal"
                              data-target="#shopSelect" id="selectSort" onclick="showSelectModel(this)">
                            <span>综合排序</span>
                            <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        </span>
                    </div>
                    <div class="col-xs-4">
                        <span class="center-block select-span text-ellipsis" type="button" data-toggle="modal"
                              data-target="#shopSelect" id="selectDiscount" onclick="showSelectModel(this)">
                            <span>全部优惠</span>
                            <span class="glyphicon glyphicon-menu-down"
                                  aria-hidden="true"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!--选择模态框-->
        <div class="modal fade" id="shopSelect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" id="shopSelectClose" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">分类</h4>
                    </div>
                    <div class="modal-body" id="shopSelectBody"></div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>

        <!--商城列表-->
        <div class="container shop-list fl" id="shopList"></div>

    </div>

    <!--底部导航-->
    <div class="shop-footer">
        <div class="container">
            <div class="row">
                <a href="<?php echo U('index');?>">
                    <div class="col-xs-4 text-center">
                        <img class="img-circle center-block"
                             src="/Public/Home/images/shop_icon/shop_index_fill.png"/>
                        <span class="text-ellipsis footer-name selected">主页</span>
                    </div>
                </a>
                <a href="<?php echo U('order');?>">
                    <div class="col-xs-4 text-center">
                        <img class="img-circle center-block" src="/Public/Home/images/shop_icon/shop_order.png"/>
                        <span class="text-ellipsis footer-name">订单</span>
                    </div>
                </a>
                <a href="<?php echo U('mine');?>">
                    <div class="col-xs-4 text-center">
                        <img class="img-circle center-block" src="/Public/Home/images/shop_icon/shop_mine.png"/>
                        <span class="text-ellipsis footer-name">我的</span>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/shop.index.new.js"></script>

</html>