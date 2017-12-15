/**
 * Created by 雷楚桥 on 2017/11/02.
 */
$(function () {

    //请求新订单
    setInterval(getNewGroup, 5000);

    var manage = $(".manage-detail");

    //设置第一次进入的界面
    setFirstPage();

    //类别选择
    $(".manage-detail .goods-type .type-name").click(function () {

        //按钮按下
        var selectedObj = $(this).siblings(".selected");
        selectedObj.removeClass("selected");
        $(this).addClass("selected");

        //类型选择
        var classifyId = $(this).attr("classify-id");
        $("#classifyEditBtn").attr("classify-id", classifyId);
        $("#classifyName").html($(this).html());

        //更新商品列表
        updateGoodsList();
    });

    //增加类别
    $(".manage-detail #classifyPlusBtn").click(function () {
        $("#classifyEdit").modal("show");
        var str = '<button type="button" class="btn btn-default" data-dismiss="modal">取消编辑</button>\n' +
            '<button type="submit" class="btn btn-warning">保存提交</button>';
        $("#classifyEditFooter").html(str);
    });

    //编辑类别
    $(".manage-detail #classifyEditBtn").click(function () {
        $("#classifyEdit").modal("show");
        $("#classifyEditLabel").html("编辑类别");
        var str = '<button type="button" class="btn btn-danger" id="deleteClassify" classify-id="">删除类别</button>\n' +
            '<button type="submit" class="btn btn-warning">保存提交</button>';
        $("#classifyEditFooter").html(str);
        var classifyId = $(this).attr("classify-id");
        $("#classifyEditBody input[name=classify_id]").val(classifyId);
        $("#classifyEditBody input[name=classify_name]").val($("#classifyName").html());
        $("#deleteClassify").attr("classify-id", classifyId);
    });

    //删除类别
    manage.on("click", "#deleteClassify", function () {
        if (confirm("该类别删除，对应的商品也会删除，您确定要继续吗？")) {
            var classifyId = $(this).attr("classify-id");
            $.post(
                Home + "Ajax/deleteClassify", {
                    'classify_id': classifyId
                }, function (result) {
                    alert("删除成功！");
                    redirect("Manage/detail/shop_id/" + shop_id);
                }
            );
        }
    });

    //增加商品
    manage.on("click", "#goodsPlus", function () {
        var classifyId = $(this).attr("classify-id");
        $("#goodsEdit").modal("show");
        $("#goodsEditBody input[name=classify_id]").val(classifyId);
    });

    //编辑商品
    manage.on("click", ".operate .edit-icon", function () {
        var goodsId = $(this).parent().attr("goods-id");
        $.post(
            Home + "Ajax/getGoodsById", {
                goods_id: goodsId,
                need_label: true
            }, function (result) {
                $("#goodsEditLabel").html("修改商品");
                $("#goodsEditBody input[name=name]").val(result['data']['name']);
                $("#goodsEditBody input[name=describe]").val(result['data']['describe']);
                $("#goodsEditBody input[name=money]").val(result['data']['money']);
                $("#goodsEditBody input[name=stock]").val(result['data']['stock']);
                $("#goodsEditBody input[name=goods_id]").val(result['data']['goods_id']);
                $("#goodsEditBody input[name=classify_id]").val(result['data']['classify_id']);
                var str = '', label = result['label'];
                for (var lb in label) {
                    str += '<span class="btn btn-default show-label">' + label[lb]['label'] + '</span>';
                }
                if (str === '')
                    str += '<span class="btn btn-default show-label">新增</span>';
                $("#goodsEditBody .label-list").html(str);
                $("#goodsEditBody .label-list").attr("goods-id", goodsId);
            }
        );
        var classifyId = $(this).attr("classify-id");
        $("#goodsEdit").modal("show");
        $("#goodsEditBody input[name=classify_id]").val(classifyId);
    });

    //删除商品
    manage.on("click", ".operate .delete-icon", function () {
        if (confirm("你确定要删除吗？")) {
            var goodsId = $(this).parent().attr("goods-id");
            var row = $(this).parent().parent();
            $.post(
                Home + "Ajax/deleteGoods", {
                    goods_id: goodsId
                }, function (result) {
                    if (result['status']) {
                        row.css("display", "none");
                        alert("删除成功！");
                    } else
                        alert("删除失败！");
                }
            );
        }
    });

    //编辑标签
    $("#goodsEditBody").on("click", ".show-label", function () {
        if (confirm("是否进入编辑标签界面")) {
            $("#goodsEdit").modal("hide");
            var goodsId = $(this).parent().attr("goods-id");
            $.post(
                Home + "Ajax/getGoodsById", {
                    goods_id: goodsId,
                    need_label: true
                }, function (result) {
                    var goods = result['data'], label = result['label'];
                    $("#goodsLabelLabel").html(goods['name']);

                    var labelBtn = '';
                    for (var lb in label) {
                        labelBtn += '<span class="btn btn-default show-label" label-id="' + label[lb]['Id'] + '">' + label[lb]['label'] + '</span>';
                    }
                    labelBtn += '<span class="btn btn-warning show-label label-add">新增</span>';
                    $("#goodsLabelBody .label-list").html(labelBtn);
                    $("#goodsLabel .modal-footer .sure-btn").attr("goods-id", goods['goods_id']);
                    $("#goodsLabel").modal("show");
                }
            );
        }
    });

    //标签按钮点击事件
    $("#goodsLabel .label-list").on("click", ".show-label", function () {
        $(this).parent().children(".btn-selected").removeClass("btn-selected");
        var deleteBtn = $("#goodsLabel .modal-footer .delete-btn");
        var sureBtn = $("#goodsLabel .modal-footer .sure-btn");

        if ($(this).hasClass("label-add")) {//如果是增加类别
            $("#goodsLabelBody input[name=label]").val("");
            $("#goodsLabelBody input[name=money]").val("");
            deleteBtn.addClass("hide");
            deleteBtn.attr("label-id", "0");
            sureBtn.attr("label-id", "0");
            sureBtn.html("新增标签");
        } else {
            $(this).addClass("btn-selected");
            var labelId = $(this).attr("label-id");
            $.post(
                Home + "Ajax/getLabelById", {
                    label_id: labelId
                }, function (result) {
                    $("#goodsLabelBody input[name=label]").val(result['label']['label']);
                    $("#goodsLabelBody input[name=money]").val(result['label']['money']);
                    deleteBtn.removeClass("hide");
                    deleteBtn.attr("label-id", labelId);
                    sureBtn.attr("label-id", labelId);
                    sureBtn.html("修改标签");
                }
            );
        }

    });

    //标签增加、修改事件
    $("#goodsLabel .modal-footer .sure-btn").click(function () {
        var inputLabel = $("#goodsLabelBody input[name=label]").val();
        var inputMoney = $("#goodsLabelBody input[name=money]").val();
        var labelId = $(this).attr("label-id");
        var goodsId = $(this).attr("goods-id");
        if (inputLabel === null || inputMoney === null) {
            alert("标签名和标签价格都不能为空哦！");
            return false;
        } else {
            $.post(
                Home + "Ajax/updateLabel", {
                    goods_id: goodsId,
                    label_id: labelId,
                    label: inputLabel,
                    money: inputMoney
                }, function (result) {
                    if(result['status'] === 1){
                        alert("操作成功！");
                        $("#goodsLabel").modal("hide");
                    } else
                        alert("操作失败！")
                }
            );
        }
    });

    //标签删除时间
    $("#goodsLabel .modal-footer .delete-btn").click(function(){
        if(confirm("你确认要删除吗？")){
            var labelId = $(this).attr("label-id");
            $.post(
                Home + "Ajax/deleteLabel",{
                    label_id:labelId
                },function(result){
                    if(result['status'] === 1){
                        alert("操作成功！");
                        $("#goodsLabel").modal("hide");
                    } else
                        alert("操作失败！")
                }
            );
        }
    });

});

