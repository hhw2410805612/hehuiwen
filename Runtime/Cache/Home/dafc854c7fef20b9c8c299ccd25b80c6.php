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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/manage/detail.css"/>

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
    <div class="manage-detail">

        <!--商店信息-->
        <div class="container detail-head" data-toggle="modal" data-target="#shopInfo">
            <div class="row">
                <div class="col-xs-2-5">
                    <img class="shop-img" src="<?php echo ($shop["shop_img"]); ?>"/>
                </div>
                <div class="col-xs-9-5">
                    <p><span class="status"><?php if($shop['status'] == '1'): ?>配送中<?php else: ?>休息中<?php endif; ?></span></p>
                    <?php if($shop['notice'] != null): ?><p class="affiche text-ellipsis"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;&nbsp;<?php echo ($shop["notice"]); ?></p><?php endif; ?>
                </div>
            </div>
        </div>

        <!--商店信息模态框-->
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
                        <p class="text-left"><?php echo ($shop["notice"]); ?></p>
                    </div>
                    <div class="modal-footer text-right">
                        <a class="tell" href="tel://17716174003">
                            <button type="button" class="btn btn-default">拨打电话</button>
                        </a>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">返回店铺</button>
                    </div>
                </div>
            </div>
        </div>

        <!--菜品种类-->
        <div class="container detail-body">
            <div class="row goods">
                <div class="col-xs-3 padding-none goods-type">
                    <?php if(is_array($classify)): $i = 0; $__LIST__ = $classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="type-name" classify-id="<?php echo ($vo["classify_id"]); ?>"><?php echo ($vo["classify_name"]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="col-xs-9 goods-list" id="goodsList"></div>
            </div>
        </div>

        <!--类别管理-->
        <div class="container detail-footer">
            <div class="row">
                <div class="col-xs-3 money-pay">
                    <span id="classifyPlusBtn">增加类别</span>
                </div>
                <div class="col-xs-6 money-run" id="classifyName">未选择类别</div>
                <div class="col-xs-3 money-pay">
                    <span id="classifyEditBtn" classify-id="">编辑</span>
                </div>
            </div>
        </div>

        <!--商品模态框-->
        <div class="modal fade" id="goodsEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" id="goodsEditClose" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="goodsEditLabel">增加商品</h4>
                    </div>
                    <form action="<?php echo U('add_goods');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body" id="goodsEditBody">
                            <input type="hidden" name="goods_id" value=""/>
                            <input type="hidden" name="shop_id" value="<?php echo ($shop["shop_id"]); ?>"/>
                            <input type="hidden" name="classify_id" value=""/>
                            <div class="form-group">
                                <label class="control-label">商品名:</label>
                                <input type="text" name="name" class="form-control" placeholder="建议不要太长" maxlength="10"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">描述:</label>
                                <input type="text" name="describe" class="form-control" placeholder="简单地描述一下商品,可以不填"
                                       maxlength="250"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">价格:</label>
                                <input type="number" name="money" class="form-control" placeholder="填写规范,如10,10.5"
                                       maxlength="5" step="0.1" required/>
                                <!--<input type="number" name="money" class="form-control" placeholder="填写规范,如10,10.5"-->
                                       <!--maxlength="5" step="0.01" required/>-->
                            </div>
                            <div class="form-group">
                                <label class="control-label">图片:</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">库存:</label>
                                <input type="number" name="stock" class="form-control" maxlength="5" required/>
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

        <!--类别模态框-->
        <div class="modal fade" id="classifyEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" id="classifyEditClose" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="classifyEditLabel">增加商品</h4>
                    </div>
                    <form action="<?php echo U('add_classify');?>" method="post">
                        <div class="modal-body" id="classifyEditBody">
                            <input type="hidden" name="shop_id" value="<?php echo ($shop["shop_id"]); ?>"/>
                            <input type="hidden" name="classify_id" value=""/>
                            <div class="form-group">
                                <label class="control-label">类别名:</label>
                                <input type="text" name="classify_name" class="form-control" placeholder="建议不要太长" maxlength="10" required/>
                            </div>
                        </div>
                        <div class="modal-footer text-center" id="classifyEditFooter"></div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
    <script type="text/javascript" src="/Public/Home/js/manage/manage.detail.js"></script>
    <script type="text/javascript" src="/Public/Home/js/common/news.js"></script>

</html>