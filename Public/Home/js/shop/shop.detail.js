/**
 * Created by 雷楚桥 on 2017/10/31.
 */
var Home = "/index.php/Home/";

var goodsSelect = [];//选择的商品列表
var selectClassify = 0;//选择的类别

$(function () {
    var goodsListObj = $("#goodsList");//商品列表
    var labelSelectFooter = $("#labelSelectFooter");//底部选择

    setFirstIndex();//设置第一次进来的界面

    //类型选择
    $(".shop-detail .detail-body .goods-type .type-name").click(function () {
        var selectedObj = $(".shop-detail .detail-body .goods-type .selected");
        selectedObj.removeClass("selected");
        $(this).addClass("selected");
        selectClassify = $(this).attr("classify-id");
        updateContent();
    });

    //购物车减少
    goodsListObj.on("click", ".operate .glyphicon-minus-sign", function () {
        carMinus(this);
    });
    labelSelectFooter.on("click", ".operate .glyphicon-minus-sign", function () {
        carMinus(this);
    });


    //购物车增加
    goodsListObj.on("click", ".operate .glyphicon-plus-sign", function () {
        carPlus(this);
    });
    labelSelectFooter.on("click", ".operate .glyphicon-plus-sign", function () {
        carPlus(this);
    });

    //规格按钮
    goodsListObj.on("click", ".check-des", function () {
        var obj = this;
        var goodsId = $(obj).attr("goods-id");
        $("#labelSelect").modal("show");
        $.post(
            Home + "Ajax/getLabel", {
                goods_id: goodsId
            }, function (result) {
                var str = '', label = result['label'];
                for (var la in label) {
                    str += '<button class="btn-label btn btn-default" label-money="' + label[la]['money'] + '">' + label[la]['label'] + '</button>';
                }
                $("#labelSelect .size-list").html(str);
                $("#labelSelect .size-list").attr("goods-id", goodsId);
                $("#labelSelect .size-list").attr("goods-money", result['goods']['money']);
                $("#labelSelectFooter .footer-detail").html("￥" + result['goods']['money']);
                $("#labelSelectFooter .label-sure").attr({
                    "goods-id": goodsId,
                    "label-money": result['goods']['money']
                });
                $("#labelSelectFooter .number").attr({
                    "goods-id": goodsId,
                    'stock': result['goods']['stock'],
                    "money": result['goods']['money'],
                    "comment":''
                });
                updateCar();
            }
        );
    });

    //选择规格
    $("#labelSelect #labelSelectBody .size-list").on("click", ".btn-label", function () {
        if (!$(this).hasClass("btn-selected"))
            $(this).addClass("btn-selected");
        else $(this).removeClass("btn-selected");
        var parent = $(this).parent();
        var beSelected = parent.children(".btn-selected");
        var parentMoney = parseFloat(parent.attr("goods-money"));
        var labelName = '';
        for (var i = 0; i < beSelected.length; i++) {
            parentMoney += parseFloat($(beSelected[i]).attr("label-money"));
            if (labelName !== '')
                labelName += '、';
            labelName += $(beSelected[i]).html();
        }
        parentMoney = Math.round(parentMoney * 10) / 10;//加了配料后的价格
        var str = "￥" + parentMoney;
        if (labelName !== '')
            str += '<span class="bei">(' + labelName + ')</span>';

        $("#labelSelectFooter .footer-detail").html(str);
        $("#labelSelectFooter .operate .number").attr({"money": parentMoney, "comment": labelName});
        var goodsId = $("#labelSelectFooter .operate .number").attr("goods-id");
        var numberCount = getArrayCount({"goodsId": goodsId, "money": "" + parentMoney, "comment": labelName});
        $("#labelSelectFooter .operate .number").html("" + numberCount);
        updateCar();//更新按钮
    });

    //图片查看详情
    goodsListObj.on("click", " .row .goods-detail", function () {
        // goodsListObj.on("click", " .row .img-rounded,.goods-detail", function () {
        var goodsId = $(this).attr("goods-id");

        $("#goodsDetail").modal("show");
        $.post(
            Home + "Ajax/getGoodsDetail", {
                goods_id: goodsId
            }, function (result) {
                $("#goodsDetailLabel").html(result['data']['name']);
                $("#goodsDetailBody img").attr("src", result['data']['image']);
                $("#goodsDetailBody .alert-warning").html(result['data']['describe']);
            }
        );
    });

    //选择地址
    $(".detail-footer").on("click",".money-can-pay",function(){
        if (confirm("您确认要下单吗？")) {
            //检查订单信息
            $.post(Home + "Ajax/checkOrder", {
                shop_id: $(this).attr("shop-id")
            }, function (result) {
                if (result['status'] == 2) {
                    if (confirm("您还没有收货地址，是否创建？"))
                        redirect("Mine/address/shop_id/" + shop_id);
                } else if (result['status'] == 1) {
                    $("#addressSelect").modal("show");
                    //得到地址列表
                    var str = '', address = result['address'];
                    for (var a in address) {
                        str += '<p><b>选择地址</b></p><p class="text-ellipsis block text-left"><input name="address_id" type="radio"';
                        if (a == 0) str += 'checked="checked"';
                        str += 'value="' + address[a]['address_id'] + '"/>' + address[a]['name'] + '&nbsp;';
                        str += address[a]['sex'] == 1 ? '男' : '女';
                        str += '&nbsp;&nbsp;' + address[a]['tell'] + '</p><p class="block text-left" style="padding-left: 30px">' + address[a]['site'] + '&nbsp;&nbsp;' + address[a]['xxsite'] + '</p>';
                    }
                    str +='<p><b>备注</b></p><textarea class="form-control footer-comment" rows="4" placeholder="请填写你的小习惯哦"></textarea>';
                    $("#addressSelectBody").html(str);
                } else if (result['status'] == 0)
                    alert("该店铺处于休息中！");
                else if (result['status'] == -1)
                    alert("该店铺处于装修中！");
                return false;
            });
        }
    });

    //支付
    $("#payBtn").click(function () {
        pay();
    })

});

