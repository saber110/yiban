
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Question_bank extends CI_Controller{
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Question_bank_model');
/*
		$this->data['dealed'] = 'dealde';
				$this->data['rank'] = $this->Question_bank_model->rank();
				$this->load->view('question_bank/rank',$this->data);
				$this->data['dealed'] = 'dealde';
				return;
*/
		
		require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
		require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';
		require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel5.php';
		

		// site服务器配置
		$config = array('appID' => '3d8157e7e4d7e123',
                        'appSecret' => '31c12fd4d8a19da28113b5e89c34081e',
                        'callback' => "http://f.yiban.cn/iapp62793");
		//本地测试
// 		$config = array('appID' => '2603163d78712ee3',
//                         'appSecret' => '1ce9ffc76d284c5dde2a2002feed6c45',
//                         'callback' => "http://f.yiban.cn/iapp62933");
        $this->load->library('YibanSDK', $config, 'yiban');

   //     $this->yiban->getAuth();
    //    $this->data['user_info'] = $this->session->user_info;
	if (!$this->input->get('verify_request')) {
            $this->session->url = $_SERVER['REQUEST_URI'];
            // var_dump($_SERVER['REQUEST_URI']);
            // exit();
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
		$this->data['dealed'] = 'undealde';
		$this->data['submit'] = 'unsubmit';
        if($this->Question_bank_model->admin(1,$this->data['user_info']['yb_userid']) == 0)
        {
	        if($this->Question_bank_model->getdata($this->data['user_info']['yb_userid']) >= 1 )
	        {
				$this->data['dealed'] = 'dealde';
				$this->data['rank'] = $this->Question_bank_model->rank();
				$this->load->view('question_bank/rank',$this->data);
				$this->data['dealed'] = 'dealde';
				return;
	        }
    	}
	}

	/*
	* array unique_rand( int $min, int $max, int $num )
	* 生成一定数量的不重复随机数
	* $min 和 $max: 指定随机数的范围
	* $num: 指定生成数量
	*/
	public function unique_rand($min, $max, $num) {
	    $count = 0;
	    $return = array();
	    while ($count < $num) {
	        $return[] = mt_rand($min, $max);
	        $return = array_flip(array_flip($return));
	        $count = count($return);
	    }
	    shuffle($return);
	    return $return;
	}

	public function update_db()
	{
		$objReader = PHPExcel_IOFactory::createReader('Excel2007'); //use Excel5 for 2003 format 
		$excelpath= './././uploads/question_bank/test.xlsx';
		$objPHPExcel = $objReader->load($excelpath); 	
	    $sheet = $objPHPExcel->getSheet(0); 
	    $highestRow = $sheet->getHighestRow();           //取得总行数 
	    // var_dump('ROW');
	    // var_dump($highestRow);
	    $highestColumn = $sheet->getHighestColumn();     //取得总列数
	    // var_dump('columu');
	    // var_dump($highestColumn);


		for($j=3;$j<=$highestRow;$j++)                       //从第三行开始读取数据
	    { 

	        $str="";

	        for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据

	         { 
	             $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
	         } 
	        $strs = explode("|*|",$str);
	        // var_dump($strs);
	        $sql = array(
	        	'department' => $strs[0],
	        	'stdgroup'   => $strs[1],
	        	'stdposition'=> $strs[2],
	        	'name'       => $strs[3],
	        	'sex'        => $strs[4],
	        	'college'    => $strs[5],
	        	'class'      => $strs[6],
	        	'dormnumber' => $strs[7],
	        	'Tel'        => $strs[8],
	        	'QQ'         => $strs[9],
	        	'email'      => $strs[10],
	        	'cardnumber' => $strs[11],
	        	'stdnumber'  => $strs[12]
	        	);
	        // var_dump($sql);
			$this->Question_bank_model->setdata($sql);
        }
	}

	public function admin()
	{
		if($this->Question_bank_model->admin(1,$this->data['user_info']['yb_userid']) >= 1)
        {
        	//var_dump($this->Question_bank_model->admin(1,$this->data['user_info']['yb_userid']));

        	$config['upload_path']      = 'uploads/';
	        $config['allowed_types']    = 'doc|xlsx';
			$config['file_ext_tolower'] = true;
			$config['overwrite']        = true;
	        // $config['max_size']     = 100;
	        // $config['max_width']        = 1024;
	        // $config['max_height']       = 768;
			$this->load->helper('form'); 
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('userfile'))
			{ 
				$data['num'] = $this->Question_bank_model->admin(2)['num'];
                $data['score'] = $this->Question_bank_model->admin(4);
				//$data['score'] = $this->Question_bank_model->admin(2)['list'];
				if($this->Question_bank_model->admin(3,$this->data['user_info']['yb_userid']) == 0)
				{
					$data['privilege'] = 0;
				}
				$data['error'] = $this->upload->display_errors();
	        	$this->load->view('question_bank/admin/header');
	        	$this->load->view('question_bank/admin/upload',$data);
	        	$this->load->view('question_bank/admin/footer');
	        }
	        else
	        {
				$upload_data = array('upload_data' => $this->upload->data());

				$objReader = PHPExcel_IOFactory::createReader('Excel2007'); //use Excel5 for 2003 format 
				$excelpath= "uploads/".$upload_data['upload_data']['file_name'];
				$objPHPExcel = $objReader->load($excelpath); 	
			    $sheet = $objPHPExcel->getSheet(0); 
			    $highestRow = $sheet->getHighestRow();           //取得总行数 
			    // var_dump('ROW');
			    // var_dump($highestRow);
			    $highestColumn = $sheet->getHighestColumn();     //取得总列数
			    // var_dump('columu');
			    // var_dump($highestColumn);


				for($j=2;$j<=$highestRow;$j++)                       //从第二行开始读取数据
			    { 

			        $str="";

			        for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据

			         { 
			             $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
			         } 
			        $strs = explode("|*|",$str);
			        // var_dump($strs);
			        $sql = array(
			        	'anwser'      => $strs[0],
			        	'multi'       => $strs[1],
			        	'title'       => $strs[2],
			        	'Options_A'   => $strs[3],
			        	'Options_B'   => $strs[4],
			        	'Options_C'   => $strs[5],
			        	'Options_D'   => $strs[6],
			        	'Options_E'   => $strs[7],
			        	'Options_F'   => $strs[8],
			        	'Options_G'   => $strs[9],
			        	'Options_H'   => $strs[10],
			        	'fenzhi'      => $strs[11]
			        	);
			        // var_dump($sql);
					$this->Question_bank_model->settiku($sql);
				}
			}
		}
		else
		{
			header('Location: ' . base_url().'question_bank/index');
		}
	}

	public function timer()
	{
		$start = strtotime(date('Y-m-d h:i:s'));
		$timehhh = $start - strtotime($this->session->time);
		$m = floor(($timehhh%(86400))/60);
			echo 30-$m;
		$this->session->TimeSubmit = $m;
	}

	public function index()
	{
		// var_dump($this->session->user_info);
		// var_dump($this->data);
		
		$this->data['dealed'] = 'dealde';
				$this->data['rank'] = $this->Question_bank_model->rank();
				$this->load->view('question_bank/rank',$this->data);
				$this->data['dealed'] = 'dealde';
				return;


		if($this->data['dealed'] != 'dealde')
		{
			$this->session->submit = 'submit';
			$this->session->time = date('Y-m-d h:i:s');
			$this->num  = $this->Question_bank_model->getnum();

			// var_dump($this->num);
			if($this->num > 10)
			{
				$this->question['id'] = $this->unique_rand(1,$this->num,50);
			}

			$this->temp['ti'] = $this->Question_bank_model->gettiku($this->question['id']);


			$this->load->helper('form'); 
			$this->load->library('form_validation');

			// var_dump($this->question['id']);
			// var_dump($this->temp);
			// exit();
			$this->load->view('question_bank/header',$this->temp);
			$this->load->view('question_bank/question',$this->temp);
			$this->load->view('question_bank/footer');
			
		}
	}
	
	public function score()
	{
		if(empty($this->input->post()))
		{
			header('Location: ' . base_url().'question_bank/index');
		}
		elseif($this->session->submit== 'submit')
		{
			$score = $this->Question_bank_model->getanwser($this->input->post());

			$data['score'] = $score;
			$data['title'] = "成绩";
			$data['subtitle'] = "您的成绩为：";
			$data['remark'] = "点击OK按钮即可查看排行榜哦";
			// var_dump($score);
			// exit;
			$para = array(
				'name'    => $this->data['user_info']['yb_username'],
				'yb_userid' => $this->data['user_info']['yb_userid'],
				'score'   => $score,
				'detail'  => json_encode($this->input->post()),
				'time'    => $this->session->TimeSubmit
				);
			if($this->Question_bank_model->score($para))
			{
				$this->load->library('form_validation');
				$this->load->view('question_bank/header');
				$this->load->view('question_bank/score',$data);
				$this->load->view('question_bank/footer');
			}
		}
		else
		{
			header('Location: ' . base_url().'question_bank/index');
		}

	}

	public function export()
	{

		if($this->Question_bank_model->admin(1,$this->data['user_info']['yb_userid']) >= 1)
        {

			$data = $this->Question_bank_model->admin(2)['list'];

			$objPHPExcel=new PHPExcel();
	  		$iofactory=new PHPExcel_IOFactory();
			//Excel表格式,
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','姓名');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','易班id');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','得分');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','细节');

			foreach($data as $key => $value){
	       		$key+=2;
	     		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key,$value['name']);
	     		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key,$value['yb_userid']);
	     		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key,$value['score']);
	     		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key,$value['detail']);
	 		}
		

			//excel保存在根目录下  如要导出文件，以下改为注释代码
			// $objPHPExcel->getActiveSheet() -> setTitle('中南易班考试系统');
			// $objPHPExcel-> setActiveSheetIndex(0);
			// $objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
			// $objWriter -> save('YibanEXAM'.date('Y-m-d h:i:s').'.xlsx');
			//导出代码

			$objPHPExcel->getActiveSheet() -> setTitle('中南易班考试系统');
			$objPHPExcel-> setActiveSheetIndex(0);
			$objWriter = $iofactory -> createWriter($objPHPExcel, 'Excel2007');
			$filename = 'YibanEXAM'.date('Y-m-d h:i:s').'.xlsx';
			//清除php缓存防止乱码
			ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			header('Cache-Control: max-age=0');
			$objWriter -> save('php://output');

		}
		else
		{
			header('Location: ' . base_url().'question_bank/index');
		}
	}
}