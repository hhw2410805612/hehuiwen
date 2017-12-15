<?php
namespace Common\WxPay;

class Wechat
{
    private $appID = "wx485fd17bf8f90f61";
    private $mchID = '1490626882';
    private $appWD = '7BF523298E41B5170DA1DBE2E7A0A0CE';
    private $appSecret = "4a6135ef0ca88c17b34806b09dfa6e8f";
    private $redirectURL = "http://shop.yhdshop.top";

    //获取全局accessToken
    private $tokenApiURL = "https://api.weixin.qq.com/cgi-bin/token";
    //获取网页授权accessToken
    private $oauthApiURL = "https://api.weixin.qq.com/sns";
    //获取code
    private $requestCodeURL = "https://open.weixin.qq.com/connect/oauth2/authorize";
    //获取jsApiTicket
    private $jsApiURL = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
    //支付参数
    private $values = array();


    //得到appId
    public function getAppId()
    {
        return $this->appID;
    }

    //获取code
    public function getCode($redirect_uri)
    {
        $url = $this->requestCodeURL . "?appid=" . $this->appID . "&redirect_uri=" . $this->redirectURL . $redirect_uri . "&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
        redirect($url);
    }

    /**
     * 得到access_token
     * @param string $code code
     * @return string $access_token access_token
     * @author 有猿人 on 2017/10/24:13:26
     */
    public function getAccessToken()
    {
        $token = D("Wx")->getToken("access_token");
        if (time() - $token['expire_time'] > 0) {
            $param['appid'] = $this->appID;
            $param['secret'] = $this->appSecret;
            $param['grant_type'] = 'client_credential';
            $resJson = $this->http($this->tokenApiURL, $param);
            $res = json_decode($resJson, true);
            $access_token = $res['access_token'];
            if (isset($access_token)) {
                $data['token'] = $access_token;
                $data['expire_time'] = time() + 7000;
                $data['name'] = 'access_token';
                D("Wx")->setToken($data);
            }
        } else {
            $access_token = $token['token'];
        }
        return $access_token;
    }


    /**
     * 得到openid
     * @param string $code code
     * @return string $openid openid
     * @author 有猿人 on 2017/10/24:13:26
     */
    public function getOpenId($code)
    {
        $param['appid'] = $this->appID;
        $param['secret'] = $this->appSecret;
        $param['code'] = $code;
        $param['grant_type'] = 'authorization_code';
        $url = "{$this->oauthApiURL}/oauth2/access_token";
        $resJson = $this->http($url, $param);
        $res = json_decode($resJson, true);
        if (isset($res['access_token']))
            session("access_token", $res);
        return $res['openid'];
    }


    /**
     * 获取授权用户信息
     * @param  string $openid 用户的OpenID
     * @param  string $lang 指定的语言
     * @return array          用户信息数据，具体参见微信文档
     * @author 有猿人 on 2017/10/25:10:05
     */
    public function getUserInfo($openid, $lang = 'zh_CN')
    {
        $access_token = session("access_token");
        $param = array(
            'access_token' => $access_token['access_token'],
            'openid' => $openid,
            'lang' => $lang,
        );

        $info = self::http("{$this->oauthApiURL}/userinfo", $param);
        return json_decode($info, true);
    }

    /**
     * 得到jsApiTicket
     * @param string $code code
     * @return string $openid openid
     * @author 有猿人 on 2017/10/24:13:26
     */
    public function getJsApiTicket()
    {
        $ticket = D("Wx")->getToken("jsapi_ticket");
        if (time() - $ticket['expire_time'] > 0) {
            $param['access_token'] = $this->getAccessToken();
            $param['type'] = "jsapi";
            $resJson = $this->http($this->jsApiURL, $param);
            $res = json_decode($resJson, true);
            $jsapi_ticket = $res['ticket'];
            if (isset($jsapi_ticket)) {
                $data['token'] = $jsapi_ticket;
                $data['expire_time'] = time() + 7000;
                $data['name'] = 'jsapi_ticket';
                D("Wx")->setToken($data);
            }
        } else {
            $jsapi_ticket = $ticket['token'];
        }
        return $jsapi_ticket;
    }


    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url 请求URL
     * @param  array $param GET参数数组
     * @param  array $data POST的数据，GET请求时该参数无效
     * @param  string $method 请求方法GET/POST
     * @return array          响应数据
     */
    public function http($url, $param, $data = '', $method = 'GET')
    {
        $opts = array(
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        /* 根据请求类型设置特定参数 */
        $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);

        if (strtoupper($method) == 'POST') {
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $data;

            if (is_string($data)) { //发送JSON数据
                $opts[CURLOPT_HTTPHEADER] = array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($data),
                );
            }
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        //发生错误，抛出异常
        if ($error) throw new \Exception('请求发生错误：' . $error);

        return $data;
    }

    /**
     * 微信支付总方法
     */
    public function wxPayAction($need_info)
    {
        $input = $this->_buildPayConfig($need_info);//建立配置文件
        return WxPayApi::unifiedOrder($input);
    }

    /**
     * @deprecate 得到微信支付配置文件
     * @author 雷楚桥 on 2017/12/6:11:15
     */
    public function getPayConfig()
    {
        return $this->values;
    }


    /**
     * @deprecate 生成微信支付配置文件
     * @param $info array 传入参数
     * @author 雷楚桥 on 2017/12/5:16:10
     */
    private function _buildPayConfig($need_info)
    {
        if (!is_array($need_info))
            exit('非法传参');

        $input = new WxPayUnifiedOrder();
        $input->SetBody($need_info['goods_name']);
        $input->SetAttach($need_info['goods_name']);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($need_info['money']);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($need_info['goods_name']);
        $input->SetNotify_url("http://yhd.yhdshop.top/index.php/Home/admin/index.html");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid(get_user_auth());
        return $input;
    }

}
