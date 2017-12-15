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
<body>
    <!--加载动画-->
    <!--<div class="body-onload">-->
        <!--<p>-->
            <!--<img class="img-circle" src="/Public/Home/images/onloading.gif"/>-->
            <!--<br/>-->
            <!--加载中..-->
        <!--</p>-->
    <!--</div>-->
    

    <!--个人中心-->
    <div class="shop-mine">

        <!--顶部图片-->
        <div class="container head padding-none fl">
            <!--<img class="mine-top-bg" src="/Public/Home/images/shop_icon/mine_top_bg.jpg"/>-->
            <div class="head-box text-center" id="courierBtn">
                <img class="img-circle head-img center-block" src="<?php echo ($user["head_img"]); ?>"/>
                <div class="nick center-block">
                    <div class="nick-box">
                        <span class="nick-name text-ellipsis"><?php echo ($user["nickname"]); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container body padding-none fl">
            <div class="row margin-none">
                <div class="col-xs-4 text-center" mine-no="1">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_1.png"/>
                    <span class="text-ellipsis">优惠</span>
                </div>
                <div class="col-xs-4 text-center box-center" mine-no="2">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_5.png"/>
                    <span class="text-ellipsis">订单</span>
                </div>
                <div class="col-xs-4 text-center" mine-no="3">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_3.png"/>
                    <span class="text-ellipsis">收藏</span>
                </div>
            </div>


            <div class="row margin-none">
                <div class="col-xs-4 text-center" mine-no="4">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_9.png"/>
                    <span class="text-ellipsis">帮助与服务</span>
                </div>
                <div class="col-xs-4 text-center box-center" mine-no="5">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_8.png"/>
                    <span class="text-ellipsis">收货地址</span>
                </div>
                <?php if($user['shop_id'] > 0): ?><div class="col-xs-4 text-center" mine-no="11">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_11.jpg"/>
                        <span class="text-ellipsis">我的店铺</span>
                    </div>
                    <?php elseif($user['shop_id'] == -1): ?>
                    <div class="col-xs-4 text-center" mine-no="13">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_11.jpg"/>
                        <span class="text-ellipsis">自营店</span>
                    </div>
                    <?php else: ?>
                    <div class="col-xs-4 text-center" mine-no="12">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_12.jpg"/>
                        <span class="text-ellipsis">申请开店</span>
                    </div><?php endif; ?>
            </div>

            <div class="row margin-none">
                <?php if($user['is_courier'] == 1): ?><div class="col-xs-4 text-center" mine-no="8">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_14.jpg"/>
                        <span class="text-ellipsis">我是骑手</span>
                    </div>
                    <?php else: ?>
                    <div class="col-xs-4 text-center" mine-no="7">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_15.jpg"/>
                        <span class="text-ellipsis">加入我们</span>
                    </div><?php endif; ?>
                <a class="col-xs-4 text-center box-center tell" href="tel://15775960256">
                    <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_13.jpg"/>
                    <span class="text-ellipsis">客服</span>
                </a>
                <?php if($user['is_admin'] == 1): ?><div class="col-xs-4 text-center" mine-no="14">
                        <img class="img-button center-block" src="/Public/Home/images/shop_icon/mine_icon_12.jpg"/>
                        <span class="text-ellipsis">管理员</span>
                    </div><?php endif; ?>
            </div>
        </div>
    </div>

    <!--底部导航-->
    <div class="shop-footer">
        <div class="container">
            <div class="row">
                <a href="<?php echo U('index');?>">
                    <div class="col-xs-4 text-center">
                        <img class="img-circle center-block"
                             src="/Public/Home/images/shop_icon/shop_index.png"/>
                        <span class="text-ellipsis footer-name">主页</span>
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
                        <img class="img-circle center-block" src="/Public/Home/images/shop_icon/shop_mine_fill.png"/>
                        <span class="text-ellipsis footer-name selected">我的</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--骑手信息修改-->
    <div class="modal fade" id="courier" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改信息</h4>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">昵称:</label>
                            <input type="text" name="name" value="<?php echo ($user["nickname"]); ?>" class="form-control"
                                   placeholder="建议不要太长" maxlength="10"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">电话:</label>
                            <input type="number" name="tell" value="<?php echo ($user["tell"]); ?>" class="form-control"
                                   placeholder="真实有效" maxlength="11"
                                   required/>
                        </div>
                        <?php if($user['is_courier'] == 1): ?><div class="form-group">
                                <label class="control-label">骑手状态:</label>
                                <?php if($courier['status'] == 1): ?><input type="radio" name="status" checked value="1"/>上班
                                    <input type="radio" name="status" value="0"/>休息
                                    <?php else: ?>
                                    <input type="radio" name="status" value="1"/>上班
                                    <input type="radio" name="status" checked value="0"/>休息<?php endif; ?>
                            </div><?php endif; ?>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消修改</button>
                        <button type="submit" class="btn btn-primary">保存信息</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/shop/shop.mine.js"></script>

</html>