//设置第一次进来的界面
function setFirstIndex() {
    var typeObj, typeObjects = $(".shop-detail .detail-body .goods-type").children(".type-name");
    typeObj = $(typeObjects[0]);
    if (classify != 0)
        for (var t in typeObjects) {
            var classifyId = $(typeObjects[t]).attr("classify-id");
            if (classify == classifyId) {
                typeObj = $(typeObjects[t]);
                break;
            }
        }
    typeObj.addClass("selected");
    selectClassify = typeObj.attr("classify-id");
    updateContent();//更新内容
    updateCar();
}

//支付
function pay() {
    var real_money = parseFloat($(".detail-footer .money-all .value").html());
    var goods_name = '购买商品',money = (Math.round(real_money * 10) / 10) * 100;
    callpay(goods_name,money);
}

//保存订单
function saveOrder() {
    var address_id = $("#addressSelectBody input[name=address_id]:checked").val();
    var shop_id = $(".detail-footer .money-can-pay").attr("shop-id");
    var money = $(".detail-footer .money-all .value").html();
    var comment = $("#addressSelectBody .footer-comment").val();
    var json = [];
    for(var gs in goodsSelect){
        var gsJson = JSON.parse(gs);
        gsJson['count'] = goodsSelect[gs];
        json[json.length] = gsJson;
    }

    //保存订单信息
    $.post(Home + "Ajax/saveOrder", {
        goods_select: json,
        money: money,
        address_id: address_id,
        comment:comment,
        shop_id: shop_id
    }, function (result) {
        if (result['status'] == 1)
            redirect("Shop/order_detail/group_id/" + result['group_id']);
        else
            alert("下单失败！");
    });
}

//更新选择内容
function updateContent() {
    //得到这个商品分类的所有商品
    $.post(
        Home + "Ajax/getGoods", {
            classify_id: selectClassify
        }, function (result) {
            var str = '', data = result['data'];
            for (var d in data) {
                str += '<div class="row"><img class="img-rounded" src="' + data[d]['image'] + '"/><div class="goods-detail" goods-id="' + data[d]['goods_id'] + '"><span class="goods-name text-ellipsis">' + data[d]['name'] + '</span>' +
                    '<span class="goods-sell text-ellipsis">月售' + data[d]['sell'] + '&nbsp;&nbsp;库存' + data[d]['stock'] + '</span><span class="goods-money"><span class="glyphicon glyphicon-yen"></span>' + data[d]['money'] + '</span></div>';
                str += parseInt(data[d]['have_label']) === 0 ?
                    '<span class="operate"><span class="glyphicon glyphicon-minus-sign"></span><span class="number" stock="' + data[d]['stock'] + '" goods-id="' + data[d]['goods_id'] + '" money="' + data[d]['money'] + '">0</span>' +
                    '<span class="glyphicon glyphicon-plus-sign"></span></span></div>' :
                    '<span class="check-des" goods-id="' + data[d]['goods_id'] + '">选规格<span class="number">0</span></span></div>';
            }
            if (data === null)
                str = '<div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong class="text-center">没有商品哦！</strong> </div>';
            $("#goodsList").html(str);
        }
    );
}

