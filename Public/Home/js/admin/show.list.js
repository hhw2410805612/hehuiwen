//店铺删除
$(".show-list tr,td .delete-icon").click(function () {
    if (confirm("你确定要执行吗？")) {
        var shopId = $(this).attr("shop-id");
        if (shopDelete(shopId)) {
            var row = $(this).parent().parent();
            $(row).css("display", "none");
        } else
            alert("删除失败！");

    }
});
//店铺修改
$(".show-list tr,td .edit-icon").click(function () {
    var shopId = $(this).attr("shop-id");
    window.location.href = Home + "admin/modify/shop_id/" + shopId;
});

//根据shop_id删除地址
function shopDelete(shop_id) {
    var status = true;
    $.post(
        Home + "Ajax/shopDelete", {
            'shop_id': shop_id
        }, function (result) {
            if (result == 0)
                status = false;
        }
    );
    return status;
}