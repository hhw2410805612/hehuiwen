var Home = '/index.php/Home/';
var selectArr = [0, 0, 0];//搜索选择

$(function () {
    var select = $(".goods-search select");
    select.change(function () {
        var selectId = parseInt($(this).attr("select-id"));
        selectArr[selectId] = $(this).val();
        $.post(
            Home + "Ajax/updateCountSelect", {
                select_arr: selectArr
            }, function (result) {

                var classify = result['classify'], goods = result['goods'], orderList = result['orderList'];

                //类别
                var str = '<option value="0">全部</option>';
                for (var ci in classify) {
                    str += '<option value="' + classify[ci]['classify_id'] + '">' + classify[ci]['classify_name'] + '</option>'
                }
                $(".goods-search select[name='classify_id']").html(str);

                //商品
                str = '<option value="0">全部</option>';
                for (var gd in goods) {
                    str += '<option value="' + goods[gd]['goods_id'] + '">' + goods[gd]['name'] + '</option>'
                }
                $(".goods-search select[name='goods_id']").html(str);

                //更新选择
                updateSelected();

                //更新内容
                str = '';
                for (var ol in orderList) {
                    str += '<tr><td>' + orderList[ol]['name'] + '</td><td>' + orderList[ol]['comment'] + '</td><td>' + orderList[ol]['real_money'] + '</td><td>' + orderList[ol]['count'] + '</td></tr>';
                }
                $("#countList").html(str);
            }
        );


    });
});


//更新选择内容
function updateSelected() {
    var nameArr = ['shop_id', 'classify_id', 'goods_id'];

    for (var sa in selectArr) {
        $(".goods-search select[name='" + nameArr[sa] + "'] option[value='" + selectArr[sa] + "']").attr("selected", true);
    }
}