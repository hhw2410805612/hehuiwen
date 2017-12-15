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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/manage/ourselves.css"/>

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
    
    <?php if(!empty($shops)): ?><!--我的店铺-->
        <div class="manage-ourselves">
            <!--店铺头部-->
            <div class="container shop-banner">
                <div class="row shop-list">
                    <?php if(is_array($shops)): $key = 0; $__LIST__ = $shops;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="col-xs-3" shop-id="<?php echo ($vo["shop_id"]); ?>">
                            <img class="img-circle" src="<?php echo ($vo["shop_img"]); ?>" alt="<?php echo ($vo["name"]); ?>">
                        </div>
                        <?php if(in_array(($key), explode(',',"4,8,12,16,20,24,28"))): ?><div class="row shop-list"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="row shop-info">
                    <div class="col-xs-8">
                        <div class="shop-name"><?php echo ($shops["0"]["name"]); ?></div>
                        <div class="shop-status"><?php echo ($shops["0"]["status_name"]); ?></div>
                    </div>
                    <div class="col-xs-4 text-right">
                        <a href="/index.php?s=/Home/Shop/detail/shop_id/<?php echo ($shops["0"]["shop_id"]); ?>.html">
                            <div class="shop-mine">我的店铺</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container shop-content">
                <div class="row money-total">
                    <div class="col-xs-6 order-form text-center">
                        <p class="number" id="todayNumber"><?php echo ($count["order"]); ?></p>
                        <p>今日有效订单</p>
                    </div>
                    <div class="col-xs-6 text-center">
                        <p class="number" id="todayMoney"><span class="glyphicon glyphicon-yen info-pict"></span><?php echo ($count["money"]); ?></p>
                        <p>今日营业额</p>
                    </div>
                </div>
                <div class="row information-total">
                    <!--<a href="<?php echo U('order');?>">-->
                    <div class="col-xs-4 information text-center" tag-no="1">
                        <p class="small-picture yellow text-center"><span
                                class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                        <p id="order_manage">订单管理</p>
                    </div>
                    <!--</a>-->
                    <!--<a href="<?php echo U('detail');?>">-->
                    <div class="col-xs-4 information text-center" tag-no="2">
                        <p class="small-picture pale-green text-center"><span
                                class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                        <p>商品管理</p>
                    </div>
                    <!--</a>-->
                    <div class="col-xs-4 information text-center" tag-no="3">
                        <p class="small-picture dark-blue"><span class="glyphicon glyphicon-thumbs-up info-pic"></span>
                        </p>
                        <p>店铺信息</p>
                    </div>
                </div>



            <!--商店信息模态框-->
            <div class="modal fade" id="shopInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <button type="button" class="close" id="shopInfoClose" data-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">修改信息</h4>
                        </div>
                        <form action="<?php echo U('update_shop');?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body" id="shopInfoBody">
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消修改</button>
                                <button type="submit" class="btn btn-warning">保存修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <?php else: ?>
        <div class="container">
            <div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong class="text-center">还没有自营店喔！</strong></div>
        </div><?php endif; ?>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript">
        var shop_id = "<?php echo $shops[0]['shop_id'];?>";
    </script>
    <script type="text/javascript" src="/Public/Home/js/manage/manage.ourselves.js"></script>
    <script type="text/javascript" src="/Public/Home/js/common/news.js"></script>

</html>