//设置第一次进入的界面
function setFirstPage() {
    var firstTypeObj = $(".manage-detail .goods-type").children(".type-name").get(0);
    $(firstTypeObj).addClass("selected");
    var classifyId = $(firstTypeObj).attr("classify-id");
    $("#classifyEditBtn").attr("classify-id", classifyId);
    $("#classifyName").html($(firstTypeObj).html());
    updateGoodsList();
}

//更新货物列表
function updateGoodsList() {
    var selectedObj = $(".manage-detail .goods-type").children(".selected");
    var classifyId = $(selectedObj).attr("classify-id");

    //得到这个商品分类的所有商品
    $.post(
        Home + "Ajax/getGoods", {
            classify_id: classifyId
        }, function (result) {
            var str = '<div class="row text-center" id="goodsPlus" classify-id="' + classifyId + '">增加商品</div>',
                data = result['data'];
            for (var d in data) {
                str += '<div class="row"><img class="img-rounded" src="' + data[d]['image'] + '"/><div class="goods-detail"><span class="goods-name">' + data[d]['name'] + '</span>' +
                    '<span class="goods-sell text-ellipsis">月售' + data[d]['sell'] + '&nbsp;&nbsp;库存' + data[d]['stock'] + '</span><span class="goods-money"><span class="glyphicon glyphicon-yen"></span>' + data[d]['money'] + '</span>' +
                    ' </div><span class="operate" goods-id="' + data[d]['goods_id'] + '"><span class="glyphicon glyphicon-edit edit-icon"></span><span class="glyphicon glyphicon-trash delete-icon"></span></span></div>';
            }
            if (data == null)
                str += '<div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong class="text-center">没有商品哦！</strong> </div>';
            $("#goodsList").html(str);
        }
    );

}