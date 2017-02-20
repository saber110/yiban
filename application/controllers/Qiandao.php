<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Qiandao extends CI_Controller{
    public $data;

    function __construct(){
        parent::__construct();
        // header("Location: http://www.baidu.com");
        $this->load->model('Qiandao_model');
        //当前应用文件夹
        $params = array('app' => 'qiandao/app');
        $this->load->library('Use_smarty', $params, 'smarty');

        //当前应用参数

        //本地测试配置
	//    $config = array('appID' => 'f70cc2b4d2f79789',
        //                'appSecret' => 'be7546215e8c89abb67810e15c8e0607',
        //                'callback' => "http://f.yiban.cn/iapp54009");
        // $this->load->library('YibanSDK', $config, 'yiban');
	//site
		$config = array('appID' => '4f2a95d46c9d9515',
                        'appSecret' => '60d76cf677c22c2708a6cac4a33b4996',
                        'callback' => "http://f.yiban.cn/iapp77695");
        $this->load->library('YibanSDK', $config, 'yiban');
		
	  //$this->yiban->getAuth();
  	  //$this->data['user_info'] = $this->session->user_info;
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

    function index()
    {
        
        $this->data['title'] = '中南大学易签到';
        if(isset($this->data['user_info']))
            $this->data['events'] = $this->Qiandao_model->current_events($this->data['user_info']['yb_userid']);
        // if($this->session->token){
            // $user = $this->yiban->getUser($this->session->token);
            // $data['userInfo'] = $this->user->me();
        // }
        $this->smarty->main_view('index', $this->data);
    }

    function create(){
        
        $edited = $this->input->post();
        if(empty($edited)){
            $this->data['title'] = '创建活动';
            $this->smarty->main_view('create');
            // var_dump($this->data);
            return;
        }

        $edited['user_id'] = $this->data['user_info']['yb_userid'];
        $edited['user_name'] = $this->data['user_info']['yb_username'];
        $edited['created_date'] = date('Y-m-d h:i:s');
                
        //$edited['location'] = 
        $event_id = $this->Qiandao_model->create($edited);

        
        if($event_id){
            //生成二维码
            include(APPPATH . 'third_party/phpqrcode/qrlib.php');
            $save_path = 'attch/' . md5($event_id) . '.png';
            QRcode::png(base_url() . "index.php/qiandao/check?event_id={$event_id}", $save_path, QR_ECLEVEL_H, 7);
            //更新二维码路径
            $this->Qiandao_model->update_qrcode($event_id, $save_path);
            $this->data['qrcode'] = $save_path;
            $this->data['title'] = '创建成功';
            $this->smarty->main_view('createresult', $this->data);
            return;
        }
        else{
            echo "创建失败";
        }
    }

    function insertLocation()
    {
		$this->session->userLocation = str_replace('"<pre>', '', $this->input->get('addr'));
        //$this->session->userLocation = str_replace('",','', str_replace('addr": "','', $this->input->get('addr')));
    }

    function check(){
		
        $event_id = $this->input->get('event_id', TRUE);
        if(!$event_id){
            echo "缺少必要参数,正在跳转";
            header("refresh:3;url="  . base_url());
            return;
        }
        if(!$this->session->userLocation)
		{
			//$this->data['title'] = "位置";
			//$this->smarty->main_view('location', $this->data);
			$this->load->view('qiandao/check/header');
			$this->load->view('qiandao/check/location');
			$this->load->view('qiandao/check/footer');
		}
		else
		{
			$check_info = array(
								'event_id' => $event_id,
								'user_id' => $this->data['user_info']['yb_userid'],
								'user_name' => $this->data['user_info']['yb_username'],
								'checked_date' => date('Y-m-d h:m:s'),
								'userLocation' => str_replace('</pre>"',"",$this->session->userLocation)
								);
			
			if($this->Qiandao_model->check($check_info)){
				$this->data['title'] = "签到成功";
				$this->smarty->main_view('checkresult', $this->data);
				return;
			}
		}
    }

    function detail($id = ''){
        if($id == '')
            redirect('qiandao');
		$this->data['title'] = "活动详情";
        $this->data['detail'] = $this->Qiandao_model->detail($id);
        $this->smarty->main_view('detail', $this->data);
    }

    function logout(){
        $this->session->sess_destroy();
        redirect();//回到首页
    }
}
