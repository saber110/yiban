<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 易班SDK接入
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   yibanSDK
 * @author WZR <monkeywzr@gmail.com>
 * @date 2016/6/26
 */

require_once( APPPATH.'third_party/yibansdk/yb-globals.inc.php' );

class YibanSDK{

    public $YBOpenApi;
    public $YBException;
    public $authData;

    function __construct($config=NULL){
        if(is_array($config) && !empty($config)){
            $this->YBOpenApi = YBOpenApi::getInstance()->init($config['appID'], $config['appSecret'], $config['callback']);
        }
    }

    public function init($config){
        $this->YBOpenApi = YBOpenApi::getInstance()->init($config['appID'], $config['appSecret'], $config['callback']);
    }

    public function getAuthorize(){
        if($this->YBOpenApi)
            return $this->YBOpenApi->getAuthorize();
    }

    public function getFrameUtil(){
        if($this->YBOpenApi)
            return $this->YBOpenApi->getFrameUtil();
    }	
	
    public function getAuth()
    {
	if(!isset ($_GET['verify_request'])) {
            $_SESSION['url'] = $_SERVER['REQUEST_URI'];
        }
        if (!isset($_SESSION['token'])) {    // 未获取授权
        /**
         * 从授权服务器回调返回时，URL中带有code（授权码）参数
         *
         */
            $au  = $this->getAuthorize();
            
            if (isset($_GET['verify_request'])){       //无感叹号
                
            /**
             * 使用授权码（code）获取访问令牌
             * 若获取成功，返回 $info['access_token']
             * 否则查看对应的 msgCN 查看错误信息
             */
                $info = $this->getFrameUtil()->perform();               
                        
                if (!isset($info['visit_oauth']['access_token'])) {
                    redirect($au->forwardurl());
                    
                }
                $_SESSION['token'] = $info['visit_oauth']['access_token'];
                $_SESSION['user_info']['yb_userid'] = $info['visit_user']['userid'];
                $_SESSION['user_info']['yb_username'] = $info['visit_user']['username'];
                
                header("Location: " . $_SESSION['url']);
                
            }
            else {   // 重定向到授权服务器（原sdk使用header()重定向）
            
                redirect($au->forwardurl());
                // header('Location: ' . $au->forwardurl());
            }
        }
        
        if(!isset($_SESSION['user_info']) && $_SESSION['token']){
            $this->user = $this->getUser($_SESSION['token']);
            $_SESSION['user_info'] = $this->user->me()['info'];
        }
    }

    public function getUser($token){
        if($token){
            $this->YBOpenApi = YBOpenApi::getInstance()->bind($token);
            return $this->YBOpenApi->getUser();
        }
    }

    public function getFriend($token){
        if($token){
            $this->YBOpenApi = YBOpenApi::getInstance()->bind($token);
            return $this->YBOpenApi->getFriend();
        }
    }

    public function trade($token, $pay, $sign_back, $userid='5540481'){
        $ch = curl_init();
        $url = "https://openapi.yiban.cn/pay/trade_wx?access_token={$token}&pay={$pay}&sign_back={$sign_back}&yb_userid={$userid}";
        // echo $url;
        curl_setopt($ch, CURLOPT_URL, $url);
        $options = array(CURLOPT_RETURNTRANSFER => TRUE,
                         CURLOPT_HEADER => FALSE,
                         CURLOPT_FOLLOWLOCATION => TRUE,
                         CURLOPT_SSL_VERIFYPEER => FALSE
                    );
        curl_setopt_array($ch, $options);
        $order_form = curl_exec($ch);
        // curl_close($ch);
        // var_dump($match);
        curl_close($ch);
        $order_form = json_decode($order_form, TRUE);
        // var_dump($order_form);
        redirect($order_form['info']['sign_href']);
    }

    public function varify_trade($trade_id, $trade_end, $end_time, $yb_sign, $appSecret){
        // $trade_id = $_GET['trade_id'];
        // $trade_end = $_GET['trade_end'];
        // $end_time = $_GET['end_time'];
        // $yb_sign = $_GET['yb_sign'];
        // $appSecret = 'XXX';//设置调用接口的应用AppSecret，在管理中心应用信息中可见
        $checkSign = hash_hmac('sha256', $trade_id.$end_time, $appSecret);
        //以trade_id、end_time值顺序拼接为内容，应用AppSecret为密钥，哈希SHA256加密
        $re = (strval($yb_sign) === strval($checkSign)) ? TRUE : FALSE;
    }
}
