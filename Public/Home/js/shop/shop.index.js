/*对象*/
var that = null;
var Home = "/index.php/Home/";

//文档加载完就执行
$(function () {
    updateShop();//更新主页

    //特色图标点击
    $(".feature-icon").click(function () {
        var classifyId = $(this).attr("classify-id");
        switch (classifyId) {
            case "1":
                updateSelect(0,1);
                break;
            case "2":
                updateSelect(0,2);
                break;
            case "3":
                updateSelect(0,3);
                break;
            case "4":
                redirect("Shop/detail/shop_id/12");
                break;
            case "5":
                updateSelect(0,5);
                break;
            case "6":
                redirect("Shop/detail/shop_id/10");
                break;
            case "7":
                redirect("Shop/detail/shop_id/14");
                break;
            case "8":
                updateSelect(0,8);
                break;
            default:
                redirect("Shop/detail/shop_id/4/classify/"+classifyId);
                break;
        }
        // redirect("Shop/doing");
    });

    //选择店铺
    $(".shop-list").on("click", ".shop-detail", function () {
        var shopId = $(this).attr("shop-id");
        redirect("Shop/detail/shop_id/" + shopId);
    });

});

//显示选项框
function showSelectModel(obj) {
    var modalLabel = "";//模态框标签
    var id = $(obj).attr('id');
    if (id === "selectClassify") {
        modalLabel = "分类";
        $.post(
            Home + "Ajax/getFeatures", {}, function (result, status) {
                var str = '<div class="container"><div class="row">';
                str += '<button type="button" class="btn btn-default btn-block';
                str += shopSelect[0] === 0 ? ' active">' : '" onclick="updateSelect(0,0)">';
                str += '全部商店</button>';
                for (var i in result) {
                    str += '<button type="button" class="btn btn-default btn-block';
                    str += shopSelect[0] === result[i]['feature_no'] ? ' active">' : '" onclick="updateSelect(0,' + result[i]['feature_no'] + ')">';
                    str += result[i]['feature_name'] + '</button>';
                }
                str += '</div> </div>';
                $("#shopSelectBody").html(str);
            }
        );
    } else if (id === "selectSort") {
        modalLabel = "排序";
        var sortArr = ['综合排序', '销量最高', '速度最快', '距离最近', '评分最高', '起送价最低', '配送费最低'];
        var str = '<div class="container"><div class="row">';
        for (var i in sortArr) {
            str += '<button type="button" class="btn btn-default btn-block';
            str += shopSelect[1] === i ? ' active">' : '" onclick="updateSelect(1,' + i + ')">';
            str += sortArr[i] + '</button>';
        }
        str += '</div> </div>';
        $("#shopSelectBody").html(str);
    } else if (id === "selectDiscount") {
        modalLabel = "优惠";
        // TODO 未实现
        var discountArr = ['全部优惠', '新店特惠', '超值折扣', '免费配送'];
        var str = '<div class="container"><div class="row">';
        for (var i in discountArr) {
            str += '<button type="button" class="btn btn-default btn-block';
            str += shopSelect[2] === i ? ' active">' : '" onclick="updateSelect(2,' + i + ')">';
            str += discountArr[i] + '</button>';
        }
        $("#shopSelectBody").html(str);
    }
    $("#modalLabel").html(modalLabel);
}

//修改选项框
function updateSelect(index, value) {
    shopSelect[index] = value;//更新配置
    $("#shopSelectClose").click();//关闭模态框

    //设置更新后的列表名
    if (index === 0) {
        if (value === 0) {
            updateSelectName(0, "全部商店");
        } else {
            $.post(Home + "Ajax/getFeatures", {
                feature_no: value
            }, function (result) {
                updateSelectName(0, result[0]["feature_name"]);
            });
        }
    } else if (index === 1) {
        var sortArr = ['综合排序', '销量最高', '速度最快', '距离最近', '评分最高', '起送价最低', '配送费最低'];
        updateSelectName(1, sortArr[value]);
    } else if (index === 2) {
        // TODO 未实现
        var discountArr = ['全部优惠', '新店特惠', '超值折扣', '免费配送'];
        updateSelectName(2, discountArr[value]);
    }
}

//更新列表名
function updateSelectName(index, selectName) {
    var selectStr = '<span>' + selectName + '</span><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>';
    var objArr = ["selectClassify", "selectSort", "selectDiscount"];
    $("#" + objArr[index]).html(selectStr);//更新列表的选择名

    //更新商店
    updateShop();
}

//更新商店
function updateShop() {
    $.post(
        Home + "Ajax/getShopList", {
            shopSelect: shopSelect
        }, function (result) {
            var str = '', data = result['data'];
            for (var d in data) {
                str += '<div class="row shop-detail" shop-id="' + data[d]['shop_id'] + '"> ' +
                    '<div class="col-xs-4"> ' +
                    '<img class="logo" src="' + data[d]['shop_img'] + '"/></div> ' +
                    '<div class="col-xs-8"> ' +
                    '<span class="block shop-name">' + data[d]['name'] + '</span> ' +
                    '<span class="block shop-intro"> ' +
                    '<span class="star"> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span> </span> ' +
                    '<span class="sell-out">已售' + data[d]['mouth_sell'] + '</span> </span>' +
                    '<span class="block shop-status">';
                if (parseInt(data[d]['status']) === 1)
                    str += '<span class="work">营业中</span></span>';
                else if (parseInt(data[d]['status']) === 0)
                    str += '<span class="sleep">休息中</span></span>';
                else
                    str += '<span class="sleep">处理中</span></span>';
                str += '</div></div>';
            }
            if (parseInt(data.length) === 0)
                str = '<div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong class="text-center">没有店铺哦！</strong> </div>';
            $("#shopList").html(str);
        }
    );
}
