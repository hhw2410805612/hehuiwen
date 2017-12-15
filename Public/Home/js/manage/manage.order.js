/**
 * Created by 雷楚桥 on 2017/11/03
 */
var groupStatus = 0;
$(function () {

    //请求新订单
    setInterval(getNewGroup, 8000);

    //顶部点击事件
    $(".order-manage .manage-banner ul .loid").click(function () {
        $(".order-manage .manage-banner ul .selected").removeClass("selected");
        $(this).addClass("selected");
        groupStatus = parseInt($(this).attr("group-status"));
        updateContent();
    });

    //订单查看详细
    $("#orderList").on("click", ".user-info .detail", function () {
        var groupId = $(this).attr("group-id");
        $.post(
            Home + "Ajax/getGroupById", {
                group_id: groupId,
                is_classify: true
            }, function (result) {
                var data = result['data'];
                var str = '<div class="container commodity">' +
                    '<div class="row commodity-information"><div class="goods-text">商品</div></div><div class="row"><ul>';
                for (var gd in data['goods']) {
                    str +=
                        '<li class="dishes">' +
                        '   <div class="dishes-picture">' +
                        '   <img src="' + data['goods'][gd]['image'] + '" alt="' + data['goods'][gd]['name'] + '"></div>' +
                        '   <p class="food-name"><b>[' + data['goods'][gd]['classify_name'] + ']' + data['goods'][gd]['name'] + '</b></p>' +
                        '   <p class="food-name text-ellipsis">' + data['goods'][gd]['comment'] + '</p>' +
                        '   <p class="food-num">x' + data['goods'][gd]['count'] + '</p>' +
                        '   <p class="tmoney">￥' + data['goods'][gd]['real_money'] + '</p>' +
                        '</li>';
                }
                str +=
                    '</ul></div>' +
                    '   <div class="row">' +
                    '       <div class="col-xs-12 text-right total-num">' +
                    '           总计：<span class="glyphicon glyphicon-yen"></span><span class="total">' + data['money'] + '</span>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>' +
                    '<div class="container comment">' +
                    '   <div class="row">' +
                    '       <div class="comment-text">备注</div>' +
                    '   </div>' +
                    '   <div class="row">' +
                    '       <textarea class="form-control comment-area" disabled="disabled" rows="4">' + data['comment'] + '</textarea>' +
                    '   </div>' +
                    '</div>';
                $("#orderDetailBody").html(str);
                orderDetailFooter.attr("group-id", groupId);

                //底部按钮类型
                var btn = '';
                switch (groupStatus) {
                    case 0:
                        btn = '<button type="button" class="btn btn-default order-cancel" data-dismiss="modal">不接此单</button>' +
                            '<button type="button" class="btn btn-primary order-sure" data-dismiss="modal">接受订单</button>';
                        break;
                    case 1:
                        btn = '<button type="button" class="btn btn-default order-cancel" data-dismiss="modal">取消此单</button>' +
                            '<button type="button" class="btn btn-primary self-exp" data-dismiss="modal">自行配送</button>' +
                            '<button type="button" class="btn btn-primary apply-exp" data-dismiss="modal">申请配送</button>';
                        break;
                    case 2:
                        btn = '<button type="button" class="btn btn-default order-cancel" data-dismiss="modal">取消此单</button>' +
                            '<button type="button" class="btn btn-primary sure-get" data-dismiss="modal">确认收货</button>';
                        break;
                }
                orderDetailFooter.html(btn);//设置按钮
                $("#orderDetail").modal("show");
            }
        )
    });

    //订单查看详细事件
    var orderDetailFooter = $("#orderDetailFooter");

    //订单确认
    orderDetailFooter.on("click", ".order-sure", function () {
        var group_id = orderDetailFooter.attr("group-id");
        $.post(
            Home + "Ajax/updateGroup", {
                group_id: group_id,
                now: groupStatus,
                status: 1
            }, function (result) {
                if (result['status'] == -1)
                    alert(result['msg']);
                else
                    alert("操作成功！");
                updateContent();
            }
        );
    });

    //订单取消
    orderDetailFooter.on("click", ".order-cancel", function () {
        if (confirm("您确认不接单吗？")) {
            var group_id = orderDetailFooter.attr("group-id");
            $.post(
                Home + "Ajax/updateGroup", {
                    group_id: group_id,
                    now: groupStatus,
                    status: -1
                }, function (result) {
                    if (result['status'] === -1)
                        alert(result['msg']);
                    else
                        alert("操作成功！");
                    updateContent();
                }
            );
        }
    });

    //订单自行配送
    orderDetailFooter.on("click", ".self-exp", function () {
        var group_id = orderDetailFooter.attr("group-id");
        $.post(
            Home + "Ajax/updateGroup", {
                group_id: group_id,
                now: groupStatus,
                status: groupStatus + 1
            }, function (result) {
                if (result['status'] === -1)
                    alert(result['msg']);
                else
                    alert("操作成功！");
                updateContent();
            }
        );
    });

    //订单申请配送
    orderDetailFooter.on("click", ".apply-exp", function () {
        var group_id = orderDetailFooter.attr("group-id");
        $.post(
            Home + "Ajax/applyExpress", {
                group_id: group_id,
                now: groupStatus
            }, function (result) {
                if (result['status'] === -1)
                    alert(result['msg']);
                else
                    alert("操作成功！");
                updateContent();
            }
        );
    });

    //订单确认收货
    orderDetailFooter.on("click", ".sure-get", function () {
        if (confirm("确认用户已经收货？")) {
            var group_id = orderDetailFooter.attr("group-id");
            $.post(
                Home + "Ajax/updateGroup", {
                    group_id: group_id,
                    now: 2,
                    status: 3
                }, function (result) {
                    if (result['status'] === -1)
                        alert(result['msg']);
                    else
                        alert("操作成功！");
                    updateContent();
                }
            );
        }
    });
});


