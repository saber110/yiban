<?php

class Expedition_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getall()
	{
		$result = $this->db->get('Expedition');
		return count($result->result_array());		
	}

	public function getbyid($value=0)
	{
		$this->db->select('content');
		$result = $this->db->get_where('Expedition',array('id' => $value));
		return $result->result_array();
	}
}