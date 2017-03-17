<?php

class LostFound_Model extends MY_Model{
    public $lastest_created_id = NULL;
    function __construct(){
        parent::__construct();
    }

    function create($data){
        foreach($data as $key => $value){
            if($key == "lf_upload"){
                foreach ($data['lf_upload'] as &$photo) {
                    $photo = 'attch/lostfound/upload/' . $photo;
                    // echo $photo;
                }
                $data['lf_upload'] = json_encode($data['lf_upload'], JSON_UNESCAPED_UNICODE);
            }
            else{
                $data[$key] = htmlspecialchars(trim($value));
            }
        }
        // var_dump($data);
        $this->lastest_created_id = $this->insert($data, 'lostfound');
        return $this->lastest_created_id;
    }

    function detail($id){
        $detail = $this->db->select('*')
                           ->from('lostfound')
                           ->where("lf_id={$id}")
                           ->get()->result_array()[0];
        $detail['lf_upload'] = json_decode($detail['lf_upload'], TRUE);
        return $detail;
    }

    function current_items($type = 0){
        if ($type != 0){
            $items = $this->db->select('lf_id,lf_title,lf_detail,lf_date')
                           ->from('lostfound')
                           ->where('lf_type=' . $type)
                           ->order_by('lf_date desc')
                           ->get()->result_array();
        }else{
            $items = $this->db->select('lf_id,lf_title,lf_detail,lf_date')
                           ->from('lostfound')
                           ->order_by('lf_date desc')
                           ->get()->result_array();
        }
        
        // $items['lf_upload'] = json_decode($items['lf_upload'], TRUE);
        foreach($items as $key => &$value){
            if (strlen($value['lf_detail']) > 50){
                $value['lf_detail'] = mb_substr($value['lf_detail'], 0, 50, 'utf-8') . '··· ···';
            }
        }
        return $items;
    }
}
