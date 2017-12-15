//公共变量
var shopSelect = [0, 0, 0];//商店类型选择[(分类),(排序),(优惠)]
var Home = "/index.php/Home/";


//dom加载完成后执行的js
$(function () {

    //图标隐藏菜单
    $(".entrance").hover(function () {
        $(this).children(".user-menu").show();
    }, function () {
        $(this).children(".user-menu").hide();
    });

    $('.action .detailed').each(function () {
        $(this).click(function () {
            detailed_content();
            return false;
        });
    });

    $('.action .thinkbox-image').each(function () {
        $(this).click(function () {
            thinkbox_image();
            return false;
        });
    });

    (function () {
        var $nav = $("#nav"), $current = $nav.children("[data-key=" + $nav.data("key") + "]");
        if ($nav.length) {
            $current.addClass("current");
        } else {
            $("#nav").children().first().addClass("current");
        }
    })();


    $(".ajax-post").click(function () {
        var target;
        var that = this;
        if ($(this).hasClass('confirm')) {
            if (!confirm('确认要执行该操作吗?')) {
                return false;
            }
        }
        if ((target = $(this).attr('href')) || (target = $(this).attr('url'))) {

        }
        return false;
    });

    $(".ajax-get").click(function () {
        var target;
        var that = this;
        if ($(this).hasClass('confirm')) {
            if (!confirm('确认要执行该操作吗?')) {
                return false;
            }
        }
        if ((target = $(this).attr('href')) || (target = $(this).attr('url'))) {
            $.get(target).success(function (data) {
                console.log("ok");
                return 0;
            });
            return false;
        }
    });
});

//隐藏加载
function hideOnLoading() {
    $(".body-onload").remove();
}

//js跳转
function redirect(url) {
    window.location.href = Home + url + ".html";
}

//设置cookie
function setCookie(name, value) {
    document.cookie = name + "=" + value;
}

//得到cookie
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}

//Map
// function Map() {
//     /** 存放键的数组(遍历用到) */
//     this.keys = new Array();
//     /** 存放数据 */
//     this.data = new Object();
//
//     /**
//      * 放入一个键值对
//      * @param {String} key
//      * @param {Object} value
//      */
//     this.put = function(key, value) {
//         if(this.data[key] == null){
//             this.keys.push(key);
//         }
//         this.data[key] = value;
//     };
//
//     /**
//      * 获取某键对应的值
//      * @param {String} key
//      * @return {Object} value
//      */
//     this.get = function(key) {
//         return this.data[key];
//     };
//
//     /**
//      * 删除一个键值对
//      * @param {String} key
//      */
//     this.remove = function(key) {
//         this.keys.remove(key);
//         this.data[key] = null;
//     };
//
//     /**
//      * 遍历Map,执行处理函数
//      *
//      * @param {Function} 回调函数 function(key,value,index){..}
//      */
//     this.each = function(fn){
//         if(typeof fn != 'function'){
//             return;
//         }
//         var len = this.keys.length;
//         for(var i=0;i<len;i++){
//             var k = this.keys[i];
//             fn(k,this.data[k],i);
//         }
//     };
//
//     /**
//      * 获取键值数组(类似Java的entrySet())
//      * @return 键值对象{key,value}的数组
//      */
//     this.entrys = function() {
//         var len = this.keys.length;
//         var entrys = new Array(len);
//         for (var i = 0; i < len; i++) {
//             entrys[i] = {
//                 key : this.keys[i],
//                 value : this.data[i]
//             };
//         }
//         return entrys;
//     };
//
//     /**
//      * 判断Map是否为空
//      */
//     this.isEmpty = function() {
//         return this.keys.length == 0;
//     };
//
//     /**
//      * 获取键值对数量
//      */
//     this.size = function(){
//         return this.keys.length;
//     };
//
//     /**
//      * 重写toString
//      */
//     this.toString = function(){
//         var s = "{";
//         for(var i=0;i<this.keys.length;i++,s+=','){
//             var k = this.keys[i];
//             s += k+"="+this.data[k];
//         }
//         s+="}";
//         return s;
//     };
// }

