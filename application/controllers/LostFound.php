<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LostFound extends CI_Controller{

    function __construct(){
        parent::__construct();
        $params = array('app' => 'lostfound');
        $this->load->library('Use_smarty', $params, 'smarty');
        $this->load->model('LostFound_Model');
        $this->load->library('session');

        //本地配置
       // $config = array('appID' => 'f5a02868490fcc6e',
       //                'appSecret' => '7550c52e16b133b397441950b6ef478e',
       //                 'callback' => "http://f.yiban.cn/iapp54133");
		$config = array('appID' => '07c002c228867b95',
                       'appSecret' => 'c543a1f19289a1e212e95b584cee028f',
                        'callback' => "http://f.yiban.cn/iapp55021");
        $this->load->library('YibanSDK', $config, 'yiban');
        //var_dump($this->session->token);
        //$au  = $this->yiban->getAuthorize();
        //var_dump($token);
        if (!$this->input->get('verify_request')) {
            $this->session->url = $_SERVER['REQUEST_URI'];
        }
        //var_dump($this->session);
        if (!isset($this->session->token)) {     // 未获取授权
        /**
         * 从授权服务器回调返回时，URL中带有code（授权码）参数
         *
         */
         
            $au  = $this->yiban->getAuthorize();
            //var_dump($this->input->post());
            if ($this->input->get('verify_request')) {
            /**
             * 使用授权码（code）获取访问令牌
             * 若获取成功，返回 $info['access_token']
             * 否则查看对应的 msgCN 查看错误信息
             */
                $info = $this->yiban->getFrameUtil()->perform();
                //var_dump($info);
                if (!isset($info['visit_oauth']['access_token'])) {
                    //echo $info['msgCN'];
                    redirect($au->forwardurl());
                }
                $this->session->token = $info['visit_oauth']['access_token'];
                $this->data['user_info']['yb_userid'] = $info['visit_user']['userid'];
                $this->data['user_info']['yb_username'] = $info['visit_user']['username'];
                header("Location: " . $this->session->url);
            }
            else {   // 重定向到授权服务器（原sdk使用header()重定向）
                redirect($au->forwardurl());
                // header('Location: ' . $au->forwardurl());
            }
        }
        if(!isset($this->data['user_info']) && $this->session->token){
            $this->user = $this->yiban->getUser($this->session->token);
            $this->data['user_info'] = $this->user->me()['info'];
        }
    }

    function index(){
        $type = $this->input->get('type');
        if ($type == 'lost'){
            $this->data['items'] = $this->LostFound_Model->current_items(1);
            $this->data['title'] = '易招领：寻找物品';
        }elseif ($type == 'found'){
            $this->data['items'] = $this->LostFound_Model->current_items(2);
            $this->data['title'] = '易招领：寻找失主';
        }else{
            $this->data['items'] = $this->LostFound_Model->current_items();
            $this->data['title'] = '易招领';
        }

        $this->smarty->main_view('index', $this->data);
    }

    function publish(){
        $edited = $this->input->post();
        $this->data['title'] = '发布启事';
        if(empty($edited)){
            $this->smarty->main_view('publish', $this->data);
            return;
        }
        //找失主
        $edited['lf_type'] = 2;
        $edited['lf_ybid'] = $this->data['user_info']['yb_userid'];
        if(isset($edited['lf_anonymous'])){
            $edited['lf_name'] = '路人甲';
            unset($edited['lf_anonymous']);
        }
        $edited['lf_date'] = date('Y-m-d h:i:s');
        var_dump($edited);
        return;
        if($this->LostFound_Model->create($edited)){
            $this->session->success = TRUE;
            redirect(base_url() . 'LostFound/detail/' . $this->LostFound_Model->lastest_created_id);
        }
        else{
            $this->session->error = '提交失败，请重试！';
            redirect(base_url() . 'LostFound/detail/' . $this->LostFound_Model->lastest_created_id);
        }
    }

    function detail($id){
        $this->data['detail'] = $this->LostFound_Model->detail($id);
        $this->data['title'] = '详情';
        $this->smarty->main_view('detail', $this->data);
    }

    function subscribe(){
        $this->load->library('My_email');

        $email = $this->input->post('email');
        if($email){
            // 需要有个新表
        }
    }
}
