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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/shop/detail.css"/>

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
    

    <!--商店详情-->
    <div class="shop-detail">

        <!--商店信息-->
        <div class="container detail-head" data-toggle="modal" data-target="#shopInfo">
            <div class="row">
                <div class="col-xs-2-5">
                    <img class="shop-img" src="<?php echo ($shop["shop_img"]); ?>"/>
                </div>
                <div class="col-xs-9-5">
                    <p>
                        <span class="status">
                            <?php if($shop['status'] == '1'): ?>营业中
                                <?php elseif($shop['status'] == '0'): ?>
                                休息中
                                <?php elseif($shop['status'] == '-1'): ?>
                                装修中
                                <?php else: ?>
                                检查中<?php endif; ?>
                        </span>
                    </p>
                    <?php if($shop['notice'] != null): ?><p class="affiche text-ellipsis"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;&nbsp;<?php echo ($shop["notice"]); ?>
                        </p><?php endif; ?>
                </div>
            </div>
        </div>

        <!--商店信息-->
        <div class="modal fade" id="shopInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" id="shopSelectClose" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel"><?php echo ($shop["name"]); ?></h4>
                    </div>

                    <div class="modal-body" id="shopSelectBody">
                        <p class="text-left carousel"><?php echo ($shop["notice"]); ?></p>
                    </div>
                    <div class="modal-footer text-right">
                        <a class="tell" href="tel://<?php echo ($shop["shop_tell"]); ?>">
                            <button type="button" class="btn btn-default">联系商家</button>
                        </a>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">返回店铺</button>
                    </div>
                </div>
            </div>
        </div>

        <!--商品种类-->
        <div class="container detail-body">
            <div class="row goods">
                <div class="col-xs-3 padding-none goods-type">
                    <?php if(is_array($goods_classify)): $key = 0; $__LIST__ = $goods_classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="type-name" classify-id="<?php echo ($vo["classify_id"]); ?>"><?php echo ($vo["classify_name"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="col-xs-9 goods-list" id="goodsList"></div>
            </div>
        </div>

        <!--立即购买-->
        <div class="container detail-footer">
            <div class="row">
                <div class="col-xs-4 money-run">
                    <span>免配送费</span>
                </div>
                <div class="col-xs-5 money-all">
                    <span class="glyphicon glyphicon-yen"></span><span class="value">0</span>
                </div>
                <div class="col-xs-3 money-pay">
                    <span id="addressBtn" shop-id="<?php echo ($shop["shop_id"]); ?>">去结算</span>
                </div>
            </div>
        </div>

        <!--选择地址-->
        <div class="modal fade" id="addressSelect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" id="addressSelectClose" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel2">配送地址</h4>
                    </div>
                    <div class="modal-body" id="addressSelectBody"></div>
                    <div class="modal-footer text-right">
                        <a class="tell" href="/index.php?s=/Home/Mine/edit/shop_id/<?php echo ($shop["shop_id"]); ?>.html">
                            <button type="button" class="btn btn-default">新建地址</button>
                        </a>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="payBtn">货到付款</button>
                    </div>
                </div>
            </div>
        </div>

        <!--商品详情-->
        <div class="modal fade" id="goodsDetail" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="goodsDetailLabel">商品详情</h4>
                    </div>
                    <div class="modal-body" id="goodsDetailBody">
                        <img class="img-responsive" src="/Public/Home/images/onloading.gif" alt="正在加载中.."/>
                        <div class="alert alert-warning" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript">
        var classify = "<?php echo ($classify); ?>";
        var Home = "/Home/";
        var shop_id = "<?php echo ($shop["shop_id"]); ?>";
    </script>
    <script type="text/javascript" src="/Public/Home/js/shop/shop.detail.js"></script>

</html>