//用户删除
$(".user-list tr,td .delete-icon").click(function () {
    // if (confirm("你确定要执行吗？")) {
    //     var userId = $(this).attr("user-id");
    //     if (userDelete(userId)) {
    //         var row = $(this).parent().parent();
    //         $(row).css("display", "none");
    //     } else
    //         alert("删除失败！");
    //
    // }
});
//用户修改
$(".user-list tr td .edit-icon").click(function () {
    var userId = $(this).attr("user-id");
    console.log(userId);
    redirect("admin/edit/user_id/"+userId);
});

//根据user_id删除
function userDelete(user_id) {
    var status = true;
    $.post(
        Home + "Ajax/userDelete", {
            'user_id': user_id
        }, function (result) {
            if (result == 0)
                status = false;
        }
    );
    return status;
}