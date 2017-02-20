<?php

class Qiandao_model extends MY_Model{

    function __construct(){
        parent::__construct();
    }

    function create($data){
        return $this->insert($data, 'qiandao');
    }

    function update_qrcode($id, $path){
        $search = "event_id={$id}";
        $data = array('QRcode' => $path);
        return $this->update($search, $data, 'qiandao');
    }

    function current_events($user_id = ''){
        if($user_id == '')
            return $this->all('*', 'event_id', 'qiandao');
        else
            return $this->select("user_id={$user_id}", 'qiandao');
    }

    function check($data){
        if(!$this->get_select_num("event_id={$data['event_id']} and user_id='{$data['user_id']}'", 'qiandao_list'))
            return $this->insert($data, 'qiandao_list');
        else
            return TRUE;
    }

    function detail($event_id){
        $info['event'] = $this->select("event_id={$event_id}", 'qiandao')[0];
        $info['members'] = $this->db->where("qiandao_list.event_id={$event_id}")
                         ->select('qiandao_list.*')
                         ->from('qiandao_list')
                         // ->join('qiandao_list', 'qiandao.event_id=qiandao_list.event_id', 'left')
                         ->order_by('checked_date desc')
                         ->get()->result_array();
        $info['current_check_num'] = $this->get_select_num("event_id={$event_id}", 'qiandao_list');
        return $info;
    }
}
