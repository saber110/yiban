<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 资料线上共享
* author 胡皓斌 huhaobin110@gmail.com
*/
class Data extends CI_Controller
{
	public $data;
	private $Datatoken = 'testtoken';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Data_model');

		//$this->data['user_info']['yb_userid'] = "7041045";
		//$this->data['user_info']['yb_username'] = "胡皓斌";
        //本地配置
		$this->load->library('pagination');

		$config['base_url'] = 'http://www.qinan.site/yiban/data/index';
		$config['total_rows'] = $this->Data_model->AllRecords();
		//var_dump($config['total_rows']);
		$this->data['per_page'] = $config['per_page'] = 8;

		$this->pagination->initialize($config);
        $config = array('appID' => '85b1d2d3a8f3b0c6',
                        'appSecret' => 'dd709192814ee03530783622d08ffc05',
                        'callback' => "http://f.yiban.cn/iapp69591");
        $this->load->library('YibanSDK', $config, 'yiban');
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
             if ($this->input->get('verify_request')) {
             /**
              * 使用授权码（code）获取访问令牌
              * 若获取成功，返回 $info['access_token']
              * 否则查看对应的 msgCN 查看错误信息
              */
                 $info = $this->yiban->getFrameUtil()->perform();
                 if (!isset($info['visit_oauth']['access_token'])) {
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
		if(isset($this->input->post()['page']))
		{
			if($this->input->post()['page']<=0)
			{
				$page=1;
			}
			else
			{
				$page=$this->input->post()['page'];
			}
			header("Location:".base_url()."data/index/".($page-1)*$this->data['per_page']);
		}
	}

	public function search()
	{
		if($this->input->post()['search'])
		{
			for($i=0;$i<mb_strlen(($this->input->post()['search']));$i++)
			{
				$pattern = mb_substr($this->input->post()['search'],$i,$i+1)."%";
			}
			$result['lists'] = $this->Data_model->search("%".$pattern);
			$this->load->view('data/header');
			$this->load->view('data/index',$result);
			$this->load->view('data/footer');
		}
		else
		{
			header("Location:".base_url()."data");
		}
	}

	public function index($pages = 0)
	{
		$lists['lists'] = $this->Data_model->data($pages,$this->data['per_page']);

		$lists['pages'] = str_replace('<a','<a class="button button-primary button-circle button-small"',$this->pagination->create_links());

		$lists['pages'] = str_replace('<strong>','<button class="button button-circle button-tiny">',$lists['pages']);

		$lists['pages'] = str_replace('</strong>','</button>',$lists['pages']);

		$this->load->view('data/header');
		$this->load->view('data/index',$lists);
		$this->load->view('data/footer');

	}

	public function admin($para = 1)
	{
		if($this->Data_model->admin($this->data['user_info']['yb_userid'],"manage") > 0)
		{
			if($para == "updateprivilege")
			{
				$this->Data_model->admin($this->input->get()['id'],"updateprivilege");
				$privilege = $this->Data_model->admin($this->input->get()['id'],"list");
				if($privilege[0]['privilege'] == 0)
				{
					echo "success";
				}
				else
				{
					echo "failure";
				}
			}
			elseif ($para == "add")
			{
				if($this->Data_model->admin($this->input->post(),'add'))
				{
					header("Location:".base_url()."data/admin");
				}
			}
			elseif ($para == "delete") {
				if($this->Data_model->admin($this->input->get()['id'],'delete'))
				{
					echo "success";
				}
				else
				{
					echo "failure";
				}
			}
			elseif ($para == "updatefilename") {
				if($this->Data_model->updatefilename($this->input->get()['old'],$this->input->get()['now']))
				{
					echo "success";
				}
				else
				{
					echo "failure";
				}
			}
			else
			{
				$lists['managers'] = $this->Data_model->admin($this->data['user_info']['yb_userid'],"list");
				// var_dump($lists);

				$this->load->view('data/header');
				$this->load->view('data/admin/index',$lists);
				$this->load->view('data/footer');
			}
		}
		else
		{
			header("Location:".base_url()."data/upload");
		}
	}


	public function upload()
	{
		if($this->Data_model->admin($this->data['user_info']['yb_userid']) >0)
		{
			$config['upload_path']      = './uploads/';
	        $config['allowed_types']    = 'docx|xlsx|pptx|doc|ppt|pdf|jpg|gif';
			$config['max_size']         = 1024;
			$config['file_ext_tolower'] = true;
			$config['overwrite']        = true;
			$config['file_name']        = date('Y_m_d_h_i_s');

			//$this->load->helper('form');
	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
	        	$this->load->view('data/header');
	        	$this->load->view('data/upload',$error);
	        	$this->load->view('data/footer');
	        }
	        else
	        {
	        	$filename = $_FILES['userfile']['name'];
				$type = $_FILES["userfile"]["type"];
				if($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
				{
					$type = "docx";
				}
				elseif($type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
				{
					$type = "xlsx";
				}
				elseif($type == "application/msword")
				{
					$type = "doc";
				}
				elseif($type == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
				{
					$type = "pptx";
				}
				elseif($type == "application/vnd.ms-powerpoint")
				{
					$type = "ppt";
				}
				elseif ($type == "application/pdf") {
					$type = "pdf";
				}
				elseif ($type == "image/jpeg") {
					$type = "jpg";
				}
				elseif ($type == "image/gif") {
					$type = "gif";
				}
				//var_dump($type);
				//exit;
				$rename = date('Y_m_d_h_i_s');
	        	$this->update($filename,"http://www.qinan.site/yiban/uploads/$rename.$type");
	        }
    	}
    	else
    	{
    		header("Location:".base_url()."data");
    	}
	}
	public function view($value='DtPmImw')
	{
		header("Location: http://api.idocv.com/view/$value");
	}

	public function update($title,$url='http://www.qinan.site/yiban/nihao.docx')
	{
		if($this->Data_model->admin($this->data['user_info']['yb_userid']) >0)
		{
			//var_dump($url);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://api.idocv.com/doc/upload?token=$this->Datatoken&url=$url");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$this->temp = json_decode(curl_exec($ch));
			//var_dump($this->temp);
			curl_close($ch);
			$this->data['file'] = $this->object2array_pre($this->temp);
			$this->data['time'] = date('Y-m-d h:i:s');
			$this->data['file']['name'] = $title;
			$this->Data_model->upload($this->data);
			$content['title'] = "上传成功";
			$this->load->view('data/announce',$content);
		}
		else
    	{
    		header("Location:".base_url()."data");
    	}
	}

	private function object2array(&$object)
	{
	    $object = json_decode( json_encode( $object),true);
	    return $object;
    }
	private function object2array_pre(&$object)
	{
	    if (is_object($object))
	    {
	    	$arr = (array)($object);
	    }
	    else
	    {
	    	$arr = &$object;
	    }
	    if (is_array($arr))
	    {
		    foreach($arr as $varName => $varValue)
		    {
			    $arr[$varName] = $this->object2array($varValue);
		    }
	    }
	    return $arr;
    }
}
