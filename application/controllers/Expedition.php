<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expedition extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Expedition_model');
	}

	public function index()
	{
		$this->load->view('changzheng/header');
		$this->load->view('changzheng/chengzheng');
		$this->load->view('changzheng/footer');
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

	public function Expedition()
	{
		$data = $this->input->get();
		// print_r($data);
		if($data['name'] == "张梦茹")
		{
			$data['content'][0]['content'] = "在这里说我喜欢你是不是太low了。。但是我好怕跟你擦肩而过";
		}
		elseif ($data['name'] == "吴泽冉") {
			$data['content'][0]['content'] = "你好啊,爸爸";
		}
		elseif ($data['name'] == "胡皓斌") {
			$data['content'][0]['content'] = "叫爸爸干啥";
		}
		elseif ($data['name'] == "焦敏") {
			$data['content'][0]['content'] = "傻女儿，你很优秀，别再说自己智障了哈。ps:有些彩蛋不是我写的";
		}
		else
		{
			$number = $this->Expedition_model->getall();
			$data['content'] = $this->Expedition_model->getbyid($this->unique_rand(0, $number, 1)[0]);
		}

		echo "<h3>".$data['name']."</h3><hr/>";
		echo $data['content'][0]['content'];

	}
}
