var Home = "/index.php/Home/";
$(function () {

    //请求新订单
    setInterval(getOurGroup, 8000);

    var firstShop = $(".manage-ourselves .shop-list").children(".col-xs-3").get(0);
    $(firstShop).addClass("img-selected");

    //商店选择
    $(".manage-ourselves .shop-list .col-xs-3").click(function () {
        // $(this).siblings(".img-selected").removeClass("img-selected");
        $(".manage-ourselves .shop-list .img-selected").removeClass("img-selected");
        $(this).addClass("img-selected");
        shop_id = parseInt($(this).attr("shop-id"));
        updateContent();
    });

    //类别选择
    $(".manage-ourselves .shop-content .information-total .information").click(function () {
        var tagNo = parseInt($(this).attr("tag-no"));
        switch (tagNo) {
            case 1:
                redirect("Manage/order/shop_id/" + shop_id);
                break;
            case 2:
                redirect("Manage/detail/shop_id/" + shop_id);
                break;
            case 3:
                updateForm();//更新表单内容
                $("#shopInfo").modal("show");
                break;
            case 4:
                redirect("Manage/today/shop_id/" + shop_id);
                break;
            case 5:
                redirect("Manage/history/shop_id/" + shop_id);
                break;
        }
    });

});

//更新内容
function updateContent() {
    $.post(
        Home + "Ajax/getShopTodayCount", {
            shop_id: shop_id
        }, function (result) {
            $("#todayNumber").html(result['count']['order']);
            $("#todayMoney").html('<span class="glyphicon glyphicon-yen info-pict"></span>' + result['count']['money']);
            var str = '<div class="col-xs-8"><div class="shop-name">' + result['shop']['name'] + '</div>' +
                '<div class="shop-status">' + result['shop']['status_name'] + '</div></div>' +
                '<div class="col-xs-4 text-right">' +
                '<a href="/Home/Shop/detail/shop_id/' + result['shop']['shop_id'] + '.html">' +
                '<div class="shop-mine">我的店铺</div></a></div>';
            $(".manage-ourselves .shop-banner .shop-info").html(str);
        }
    );
}

//更新表单内容
function updateForm() {
    $.post(
        Home + "Ajax/getShop", {
            shop_id: shop_id
        }, function (result) {
            var data = result['data'];
            var str = '<input type="hidden" name="shop_id" value="' + data['shop_id'] + '"/><div class="form-group text-left">' +
                '<label class="control-label">店铺名:</label><input type="text" name="name" class="form-control" placeholder="建议不要太长"\n' +
                'value="' + data['name'] + '" maxlength="10" required/></div><div class="form-group text-left">' +
                '<label class="control-label">店铺状态:</label>' +
                '<input type="radio" name="status" value="1"/>营业' +
                '&nbsp;&nbsp;<input type="radio" name="status" value="0"/>休息' +
                '&nbsp;&nbsp;<input type="radio" name="status" value="-1"/>装修' +
                '</div><div class="form-group text-left"><label class="control-label">地址:</label>' +
                '<input type="text" name="address" class="form-control" placeholder="店铺所处位置"' +
                'value="' + data['address'] + '" maxlength="250"/></div><div class="form-group text-left"> ' +
                '<label class="control-label">联系电话:</label>' +
                '<input type="number" name="shop_tell" class="form-control" maxlength="13"' +
                'value="' + data['shop_tell'] + '" required/></div><div class="form-group text-left"> ' +
                '<label class="control-label">起送价:</label>'  +
                '<input type="number" name="start_money" class="form-control" ' +
                'value= "' + data['start_money'] + '" required/></div><div class="form-group text-left"> ' +
                '<label class="control-label">配送价:</label>'   +
                '<input type="number" name="run_money" class="form-control" ' +
                'value= "' + data['run_money'] + '" required/></div><div class="form-group text-left">' +
                '<label class="control-label">头像:</label>' +
                '<input type="file" name="shop_img" class="form-control"/></div>' +
                '<div class="form-group text-left">' +
                '<label class="control-label">公告:</label>\n' +
                '<textarea name="notice" class="form-control" placeholder="不得超过250字" maxlength="250">' + data['notice'] + '</textarea></div>';
            $("#shopInfoBody").html(str);
            $("#shopInfoBody input[name='status'][value='" + data['status'] + "']").prop("checked", "checked");
        }
    );
}

//更新统计
function updateCount(data) {
    var iconList = $(".manage-ourselves .shop-list .col-xs-3");
    for (var i = 0; i < iconList.length; i++) {
        var shopId = $(iconList[i]).attr("shop-id");
        if (data[shopId] != undefined){
            $(iconList[i]).append('<div class="number">' + data[shopId] + '</div>');
        }
    }


    // for (var i in iconList) {
    // var shopId = $(iconList[i]).attr("shop-id");
    // console.log(shopId);
    //     if (data[shopId] != undefined)
    // $(iconList[i]).append('<div class="number">' + data[shopId] + '</div>');
    // }
}