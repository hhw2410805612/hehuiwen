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
    
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/mine/mine.css"/>

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
    
    <?php if(!empty($join)): ?><div class="container mine-join">
            <div class="join-success">
                <div class="img">
                    <img src="/Public/Home/images/icon/success.png" alt="" height="100px" class="img-circle center-block"><br/>
                        <?php if($join['status'] == 0): ?><span class="block text-center">提交成功，请等候处理</span>
                        <?php elseif($join['status'] == 1): ?>
                        <span class="block text-center">申请已通过，请等候通知</span>
                        <?php elseif($join['status'] == -1): ?>
                        <span class="block text-center">申请未通过</span><?php endif; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="container mine-join">
            <h3 class="text-center">加入我们</h3>
            <form action="<?php echo U('join');?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputName3" class="col-sm-2 control-label">姓名:</label>
                    <div class="col-sm-10">
                        <input type="name" class="form-control" name="name" id="inputName3" placeholder="真实姓名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">性别:</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="radio" checked="checked" name="sex" value="1"> 男士
                            </label>
                            <label>
                                <input type="radio" name="sex" value="2"> 女士
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号码:</label>
                    <div class="col-sm-10">
                        <input type="number" name="tell" class="form-control" placeholder="方便联系" maxlength="11" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">意向:</label>
                    <div class="col-sm-10">
                        <textarea name="want" rows="4" class="form-control" placeholder="你想加入我们从事什么职业" maxlength="250" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">介绍:</label>
                    <div class="col-sm-10">
                        <textarea name="intro" rows="8" class="form-control" placeholder="介绍一下自己吧" maxlength="1000" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-block btn-warning">提交</button>
                    </div>
                </div>
            </form>
        </div><?php endif; ?>

    <div id="musicBox" shop-id="<?php echo ($shop["shop_id"]); ?>"><audio id="bgMusic" src="/Public/Home/res/news.mp3"/></div>
</body>
    <script type="text/javascript" src="/Public/Home/js/common/common.js"></script>
    
</html>