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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/mine/courier.css"/>

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
    
    <div class="mine-courier">

        <!--管理头部-->
        <div class="manage-banner">
            <ul>
                <li class="loid selected" group-status="1">可接订单</li>
                <li class="loid" group-status="2">配送订单</li>
                <li class="loid" group-status="3">完成订单</li>
            </ul>
        </div>

        <!--订单内容-->
        <div class="group-list" id="groupList">
            <?php if(!empty($groupList)): if(is_array($groupList)): $key = 0; $__LIST__ = $groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="list-box">
                        <!--订单编号-->
                        <div class="container finsh-banner">
                            <div class="finsh-text">#<?php echo ($key); ?></div>
                            <div class="finsh-quick">&nbsp;&nbsp;立即送达</div>
                            <div class="confirm">用户已下单</div>
                        </div>
                        <!--用户信息-->
                        <div class="container user-info">
                            <div class="row head-box">
                                <?php echo ($vo["address"]["name"]); ?>&nbsp;&nbsp;
                                <?php if($vo['address']['sex'] == 1): ?>先生
                                    <?php else: ?>
                                    女士<?php endif; ?>
                            </div>
                            <div class="row tell-box">
                                <div class="tell-number"><?php echo ($vo["address"]["tell"]); ?></div>
                                <a href="tel://<?php echo ($vo["address"]["tell"]); ?>" class="tell">
                                    <div class="tell-pic">
                                        <span class="glyphicon glyphicon-earphone pic-call"></span>
                                    </div>
                                </a>
                            </div>
                            <div class="order-address">
                                <div class="finsh-time"><?php echo ($vo["address"]["site"]); ?>&nbsp;&nbsp;<?php echo ($vo["address"]["xxsite"]); ?></div>
                            </div>
                        </div>
                        <!--店铺信息-->
                        <div class="container rider-information">
                            <div class="rider-name">
                                <div class="name">店铺：<?php echo ($vo["shop"]["name"]); ?></div>
                                <a href="tel://<?php echo ($vo["shop"]["shop_tell"]); ?>" class="tell">
                                    <div class="name-pic">
                                        <span class="glyphicon glyphicon-earphone pic-call"></span>
                                    </div>
                                </a>
                            </div>
                            <div class="rider-name">
                                <div class="time"><?php echo ($vo["shop"]["address"]); ?></div>
                            </div>
                        </div>
                        <!--商品信息-->
                        <div class="container commodity">
                            <div class="row commodity-information">
                                <div class="col-xs-12">
                                    <div class="goods-text">商品</div>
                                </div>
                            </div>
                            <?php if(is_array($vo["goods"])): $i = 0; $__LIST__ = $vo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="row">
                                    <div class="col-xs-6 text-right goods-name text-ellipsis"><?php echo ($v["name"]); ?></div>
                                    <div class="col-xs-3 text-right goods-number">
                                        x<?php echo ($v["count"]); ?>
                                    </div>
                                    <div class="col-xs-3 text-right goods-money">
                                        <span class="glyphicon glyphicon-yen pic"></span><?php echo ($v["money"]); ?>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="row">
                                <div class="col-xs-12 text-right total-num">
                                    总计：<span class="glyphicon glyphicon-yen"></span><span
                                        class="total"><?php echo ($vo["money"]); ?></span>
                                </div>
                            </div>
                            <div class="row sure-box">
                                <div class="col-xs-12 text-right">
                                    <button class="btn btn-primary accept" group-id="<?php echo ($vo["goods_group_id"]); ?>">接受配送</button>
                                </div>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <div class="container">
                    <div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px"
                         role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong class="text-center">目前没有订单哦！</strong></div>
                </div><?php endif; ?>
        </div>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/common/news.js"></script>
    <script type="text/javascript" src="/Public/Home/js/mine/mine.courier.js"></script>

</html>