//查找是否有未确认的订单['商家']
function getNewGroup(){
    $.post(
        Home+"Ajax/getNewGroup",{
            shop_id:shop_id
        },function(result){
            if(result['status'] === 1){
                playBgMusic();
                updateContent();
            }else
                console.log("还没有订单，好无聊啊！");
        }
    );
}

//查找是否有新的需要配送的['骑手']
function getNewRunning(){
    $.post(
        Home+"Ajax/getNewRunning",{
            status:2,
            courier_id:-1
        },function(result){
            if(result['status'] === 1){
                playBgMusic();
                updateContent();
            }else
                console.log("还没有事做，好无聊啊！");
        }
    );
}

//查找所有的店铺是否存在订单['自营店']
function getOurGroup(){
    $.post(
        Home+"Ajax/getOurGroup",{
        },function(result){
            if(result['status'] === 1){
                playBgMusic();
                updateCount(result['data']);
            }else{
                console.log("还没有订单，好无聊啊！");
            }
        }
    );
}


function playBgMusic(){
    var audio = document.getElementById("bgMusic");
    audio.play();
    document.addEventListener("WeixinJSBridgeReady", function () {
        audio.play();
    }, false);
}