//更新数据
function updateContent() {
    $.post(
        Home + "Ajax/getGroup", {
            shop_id: shop_id,
            status: groupStatus
        }, function (result) {
            var data = result['data'];
            var str = '';
            var orderStatusArr = ['用户已下单', '商家已接单', '骑手配送中', '订单已完成', '订单已评价'];
            orderStatusArr[-1] = '用户已取消';
            var userSex = ['', '先生', '女士'];
            for (var d in data) {
                str +=
                    '<div class="list-box">' +
                    '   <div class="container finsh-banner">' +
                    '       <div class="finsh-text">#' + data[d]['group_no'] + '</div>' +
                    '       <div class="finsh-quick">&nbsp;&nbsp;' + data[d]['time'] + '</div>' +
                    '       <div class="confirm">' + orderStatusArr[data[d]['status']] + '</div>' +
                    '   </div>' +
                    '   <div class="container user-info">' +
                    '       <div class="row head-box">' + data[d]['address']['name'] + '&nbsp;&nbsp;' + userSex[data[d]['address']['sex']] + '</div>' +
                    '       <div class="row tell-box">' +
                    '           <div class="tell-number">' + data[d]['address']['tell'] + '</div>' +
                    '           <a href="tel://' + data[d]['address']['tell'] + '" class="tell">' +
                    '               <div class="tell-pic">' +
                    '                   <span class="glyphicon glyphicon-earphone pic-call"></span>' +
                    '               </div>' +
                    '           </a>' +
                    '       </div>' +
                    '       <div class="row order-address">' +
                    '           <div class="finsh-time">' + data[d]['address']['site'] + '&nbsp;&nbsp;' + data[d]['address']['xxsite'] + '</div>' +
                    '       </div>' +
                    '       <div class="row text-right">' +
                    '           <button class="btn btn-primary detail" group-id="' + data[d]['goods_group_id'] + '">详细信息</button>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>';
            }
            if (data === null)
                str = '<div class="container">' +
                    '   <div class="alert alert-warning alert-dismissible text-center" style="margin-top: 10px" role="alert">' +
                    '       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '       <strong class="text-center">目前没有订单哦！</strong>' +
                    '   </div>' +
                    '</div>';
            $("#orderList").html(str);
        }
    );
}