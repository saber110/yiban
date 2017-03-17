<?php 

class Yiju_model extends MY_Model{

    function __construct(){
        parent::__construct();
    }

    function subscribe($iteminfo, $status){
        if($this->get_select_num("ys_itemid='{$iteminfo['ys_itemid']}' and ys_userid='{$iteminfo['ys_userid']}'", 'yiju_subscribe')){
            if($status = 1){
                return $this->update("ys_itemid='{$iteminfo['ys_itemid']}'",  $iteminfo, 'yiju_subscribe');
            }
            else{
                return $this->dissubscribe("ys_itemid='{$iteminfo['ys_itemid']}'", 'yiju_subscribe');
            }
            
        }
        else{
            return $this->insert($iteminfo, 'yiju_subscribe');
            // return TRUE;
        }
    }

    function dissubscribe($itemid, $userid){
        return $this->delete("ys_itemid='{$ys_itemid}' and ys_userid='{$ys_userid}'", 'yiju_subscribe');
    }

    function get_subscribe_status($userid, $itemid){
        // return $this->db->select('*')
        //                 ->from('yiju_subscribe')
        //                 ->where('ys_userid={$userid} and ys_itemid={$itemid}')
        //                 ->get()->result_array();
        return $this->get_select_num("ys_userid='{$userid}' and ys_itemid='{$itemid}'", 'yiju_subscribe');
    }

    function get_subscribe($userid, $itemid=''){

        if($itemid == ''){
            return $this->db->select('*')
                            ->from('yiju_subscribe')
                            ->where("ys_userid='{$userid}'")
                            ->order_by('ys_date desc')
                            ->get()->result_array();
        }
        else{
            return $this->db->select('*')
                            ->from('yiju_subscribe')
                            ->where("ys_userid='{$userid}' and ys_itemid='{$itemid}'")
                            ->order_by('ys_date desc')
                            ->get()->result_array();
        }
    }

    function get_item_ranking(){
        return $this->db->select('ys_itemid,ys_itemname,count(*) as count')
                            ->from('yiju_subscribe')
                            ->group_by("ys_itemname")
                            ->order_by('count desc')
                            ->get()->result_array();
    }

    function get_start_date($userid){
        return $this->db->select('ys_date')
                            ->from('yiju_subscribe')
                            ->where("ys_userid={$userid}")
                            ->group_by("ys_itemname")
                            ->order_by('ys_date asc')
                            ->get()->result_array()[0]['ys_date'];
    }

}
