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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/manage/index.css"/>

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
    
    <!--我的店铺-->
    <div class="manage-index">

        <!--店铺头部-->
        <div class="shop-banner">
            <div class="banner-picture">
                <img class="img-circle" src="<?php echo ($shop["shop_img"]); ?>" alt="<?php echo ($shop["name"]); ?>">
            </div>
            <div class="shop-name"><?php echo ($shop["name"]); ?></div>
            <?php if($shop['status'] == 1): ?><div class="open">营业中</div>
                <?php else: ?>
                <div class="open">休息中</div><?php endif; ?>
            <a href="/index.php?s=/Home/Shop/detail/shop_id/<?php echo ($shop["shop_id"]); ?>.html">
                <div class="look-myshop">查看我的门店 <span class="glyphicon glyphicon-menu-right text-right"></span></div>
            </a>
        </div>

        <div class="container">
            <div class="row money-total">
                <div class="col-xs-6 order-form text-center">
                    <p class="number"><?php echo ($count["order"]); ?></p>
                    <p>今日有效订单</p>
                </div>
                <div class="col-xs-6 text-center">
                    <p class="number"><span class="glyphicon glyphicon-yen info-pict"></span><?php echo ($count["money"]); ?></p>
                    <p>今日营业额</p>
                </div>
            </div>
            <div class="row information-total">
                <a href="<?php echo U('order');?>">
                    <div class="col-xs-4 information text-center">
                        <p class="small-picture yellow text-center"><span
                                class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                        <p>订单管理</p>
                    </div>
                </a>
                <a href="<?php echo U('detail');?>">
                    <div class="col-xs-4 information text-center">
                        <p class="small-picture pale-green text-center"><span
                                class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                        <p>商品管理</p>
                    </div>
                </a>
                <div class="col-xs-4" id="noticeBtn" shop-id="<?php echo ($shop["shop_id"]); ?>">
                    <p class="small-picture dark-blue"><span class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                    <p>店铺信息</p>
                </div>
            </div>
                <?php if($shop['shop_id'] == 24): ?><div class="row information-total">
                    <a href="<?php echo U('today');?>">
                        <div class="col-xs-4 information text-center">
                            <p class="small-picture reddish-orange text-center"><span
                                    class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                            <p>今日统计</p>
                        </div>
                    </a>

                    <a href="<?php echo U('history');?>">
                        <div class="col-xs-4 information text-center">
                            <p class="small-picture light-blue text-center"><span
                                    class="glyphicon glyphicon-thumbs-up info-pic"></span></p>
                            <p>历史统计</p>
                        </div>
                    </a>

                </div><?php endif; ?>
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
                            <input type="hidden" name="shop_id" value="<?php echo ($shop["shop_id"]); ?>"/>
                            <div class="form-group">
                                <label class="control-label">店铺名:</label>
                                <input type="text" name="name" class="form-control" placeholder="建议不要太长"
                                       value="<?php echo ($shop["name"]); ?>" maxlength="10" required/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">店铺状态:</label>
                                <?php if($shop['status'] == 1): ?><input type="radio" name="status" checked value="1"/>营业
                                    <input type="radio" name="status" value="0"/>休息
                                    <?php else: ?>
                                    <input type="radio" name="status" value="1"/>营业
                                    <input type="radio" name="status" checked value="0"/>休息<?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">地址:</label>
                                <input type="text" name="address" class="form-control" placeholder="店铺所处位置"
                                       value="<?php echo ($shop["address"]); ?>" maxlength="250"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">联系电话:</label>
                                <input type="number" name="shop_tell" class="form-control" maxlength="13"
                                       value="<?php echo ($shop["shop_tell"]); ?>" required/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">头像:</label>
                                <input type="file" name="shop_img" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">公告:</label>
                                <textarea name="notice" class="form-control" placeholder="不得超过250字" maxlength="250"><?php echo ($shop["notice"]); ?></textarea>
                            </div>
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

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/common/news.js"></script>
    <script type="text/javascript" src="/Public/Home/js/manage/manage.index.js"></script>

</html>