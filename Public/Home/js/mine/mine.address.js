/**
 * Created by 雷楚桥 on 2017/10/21.
 */
var Home = "/index.php/Home/";

//文档一记载就执行
$(function () {

    $(".address-manage .head .manager").click(function () {
        var manageStr = $(this).html();
        if (manageStr == "管理") {
            $(this).html("完成");
            $(".address-manage .body .edit").css("display", "block");
        } else {
            $(this).html("管理");
            $(".address-manage .body .edit").css("display", "none");
        }
    });

    //地址删除
    $(".address-manage .body .delete-icon").click(function () {
        if (confirm("你确定要执行吗？")) {
            var addressId = $(this).attr("address-id");
            if (addressDelete(addressId)) {
                var row = $(this).parent().parent();
                $(row).css("display", "none");
            } else
                alert("删除失败！");

        }
    });

    //地址修改
    $(".address-manage .body .edit-icon").click(function () {
        var addressId = $(this).attr("address-id");
        window.location.href = Home + "Mine/edit/address_id/" + addressId;
    });

    //增加地址
    $(".address-manage .footer").click(function () {
        redirect("Mine/edit");
    });

    //性别修改
    $(".address-edit .sex").click(function () {
        $(".address-edit .sex .glyphicon-ok-circle").css("color", "#888888");
        $(this).children(".glyphicon-ok-circle").css("color", "#d59405");
        var sexType = $(this).attr("sex-type");
        $(this).parent().children("input").val(sexType);
    });

    //返回至主界面
    // if (window.history && window.history.pushState) {
    //     $(window).on('popstate', function () {
    //         window.location.href = Home + "Shop/index_old.html";
    //         // window.history.pushState('forward', null, 'index_old.html');
    //     });
    //     window.history.pushState('forward', null, 'address.html');
    // }
});


//根据address_id删除地址
function addressDelete(address_id) {
    var status = true;
    $.post(
        Home + "Ajax/addressDelete", {
            'address_id': address_id
        }, function (result) {
            if (result == 0)
                status = false;
        }
    );
    return status;
}
