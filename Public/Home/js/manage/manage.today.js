/**
 * Created by Administrator on 2017/11/21
 */

$(function () {

    //详情信息点击
    $(".manage-today .group-detail-btn").click(function () {
        var groupId = $(this).attr("group-id");
        $.post(
            Home + "Ajax/getGroupById", {
                group_id: groupId

            }, function (result) {
                var data = result['data'];

                var str = '<div class="row group-head"><div class="col-xs-6 text-left"><b>#' + data['group_no'] + '</b>&nbsp;&nbsp;' + data['time'] + '</div><div class="col-xs-6 text-right">';
                switch (data['status']) {
                    case "-1":
                        str += '订单已删除';
                        break;
                    case "0":
                        str += '买家已下单';
                        break;
                    case "1":
                        str += '卖家已接单';
                        break;
                    case "2":
                        str += '骑手配送中';
                        break;
                    case "3":
                        str += '订单已完成';
                        break;
                    case "4":
                        str += '订单已评价';
                        break;
                    default:
                        str += '订单不存在';
                        break;
                }
                str += '</div></div><div class="row group-mai"><div class="col-xs-12 text-left"><b>' + data['address']['name'] + '&nbsp;&nbsp;&nbsp;';
                str += data['address']['sex'] === '1' ? "先生" : "女士";
                str += '</b></div><div class="col-xs-12 text-left">'+ data['address']['tell'] + '</div>\n' +
                    '<div class="col-xs-12 text-left">' + data['address']['site'] + '&nbsp;&nbsp;&nbsp;' + data['address']['xxsite'] + '</div></div>\n';
                if (data['courier_id'] > 0)
                    str += '<div class="row group-courier"><div class="col-xs-12 text-left"><b>骑手:&nbsp;&nbsp;&nbsp;'+data['courier']['name']+'</b></div>\n' +
                        '<div class="col-xs-12 text-left">'+data['courier']['tell']+'</div></div>\n';
                str +='<div class="row group-goods">\n' +
                    '<div class="col-xs-12 text-left"><b>商品</b></div>\n';
                for(var i in data['goods']){
                    str += '<div class="col-xs-6 text-right goods-name text-ellipsis">'+data['goods'][i]['name']+'</div>\n' +
                        '<div class="col-xs-3 text-right goods-number">x'+data['goods'][i]['count']+'</div>\n' +
                        '<div class="col-xs-3 text-right goods-money"><span class="glyphicon glyphicon-yen pic"></span>'+data['goods'][i]['money']+'</div>\n';
                }
                str += '<div class="col-xs-12 text-right count">总计：<span class="all-money"><span class="glyphicon glyphicon-yen pic"></span>'+data['money']+'</span></div></div>';
                $("#groupDetail .today-body").html(str);
            }
        );
        $("#groupDetail").modal("show");
    });

});


