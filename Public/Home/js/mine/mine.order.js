/**
 * Created by 雷楚桥 on 2017/11/03
 */
var Home = "/index.php/Home/";
$(function () {

    //订单列表点击
    var mineOrderDetail = $(".mine-order .detail");
    mineOrderDetail.on("click", ".goods,.money", function () {
        var groupId = $(this).parent().attr("goods-id");
        redirect("Shop/order_detail/group_id/" + groupId);
    });
    mineOrderDetail.on("click", ".shop", function () {
        var shopId = $(this).parent().attr("shop-id");
        redirect("Shop/detail/shop_id/" + shopId);
    });

    //取消订单
    mineOrderDetail.on("click",".cancel-order",function(){
        if(confirm("您确认要取消吗？")){
            var groupId= $(this).attr("group-id");
            $.post(
                Home+"Ajax/cancelGroup",{
                    group_id:groupId
                },function(result){
                    if(result['status'] == 2)
                        alert("卖家已经接单，不能取消！");
                    else if(result['status'] != 1){
                        alert("取消失败！");
                    }
                    redirect("Mine/order");
                }
            );
        }
    });

    //删除订单
    mineOrderDetail.on("click",".delete-order",function(){
        if(confirm("您确认要删除吗？")){
            var groupId= $(this).attr("group-id");
            $.post(
                Home+"Ajax/deleteGroup",{
                    group_id:groupId
                },function(result){
                    if(result['status'] != 1)
                        alert("删除失败！");
                    redirect("Mine/order");
                }
            );
        }
    });

});