<?php

class Duty_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function apply($method,$date,$type,$id)
	{
		if($method == 'inquire')
		{
			$query = $this->db->get_where('duty',array(
												'yb_userid' => $id,
												'dy_date'   => $date,
												'dy_type'   => $type
												));
			$result = $query->result_array();
			if(array_filter($result))
			{
				return true;
			}
		}
		elseif ($method == 'manage') {
			$sql = 'UPDATE duty SET dy_tuiban = "申请" WHERE yb_userid ==$id AND dy_date == $date AND dy_type == $type';
			$result = $this->db->query($sql);
			return $result->result_array();
		}
	}

	public function admin($type,$data)
	{
		if($type == 'privilege')
		{
			//超管权限
			$query = $this->db->get_where('duty_admin',array('yb_userid' => $data,'privilege'=>0));
			$result = $query->result_array();
			if(array_filter($result))
			{
				return "chaoguan";
			}
			//普通管理员
			else
			{
				$query = $this->db->get_where('duty_admin',array('yb_userid' => $data,'privilege'=>1));
				$result = $query->result_array();
				if(array_filter($result))
				{
					return "guanliyuan";
				}
			}
		}
		elseif($type == "admin_apply")
		{
			$query = $this->db->get_where('duty',array('dy_tuiban' => "申请"));
			return $query->result_array();
		}
		elseif($type == "list")
		{
			$query = $this->db->get('duty_admin');
			return $query->result_array();
		}
	}

	public function DutyQRcode($method,$data)
	{
		if($method == 'get')
		{
			$this->db->select('QRcode');
			$query = $this->db->get_where('duty',array('dy_date' => $data));
			return $query->row();
		}
		elseif ($method == 'set')
		{
			$query = $this->db->insert('duty',array('QRcode' => $data));
			return $query->result_array();
		}
	}

	public function yb_data($data)
	{
		$this->db->select('yb_userid,email,stdgroup');
		$query = $this->db->get_where('staffinf',array('name' => $data));
		return $query->result_array();
	}

	public function set_ybdata($dataid,$dataname)
	{
		$sql = 'UPDATE staffinf SET yb_userid = '.$dataid.' WHERE name = '.'.$dataname.';
		$this->db->where('name',$dataname);
		$this->db->update('staffinf', array('yb_userid'=>$dataid));
	}

	public function get_duty($time)
	{

		$query[0] = $this->db->get_where('duty',array('dy_date' => $time['monday']));
		$query[1] = $this->db->get_where('duty',array('dy_date' => $time['Tuesday']));
		$query[2] = $this->db->get_where('duty',array('dy_date' => $time['Wednesday']));
		$query[3] = $this->db->get_where('duty',array('dy_date' => $time['Thursday']));
		$query[4] = $this->db->get_where('duty',array('dy_date' => $time['Friday']));
		$query[5] = $this->db->get_where('duty',array('dy_date' => $time['Saturday']));
		$query[6] = $this->db->get_where('duty',array('dy_date' => $time['Sunday']));

		$result['monday']    = $query[0]->result_array();
		$result['Tuesday']   = $query[1]->result_array();
		$result['Wednesday'] = $query[2]->result_array();
		$result['Thursday']  = $query[3]->result_array();
		$result['Friday']    = $query[4]->result_array();
		$result['Saturday']  = $query[5]->result_array();
		$result['Sunday']    = $query[6]->result_array();

		return $result;
	}

	public function set_duty($userid,$username,$date,$type)
	{
		// $query = $this->db->get_where('duty',array(
		// 											'dy_date' => $data['dy_date'],
		// 											'dy_type' => $data['dy_type']
		// 											));
		$query = $this->db->get_where('duty',array(
													'dy_date' => $date,
													'dy_type' => $type
													));
		$result = $query->result_array();

		if(count($result)>=3)
		{
			return 'over';
		}
		else
		{
			// $duty = array(
			// 	'yb_userid' => $data['data']['yb_userid'],
			// 	'dy_date'   => $data['dy']['dy_date'],
			// 	'dy_type'   => $data['dy']['dy_type'],
			// 	'remark'    => ""
			// 	);
			$duty = array(
				'yb_userid' => $userid,
				'yb_username' => $username,
				'dy_date'   => $date,
				'dy_type'   => $type,
				'remark'    => ""
				);
			return $this->db->insert('duty',$duty);
		}
	}

	public function statistics($data)
	{
		// $this->db->order_by('yb_date', 'DESC');
		$query = $this->db->get_where('duty',array('yb_userid' => $data));
		$result['detail'] = $query->result_array();
		$result['num'] = count($result['detail']);
		return $result;
	}

	public function contacts()
	{
		$this->db->select('yb_userid,department,stdgroup,name,QQ');
		$query = $this->db->get('staffinf');
		return $query->result_array();
	}
}
