<?php

class Question_bank_model extends MY_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function rank()
	{
		$sql = "SELECT name,yb_userid,score,time FROM exam_list WHERE score >= 96 ORDER BY score DESC,time ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getdata($yb_userid)
	{
		$query = $this->db->get_where('exam_list',array('yb_userid' => $yb_userid));
		$result = $query->result_array();
		$count = count($result);
		return $count;
	}

	public function setdb($data)
	{
		return $this->db->insert('staffinf', $data);
	}

	public function settiku($data)
	{
		return $this->db->insert('question', $data);
	}

	public function getnum()
	{
		$result = $this->db->get('question');

		return count($result->result_array());
	}

	public function gettiku($data)
	{
		$num = 0;
		foreach ($data as $id) {
			$this->db->select('id, multi, title,Options_A,Options_B,Options_C,Options_D,Options_E,Options_F,Options_G,Options_H,fenzhi');
			$query = $this->db->get_where('question',array('id'=>$id));
			$result[$num++] = $query->result_array();
		}
		return $result;	
	}

	public function getanwser($data)
	{
		$num   = 0;
		$score = 0;
		$scoremulti = 0;
		//var_dump($data);
		foreach (array_keys($data) as $id) 
		{	
			$this->db->select('id,multi,anwser,fenzhi');
			$anwser = array_values($data)[$num];
			
			//多选
			if(is_array($anwser))
			{
				$anwser =implode( '',array_values($data)[$num]);

				$query = $this->db->get_where('question',array(
																'id'     => $id,
																'anwser' => $anwser,
																'multi'  =>'Y'
																));
				$resultmulti1 = $query->result_array();

				//多选答案正确
				if(!empty(array_filter($resultmulti1)))
				{
					// var_dump("多选全等");
					foreach (array_filter($resultmulti1) as $temp) 
					{	
						$scoremulti = $scoremulti + $temp['fenzhi'];
					
					}
				}
				else
				{
					//多选少选得分
					//var_dump('多选少选');
					$count = 0;
					// exit;
					$flag = $id;
					for($count=0;$count<50;$count++)
					{
						if(isset(array_values($data)[$count]))
							if(is_array(array_values($data)[$count]))
							{
								foreach (array_values($data)[$count] as $value) {
									//var_dump($value);
									$sql = "SELECT * FROM question WHERE id = ".$id." AND multi = 'Y' AND anwser LIKE '%".$value."%' ";
									$query = $this->db->query($sql);
									
									$resultmulti2 = $query->result_array();
									// var_dump($resultmulti2);
									if($flag == $id)
									{
										$flag = $id + 1;
										foreach ($resultmulti2 as $key) {
											$scoremulti = $scoremulti + $key['fenzhi'];
										}
									}
									
									// var_dump($score);
								}
							}
					}
				}
				$num++;

			}
			//单选
			else
			{
				//var_dump("单选");
				$score = 0;
				$query = $this->db->get_where('question',array(
																'id'      => $id,
																'anwser' => $anwser,
																'multi'  => 'N'
																));
				$result[$num++] = $query->result_array();

				foreach (array_filter($result) as $temp) {
					foreach ($temp as $value) {
						// var_dump($value);	
						$score = $score + 2;
					}
				}
				// var_dump($result);
			}
			
		}
		// exit();		
		return $score + $scoremulti;
	}
	public function score($data)
	{
		return $this->db->insert('exam_list',$data);
	}

	public function admin($type,$yb_userid = '0')
	{
		if($type == 1)			//检查管理员权限
		{
			$query = $this->db->get_where('exam_admin',array('yb_userid' => $yb_userid));
			$result = $query->result_array();
			$count = count($result);
			return $count;
		}
		elseif($type == 2)	//获取成绩列表
		{
			$result['num'] = $this->db->count_all('exam_list');
			$result['list'] = $this->all('*', '', 'exam_list');
			return $result;
		}
		elseif ($type == 3) 	//检查超管权限
		{
			$this->db->select('privilege');
			$query = $this->db->get_where('exam_admin',array('yb_userid' => $yb_userid));
			return $query->result_array();
		}
		elseif ($type == 4) 	//获取各分数段人数
		{
			$sql['0'] = 'SELECT * FROM exam_list WHERE score <= 50';
			$sql['1'] = 'SELECT * FROM exam_list WHERE score > 50 AND score <= 60';
			$sql['2'] = 'SELECT * FROM exam_list WHERE score > 60 AND score <= 70';
			$sql['3'] = 'SELECT * FROM exam_list WHERE score > 70 AND score <= 80';
			$sql['4'] = 'SELECT * FROM exam_list WHERE score > 80 AND score <= 90';
			$sql['5'] = 'SELECT * FROM exam_list WHERE score > 90 AND score <= 100';

			$result['0'] = count($this->db->query($sql['0'])->result_array());
			$result['1'] = count($this->db->query($sql['1'])->result_array());
			$result['2'] = count($this->db->query($sql['2'])->result_array());
			$result['3'] = count($this->db->query($sql['3'])->result_array());
			$result['4'] = count($this->db->query($sql['4'])->result_array());
			$result['5'] = count($this->db->query($sql['5'])->result_array());
			return $result;
		}
	}
}
