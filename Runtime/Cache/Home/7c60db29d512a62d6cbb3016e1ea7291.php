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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/mine/order.css"/>

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
    
    <div class="mine-order">
        <div class="order-list">
            <?php if(!empty($orderList)): if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="container detail" goods-id="<?php echo ($vo["goods_group_id"]); ?>" shop-id="<?php echo ($vo["shop"]["shop_id"]); ?>">
                        <div class="row shop">
                            <div class="gray-block"></div>
                            <div class="col-xs-3 shop-image">
                                <img src="<?php echo ($vo["shop"]["shop_img"]); ?>"/>
                            </div>
                            <div class="col-xs-5 shop-name-box text-ellipsis">
                                <span class="name text-ellipsis"><?php echo ($vo["shop"]["name"]); ?></span>
                            </div>
                            <div class="col-xs-4 order-status text-right text-ellipsis">
                                <?php if($vo['status'] == 0): ?>买家已下单
                                    <?php elseif($vo['status'] == 1): ?>
                                    商家已接单
                                    <?php elseif($vo['status'] == 2): ?>
                                    骑手配送中
                                    <?php elseif($vo['status'] == 3): ?>
                                    订单已完成
                                    <?php elseif($vo['status'] == 4): ?>
                                    订单已评价
                                    <?php elseif($vo['status'] == -1): ?>
                                    订单已取消<?php endif; ?>
                            </div>
                        </div>
                        <?php if(is_array($vo["goods"])): $i = 0; $__LIST__ = $vo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="row goods">
                                <div class="col-xs-7 col-xs-offset-3 text-ellipsis name"><?php echo ($v["name"]); ?></div>
                                <div class="col-xs-2 text-right text-ellipsis number">x<?php echo ($v["count"]); ?></div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>

                        <div class="row money">
                            <div class="col-xs-12 text-right">
                                共1件商品,实付<span class="number">￥<?php echo ($vo["money"]); ?></span>
                            </div>
                        </div>
                        <div class="row footer">
                            <div class="col-xs-12">
                                <?php if($vo['status'] == 0): ?><a class="tell" href="tel://<?php echo ($vo["shop"]["shop_tell"]); ?>">
                                        <button class="btn btn-default">联系商家</button>
                                    </a>
                                    <button type="button" class="btn btn-default cancel-order"
                                            group-id="<?php echo ($vo["goods_group_id"]); ?>">取消订单
                                    </button>
                                    <?php elseif($vo['status'] == -1): ?>
                                    <button type="button" class="btn btn-default delete-order"
                                            group-id="<?php echo ($vo["goods_group_id"]); ?>">删除订单
                                    </button>
                                    <?php else: ?>
                                    <a class="tell" href="tel://<?php echo ($vo["shop"]["shop_tell"]); ?>">
                                        <button class="btn btn-default">联系商家</button>
                                    </a>
                                    <a class="tell" href="/index.php?s=/Home/Shop/detail/shop_id/<?php echo ($vo["shop"]["shop_id"]); ?>.html">
                                        <button type="button" class="btn btn-warning">再来一单</button>
                                    </a><?php endif; ?>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <div class="container">
                    <div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong class="text-center">没有订单哦！</strong></div>
                </div><?php endif; ?>
        </div>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/mine/mine.order.js"></script>

</html>