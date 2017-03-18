
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Duty extends CI_Controller{
	public $data;
	public $weekday;

	public function __construct()
	{
		//周一零点开始选班
		parent::__construct();
		$this->load->model('Duty_model');
		$this->load->model('Email_model');
		$this->load->library('My_email');
		$this->load->library('DataOption');

		$this->weekday['today'] = date('w',strtotime(date('Y-m-d')));
		$this->weekday['days'] = $this->getdays(date('Y-m-d'));
		$this->weekday['monday'] = $this->weekday['days']['firstday'];
		$this->weekday['Tuesday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['monday'])));
		$this->weekday['Wednesday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['Tuesday'])));
		$this->weekday['Thursday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['Wednesday'])));
		$this->weekday['Friday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['Thursday'])));
		$this->weekday['Saturday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['Friday'])));
		$this->weekday['Sunday'] = date('Y-m-d',strtotime('+1 day',strtotime($this->weekday['Saturday'])));

		$this->data['user_info']['yb_username']="胡皓斌";
		$this->data['user_info']['yb_userid'] = 7041045;
		// // 本地服务器配置
		// $config = array(
		// 				'appID' => '224ffbe0dba1e41e',
    //                     'appSecret' => 'd152d9e13af0a1c6295344a9b9aa88e8',
    //                     'callback' => "http://f.yiban.cn/iapp100597"
    //                     );
		//
		// $this->load->library('YibanSDK',$config,'yiban');
		//
		// if (!$this->input->get('verify_request')) {
		// 		$this->session->url = $_SERVER['REQUEST_URI'];
		// }
		// //var_dump($this->session);
		// if (!isset($this->session->token)) {     // 未获取授权
		// /**
		//  * 从授权服务器回调返回时，URL中带有code（授权码）参数
		//  *
		//  */
		//
		// 		$au  = $this->yiban->getAuthorize();
		// 		//var_dump($this->input->post());
		// 		if ($this->input->get('verify_request')) {
		// 		/**
		// 		 * 使用授权码（code）获取访问令牌
		// 		 * 若获取成功，返回 $info['access_token']
		// 		 * 否则查看对应的 msgCN 查看错误信息
		// 		 */
		// 				$info = $this->yiban->getFrameUtil()->perform();
		// 				//var_dump($info);
		// 				if (!isset($info['visit_oauth']['access_token'])) {
		// 						//echo $info['msgCN'];
		// 						redirect($au->forwardurl());
		// 				}
		// 				$this->session->token = $info['visit_oauth']['access_token'];
		// 				$this->data['user_info']['yb_userid'] = $info['visit_user']['userid'];
		// 				$this->data['user_info']['yb_username'] = $info['visit_user']['username'];
		// 				header("Location: " . $this->session->url);
		// 		}
		// 		else {   // 重定向到授权服务器（原sdk使用header()重定向）
		// 				redirect($au->forwardurl());
		// 				// header('Location: ' . $au->forwardurl());
		// 		}
		// }
		// if(!isset($this->data['user_info']) && $this->session->token){
		// 		$this->user = $this->yiban->getUser($this->session->token);
		//
		// 		$this->data['user_info'] = $this->user->me()['info'];
		// }
		// $this->user = $this->yiban->getUser($this->session->token);

		if($this->weekday['today'] == $this->weekday['monday'])
		{
			if(! $this->Duty_model->DutyQRcode('get',$this->weekday['today']))
			{
				$edited['user_id'] = $this->data['user_info']['yb_userid'];
		        $edited['user_name'] = $this->data['user_info']['yb_username'];
		        $edited['created_date'] = date('Y-m-d h:i:s');
		        $event_id = $this->Qiandao_model->create($edited);
		        if($event_id)
		        {
					include(APPPATH . 'third_party/phpqrcode/qrlib.php');
		            $save_path = 'attch/' . md5($event_id) . '.png';
		            QRcode::png(base_url() . "index.php/qiandao/check?event_id=".$event_id." ", $save_path, QR_ECLEVEL_H, 7);
		            //更新二维码路径
		            $this->Qiandao_model->update_qrcode($event_id, $save_path);
		            $this->data['qrcode'] = $save_path;
		            $this->Duty_model->DutyQRcode('set',date('Y-m-d h:i:s'));
		            return;
	        	}
			}
		}
	}

	public function index()
	{
		// 若没绑定
		if(! $this->Duty_model->yb_data($this->data['user_info']['yb_username']))
		{
			$this->Duty_model->set_ybdata($this->data['user_info']['yb_userid'],$this->data['user_info']['yb_username']);
			header('Location :'.base_url().'duty');
		}
		else//已经进行绑定
		{
			$this->duty['data'] = $this->Duty_model->get_duty($this->weekday);
			var_dump($this->duty['data']);
			$table['data'] = array('first' =>array(0,0,0,0,0,0,0),
										'second' =>array(0,0,0,0,0,0,0),
									  'third'  =>array(0,0,0,0,0,0,0),
								    'forth'  =>array(0,0,0,0,0,0,0),
										'fifth'  =>array(0,0,0,0,0,0,0),
										'sixth'  =>array(0,0,0,0,0,0,0),
										'seventh'=>array(0,0,0,0,0,0,0));
			$index = array('1' => 'first',
		 								'2'  => 'second',
										'3'  => 'third',
										'4'  => 'forth',
										'5'  => 'fifth',
										'6'  => 'sixth',
										'7'  => 'seventh');
			foreach ($this->duty['data'] as $key => $value) {
				switch($key)
				{
					case 'monday':
					{

						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][0]+=1;
							}
						}
						// else
						// 	$table['data']['first']=array(0,0,0,0,0,0,0);
					}break;
					case 'Tuesday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][1]+=1;
							}
						}
						// else
							// $table['data']['second']=array(0,0,0,0,0,0,0);
					}break;
					case 'Wednesday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][2]+=1;
							}
						}
						// else
							// $table['data']['third']=array(0,0,0,0,0,0,0);
					}break;
					case 'Thursday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][3]+=1;
							}
						}
						// else
							// $table['data']['forth']=array(0,0,0,0,0,0,0);
					}break;
					case 'Friday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][4]+=1;
							}
						}
						// else
							// $table['data']['fifth']=array(0,0,0,0,0,0,0);
					}break;
					case 'Saturday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][5]+=1;
							}
						}
						// else
							// $table['data']['sixth']=array(0,0,0,0,0,0,0);
					}break;
					case 'Sunday':
					{
						// if(isset($value[0]))
						{
							foreach ($value as $value1) {
								$table['data'][$index[$value1['dy_type']]][6]+=1;
							}
						}
						// else
							// $table['data']['seventh']=array(0,0,0,0,0,0,0);
					}break;
				}
			}
			// print_r($table);
			$this->load->view('duty/header');
			$this->load->view('duty/index',$table);
			$this->load->view('duty/footer');
		}
	}
	/**
	 * 本周选班情况
	 */
	public function record($value='')
	{
		$this->duty['data'] = $this->Duty_model->get_duty($this->weekday);

		// $this->load->view('duty/header');
		$this->load->view('duty/dutytable',$this->duty);
		// $this->load->view('duty/footer');
	}
	//退班
	//获取点击的日期和类型
	public function apply()
	{
		$date = "";
		$type = "";
		if($this->Duty_model->apply("inquire",$date,$type,$this->data['user_info']['yb_userid']))
		{
			$this->Duty_model->apply("manage",$date,$type,$this->data['user_info']['yb_userid']);
			$data['content'] = "申请已发送,请及时查看值班表";
			$this->load->view('duty/header');
			$this->load->view('duty/apply',$data);
			$this->load->view('duty/footer');

		}
	}

	public function select()
	{
		$this->duty = $this->Duty_model->get_duty($this->weekday);
		$this->goal['dy'] = $this->input->post();//获取值班时间和班次类型
		$this->goal['data'] = $this->data;
		$this->status = $this->Duty_model->set_duty($this->data['user_info']['yb_userid'],$this->data['user_info']['yb_username'],
																								$this->weekday[$this->goal['dy']['date']],$this->goal['dy']['type']);

		if($this->status === 'over')
		{
			$data['content'] = "此班人数已满";
		}
		else
		{
			$data['content'] = "选班成功";
			$para = $this->Duty_model->yb_data($this->data['user_info']['yb_username']);
			$this->send("选班成功","亲爱的".$this->data['user_info']['yb_username'].",您好，您已经成功的选择了".$this->weekday[$this->goal['dy']['date']]."的值班，
			请不要迟到早退哦，加油",$para[0]['email']);
		}
		echo $data['content'];
	}

	public function send($subject="hello",$message="test",$to="huhaobin110@gmail.com",$user="中南易班",$from="hhb@csuyiban.net")
	{
		$this->my_email->send($to,$subject,$message,$from,$user);
	}

	public function check()
	{
		header("Location:".base_url()."qiandao/check?event_id=".$this->Duty_model->DutyQRcode('get',$this->weekday['monday']));
	}

	/**
	 * 行政导出本周值班表
	 */
	public function List($value='')
	{
		if($this->Duty_model->yb_data($this->data['user_info']['yb_userid'])['stdgroup']=='人资组')
		{
			$this->duty['data'] = $this->Duty_model->get_duty($this->weekday);
			$num=0;
			foreach ($this->duty['data'] as $key => $temp) {
				foreach ($temp as $key => $value) {
					if(!empty($value))
						$content[$num++]=$value;
				}
			}
			$this->dataoption->Export('中南易班值班表',array('A1'=>"序号",'B1'=>'易班id','C1'=>'姓名',
																'D1'=>'值班日期','E1'=>'班次类型(数字代表改天第几个班)','F1'=>'二维码','G1'=>'退班申请',
																'H1'=>'备注'),$content,'中南易班值班表.xls');
		}
		else {
			header('Location :'.base_url().'duty');
		}
	}
	public function statistics()
	{
		$nimade['statistics'] = $this->Duty_model->statistics($this->data['user_info']['yb_userid']);
		// var_dump($nimade['statistics']['detail']);


		$this->load->view('duty/header');
		$this->load->view('duty/statistics',$nimade);
		$this->load->view('duty/footer');
	}

	public function contacts()
	{
		$nimade['tamade'] = $this->Duty_model->contacts() ;
		//处理部门和小组数据，分组展示
		// $this->load->view('duty/header');

		$this->load->view('duty/contacts',$nimade);
		// $this->load->view('duty/footer');
	}

	public function getdays($day)
	{
	    $lastday=date('Y-m-d',strtotime("$day Sunday"));
	    $firstday=date('Y-m-d',strtotime("$lastday -6 days"));
	    return array('firstday' => $firstday,'lastday' => $lastday);
	}
	//行政具有管理员权限
	//部长总监具有超管权限
	public function admin()
	{
		if($this->Duty_model->admin('privilege',$this->data['user_info']['yb_userid']) == "guanliyuan")
		{
			//换班
			$data['content'] = $this->Duty_model->admin('admin_apply','zanliu');

			//排班
			$data['paiban'] = $this->input->post();
			$data['data']   = $this->data;
			$this->status = $this->Duty_model->set_duty($this->data);
			// var_dump($this->duty);var_dump($this->goal);var_dump($this->status);
			// exit();
			if($this->status == 'false')
			{
				$data['paiban_content'] = "此班人数已满";
			}
			else
			{
				$data['paiban_content'] = "排班成功";
			}

			$this->load->view('duty/admin/header');
			$this->load->view('duty/admin/index',$data);
			//ajax处理数据显示申请状态
			$this->load->view('duty/admin/footer');

		}
		elseif($this->Duty_model->admin('privilege',$this->data['user_info']['yb_userid']) == "chaoguan")
		{
			//管理管理员	ajax修改管理员权限
			$data['admin_list'] = $this->Duty_model->admin('list','zanliu');
			$data['duty_list'] = $this->Duty_model->get_duty($this->weekday);
			//换班
			$data['content'] = $this->Duty_model->admin('admin_apply','zanliu');

			//排班
			$data['paiban'] = $this->input->post();
			$data['data']   = $this->data;
			$this->status  = "true";
			//$this->status = $this->Duty_model->set_duty($this->data['user_info']['yb_userid'],$this->data['user_info']['yb_username'],
			//																						$this->weekday['today']，);
			// var_dump($this->duty);var_dump($this->goal);var_dump($this->status);
			// exit();
			if($this->status == 'false')
			{
				$data['paiban_content'] = "此班人数已满";
			}
			else
			{
				$data['paiban_content'] = "排班成功";
			}

			$this->load->view('duty/admin/header');
			$this->load->view('duty/admin/admin',$data);
			//ajax处理数据显示申请状态
			$this->load->view('duty/admin/footer');
		}
	}

}
