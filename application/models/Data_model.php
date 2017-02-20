<?php

class Data_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function updatefilename($old,$now)
	{
		$query = $this->db->get_where('data',array('title'=>$old));
		if(count($query->result_array())>0)
		{
			$this->db->set('title',$now);
			$this->db->where('title',$old);
			return $this->db->update('data');
		}
		else
		{
			return false;
		}
	}
	public function AllRecords()
	{
		return $this->db->count_all_results('data');
	}
	public function search($value='')
	{
		$sql = "SELECT yb_userid,yb_username,uuid,title FROM data WHERE title LIKE '%".$value."%'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function admin($data,$type = "show")
	{
		if($type == "updateprivilege")
		{
			$sql = "UPDATE data_admin SET privilege = 0 WHERE yb_userid = $data";
			$query = $this->db->query($sql);
		}
		elseif($type == "manage")
		{
			$query = $this->db->get_where('data_admin',array(
				'yb_userid' => $data,
				'privilege' => 0
				));
			return count($query->result_array());
		}
		elseif ($type == "list") 
		{
			$query = $this->db->get('data_admin');
			return $query->result_array();
		}
		elseif ($type == "add") {
			return $this->db->insert('data_admin',array(
				'yb_userid'   => $data['yb_userid'],
				'yb_username' => $data['yb_username'],
				'privilege'   => $data['privilege']
				));
		}
		elseif ($type == "delete") {
			return $this->db->delete('data_admin',array('yb_userid' => $data));
		}
		else
		{
			$query = $this->db->get_where('data_admin',array('yb_userid' => $data));
			return count($query->result_array());
		}
	}
	public function data($page = 0,$rows)
	{
		$this->db->select('id,yb_userid,yb_username,uuid,title,time');
		$this->db->from('data');
		$this->db->where('id=',$page);
		while($rows--)
		{
			$this->db->or_where('id=',$page+$rows);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	public function upload($value='')
	{
		return $query = $this->db->insert('data',array(
			'yb_userid'   => $value['user_info']['yb_userid'],
			'yb_username' => $value['user_info']['yb_username'],
			'uuid'        => $value['file']['uuid'],
			'title'       => $value['file']['name'],
			'time'        => $value['time']
 			));
	}

	public function getLast()
	{
		$query = $this->db->get('data');
		return $query->last_row();
	}
}