//更新购物车
function updateCar() {
    var selectMoney = 0;//总价格

    var goodsListObj = $(".shop-detail");

    //将所有的规格数量清空
    var checkDesNum = goodsListObj.find(".check-des .number");
    for (var i = 0; i < checkDesNum.length; i++) {
        $(checkDesNum[i]).html("0");
        $(checkDesNum[i]).removeClass("show");
    }
    for (var i in goodsSelect) {
        var json = JSON.parse(i);
        selectMoney += json.money * goodsSelect[i];
        var number = goodsListObj.find(".operate .number[goods-id=" + json.goodsId + "]")[0];

        var comment = $(number).attr("comment");
        if (comment === undefined)
            comment = "";
        if (comment === json.comment) {
            var minusObj = $(number).prevAll(".glyphicon-minus-sign");

            if (goodsSelect[i] > 0) {
                $(number).addClass("show-inline");
                $(minusObj).addClass("show-inline");
            } else {
                $(number).removeClass("show-inline");
                $(minusObj).removeClass("show-inline");
            }
            $(number).html(goodsSelect[i]);
        }


        var checkDes = goodsListObj.find(".check-des[goods-id=" + json.goodsId + "]");
        var num = checkDes.find(".number")[0];
        $(num).addClass("show");
        $(num).html(parseInt($(num).html()) + goodsSelect[i]);

    }

    selectMoney = Math.round(selectMoney * 10) / 10;

    $(".detail-footer .money-all .value").html("" + selectMoney);//设置购买总价格
    var needMoney = start_money - selectMoney;
    needMoney = Math.round(needMoney * 10) / 10;
    if (needMoney > 0) {
        $("#addressBtn").parent().removeClass("money-can-pay");
        $("#addressBtn").html('还差<span class="value">' + needMoney + '</span>元');

    } else {
        var real_money = selectMoney + parseFloat(run_money);
        real_money = Math.round(real_money * 10) / 10;
        $(".detail-footer .money-all .value").html("" + real_money);//设置购买总价格
        $("#addressBtn").parent().addClass("money-can-pay");
        $("#addressBtn").html("去支付");
    }

}

//数组对象的增加修改
function arrayAdd(json) {
    json = JSON.stringify(json);
    if (goodsSelect[json] === undefined)
        goodsSelect[json] = 0;
    goodsSelect[json]++;
    updateCar();//更新购物车
}

//对数组进行删除
function arrayRemove(json) {
    json = JSON.stringify(json);
    goodsSelect[json]--;
    updateCar();//更新购物车
}

//得到购物数组中的数量
function getArrayCount(json) {
    json = JSON.stringify(json);
    if (goodsSelect[json] === undefined)
        goodsSelect[json] = 0;
    return goodsSelect[json];
}

//购车减少
function carMinus(obj) {
    var numberObj = $(obj).next(".number");
    var number = numberObj.html();
    if (parseInt(number) <= 1) {
        numberObj.removeClass("show-inline");
        $(obj).removeClass("show-inline");
    }
    var goodsId = numberObj.attr("goods-id");
    var money = numberObj.attr("money");
    var comment = numberObj.attr("comment");
    if (comment === undefined)
        comment = "";
    arrayRemove({"goodsId": goodsId, "money": money, "comment": comment});

}

//购物车增加
function carPlus(obj) {
    var numberObj = $(obj).prev(".number");
    var number = parseInt(numberObj.html());
    if (parseInt($(numberObj).attr("stock")) <= number) {
        alert("库存不够哦！");
        return false;
    } else if (number >= 99) {
        alert("一份最多选择99份");
        return false;
    }
    var goodsId = numberObj.attr("goods-id");
    var money = numberObj.attr("money");
    var comment = numberObj.attr("comment");
    if (comment === undefined)
        comment = "";

    arrayAdd({"goodsId": goodsId, "money": money, "comment": comment});
}

//请求支付
function callpay(goods_name,money){
    $.post(
        Home + "Ajax/getWxPay", {
            'goods_name':goods_name,
            'money':money
        }, function (result) {
            if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                } else if (document.attachEvent) {
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            } else {
                jsApiCall(JSON.parse(result['jsApiParameters']));
            }
        }
    );
}

//调用微信JS api支付
function jsApiCall(jsApiParameters) {
    WeixinJSBridge.invoke(
        'getBrandWCPayRequest', {
            "appId": jsApiParameters['appId'],
            "nonceStr": jsApiParameters['nonceStr'],
            "package": jsApiParameters['package'],
            "paySign": jsApiParameters['paySign'],
            "signType": jsApiParameters['signType'],
            "timeStamp": jsApiParameters['timeStamp']
        },
        function (res) {
            if(res.err_msg == "get_brand_wcpay_request:ok"){
                saveOrder();
            }else if(res.err_msg == "get_brand_wcpay_request:cancel"){
                alert("取消支付!");
            }else{
                alert("支付失败!");
            }
        }
    );
}