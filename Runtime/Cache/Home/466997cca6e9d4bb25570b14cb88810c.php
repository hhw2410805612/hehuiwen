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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/shop/order_detail.css"/>

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
    
    <div class="container">
        <div class="order-information">
            <ul class="list-group">
                <li class="list-group-item text-center finish">
                    <?php if($group['status'] == 0): ?>买家已下单
                        <?php elseif($group['status'] == 1): ?>
                        商家已接单
                        <?php elseif($group['status'] == 2): ?>
                        骑手配送中
                        <?php elseif($group['status'] == 3): ?>
                        订单已完成
                        <?php elseif($group['status'] == 4): ?>
                        订单已评价
                        <?php elseif($group['status'] == -1): ?>
                        订单已取消<?php endif; ?>
                </li>
                <li class="list-group-item text-center">
                    <?php if($group['status'] == 0): ?>商家还没有接单哦，可以打电话催一催。
                        <?php elseif($group['status'] == 1): ?>
                        商家已经接单，不要着急。
                        <?php elseif($group['status'] == 2): ?>
                        订单正在配送中，静静等待就好。
                        <?php elseif($group['status'] == 3): ?>
                        感谢你对本商品的支持，欢迎再次光临。
                        <?php elseif($group['status'] == 4): ?>
                        感谢你对本商品的支持，欢迎再次光临。
                        <?php elseif($group['status'] == -1): ?>
                        订单已取消，有什么问题给客服反馈哦。<?php endif; ?>
                </li>
                <li class="list-group-item text-center">
                    <a class="tell" href="tel://<?php echo ($shop["shop_tell"]); ?>"><button type="button" class="btn btn-default">联系商家</button></a>
                    <a class="tell" href="/index.php?s=/Home/Shop/detail/shop_id/<?php echo ($shop["shop_id"]); ?>.html"><button type="button" class="btn btn-warning">再来一单</button></a>
                </li>
            </ul>
        </div>
        <!--店家信息-->
        <div class="store-information">
            <span class="picture-left"><img src="<?php echo ($shop["shop_img"]); ?>" alt=""></span>
            <span class="shop-information"><?php echo ($shop["name"]); ?></span>
            <span class="picture-right"><img src="/Public/Home/images/shop_detail/right-font.png" alt=""></span>
        </div>
        <!--具体菜品数量-->
        <ul>
            <?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="dishes">
                    <div class="dishes-picture"><img src="<?php echo ($vo["goods"]["image"]); ?>" alt="<?php echo ($vo["goods"]["name"]); ?>"></div>
                    <p class="food-name"><?php echo ($vo["goods"]["name"]); ?></p>
                    <p class="food-num">x<?php echo ($vo["count"]); ?></p>
                    <p class="tmoney">￥<?php echo ($vo["goods"]["money"]); ?></p>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--各种费用-->
        <div class="cost">
            <p class="fl">配送费</p>
            <p class="fr">￥0</p>
        </div>
        <!--总计费用-->
            <div class="num-money">
                <div class="total"><span class="out-of-pocket">总计<a style="color: red">￥<?php echo ($group["money"]); ?></a></span></div>
            </div>
        <ul class="customer-information">
            <li>
                <span class="custom-claim">配送地址</span>
                <span class="claim">
                    <p><?php echo ($address["name"]); ?>(<?php if($address['sex'] == 1): ?>先生<?php else: ?>女士<?php endif; ?>)
                        &nbsp;&nbsp;<?php echo ($address["tell"]); ?><br/><?php echo ($address["site"]); ?>&nbsp;&nbsp;<?php echo ($address["xxsite"]); ?></p>
                </span>
            </li>
            <li><span class="custom-claim">配送服务</span><span class="claim">由商家提供服务</span></li>
            <li><span class="custom-claim">订单号码</span><span class="claim"><?php echo ($group["group_id"]); ?></span></li>
            <li><span class="custom-claim">订单时间</span><span class="claim"><?php echo ($group["time"]); ?></span></li>
            <li><span class="custom-claim">支付方式</span><span class="claim">货到付款</span></li>
        </ul>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/order.detail.js"></script>

</html>