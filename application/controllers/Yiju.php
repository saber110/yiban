<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Yiju extends CI_Controller{

    function __construct(){
        parent::__construct();
        $params = array('app' => 'yiju');
        $this->load->library('Use_smarty', $params, 'smarty');
        // $this->load->library('RSS', 'fuck', 'RSS');
        $this->load->model('Yiju_model');

        //本地配置
        $config = array('appID' => 'f72ebacd7e3f4224',
                        'appSecret' => 'dc8371083ef924d4cf37f9ec371d51d1',
                        'callback' => "http://f.yiban.cn/iapp55177");
        $this->load->library('YibanSDK', $config, 'yiban');
        // var_dump($this->session->token);
        if (!$this->input->get('verify_request')) {
            $this->session->url = $_SERVER['REQUEST_URI'];
        }
        // var_dump($this->session->token);
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
                var_dump($this->session->url);
                exit();
                header("Location: " . $this->session->url);
            }
            else {   // 重定向到授权服务器（原sdk使用header()重定向）
                redirect($au->forwardurl());
                // header('Location: ' . $au->forwardurl());
            }
        }
        if(!isset($this->data['user_info']) && $this->session->token){
            $this->user = $this->yiban->getUser($this->session->token);
            $this->friend = $this->yiban->getFriend($this->session->token);
            $this->data['user_info'] = $this->user->me()['info'];
        }

    }

    function index(){
        $this->data['title'] = 'YB-viewing';
        $this->smarty->main_view('index', $this->data);
    }

    function test(){
        $itemid = $this->get_itemid('末日孤舰');
        echo $itemid;
        $itempage = $this->get_itempage($itemid);
        // echo $itempage;
        $status = $this->get_status($itempage);
        $sub = $this->Yiju_model->get_subscribe('5540481');
        print_r($this->get_friends());
        var_dump($this->Yiju_model->get_last_date('5540481'));

    }

    function search(){
        $itemname = $this->input->get('itemname', TRUE);
        $itemid = $this->input->get('itemid', TRUE);
        // echo $itemid;
        if(!$itemid){
            $itemid = $this->get_itemid($itemname);
        }
        if(!$itemid){
            echo "ooooops!!出错了";
            return;
        }
        $itempage = $this->get_itempage($itemid);
        // echo $itempage;
        $this->data['itemid'] = $itemid;
        $this->data['itemname'] = $itemname;
        $this->data['baseinfo'] = $this->get_baseinfo($itempage);
        $this->data['intro'] = $this->get_intro($itempage);
        $this->data['screenwriters'] = $this->get_screenwriter($itempage);
        $this->data['directors'] = $this->get_director($itempage);
        $this->data['starrings'] = $this->get_starring($itempage);
        $this->data['image'] = $this->get_image($itempage);

        if($this->Yiju_model->get_subscribe_status($this->data['user_info']['yb_userid'], $itemid)){
            $this->data['subscribe_status'] = 0;
            $this->data['subscribe_msg'] = '已订阅';
            $this->data['subscribe_class'] = 'btn btn-common-success uppercase';
        }
        else{
            $this->data['subscribe_status'] = 1;
            $this->data['subscribe_msg'] = '订阅';
            $this->data['subscribe_class'] = 'btn btn-common uppercase';
        }
        $this->smarty->main_view('search', $this->data);
        // echo $itempage;
        // var_dump($info);

    }


    function item_ranking(){
        $this->data['title'] = '排行';
        $this->data['ranking'] = $this->Yiju_model->get_item_ranking();
        $this->smarty->main_view('item_ranking', $this->data);
    }

    function timeline(){
        $userid = $this->input->post('userid');
        if(!$userid){
            $userid = $this->data['user_info']['yb_userid'];
            $this->data['title'] = '我的足迹';
            $this->data['start_date'] = $this->Yiju_model->get_start_date($userid);
            $this->show_timeline($userid);
            return;
        }
        else{
            $subscribes = $this->Yiju_model->get_start_date($userid);
            if($subscribes){
                //有订阅记录，调用支付，回调到show_timeline(),这里需要改一下url
                $this->yiban->trade($this->session->token, 10, base_url() . '/Yiju/show_timeline/' . $userid);
                return;
            }
            else{
                //没有订阅记录就显示自己的时间轴
                $this->show_timeline($this->data['user_info']['yb_userid']);
                return;
            }
        }
        // if($this->input->get('trade_end') != 'success'){
        //     $this->yiban->trade($this->session->token, 10, base_url() . '/Yiju/timeline');
        //     return;
        // }
    }

    function show_timeline($userid){
        if($userid != $this->data['user_info']['yb_userid']){
            $this->data['other_user_info'] = $this->user->other($userid)['info'];
            $this->data['title'] = $this->data['other_user_info']['yb_username'] . '的足迹';
            $this->data['start_date'] = $this->Yiju_model->get_start_date($userid);
        }
        $subscribes = $this->Yiju_model->get_subscribe($userid);
        foreach($subscribes as $subscribe){
            // var_dump($subscribe);
            $date = date_parse($subscribe['ys_date']);
            $date = array('year' => $date['year'],
                          'month' => $date['month'],
                          'day' => $date['day']);
            $itempage = $this->get_itempage($subscribe['ys_itemid']);
            $this->data['subscribes'][] = array('itemid'         => $subscribe['ys_itemid'],
                                                'itemname'       => $subscribe['ys_itemname'],
                                                'subscribe_date' => $date,
                                                'baseinfo'       => $this->get_baseinfo($itempage),
                                                'intro'          => mb_substr($this->get_intro($itempage), 0, 50),
                                                'screenwriters'  => $this->get_screenwriter($itempage),
                                                'directors'      => $this->get_director($itempage),
                                                'starrings'      => $this->get_starring($itempage),
                                                'image'          => $this->get_image($itempage));
        }
        $this->smarty->main_view('timeline', $this->data);
    }

    function get_itemid($itemname){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.zimuzu.tv/search?keyword={$itemname}");
        $options = array(CURLOPT_RETURNTRANSFER => TRUE,
                         CURLOPT_HEADER => FALSE
                         //CURLOPT_FOLLOWLOCATION => TRUE,
                         // CURLOPT_COOKIEJAR => $this->cookie_file_path,
                         // CURLOPT_POSTFIELDS => 'account=' . urlencode($username) . '&password=' . $password . '&remember=1&url_back=http%3A%2F%2Fwww.zimuzu.tv%2F'
                    );
        curl_setopt_array($ch, $options);
        $searchpage = curl_exec($ch);
        curl_close($ch);
        $regex = '|<div\sclass="clearfix\ssearch-item">.*电视剧.*<a\shref="/resource/(.*)"><img\ssrc=".*"></a><\/div>|sU';
        $match = array();
        preg_match($regex, $searchpage, $match);
        if(!empty($match)){
            return $match[1];
        }
        else{
            return FALSE;
        }
    }

    function get_itemname($itemid){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.zimuzu.tv/resource/{$itemid}");
        $options = array(CURLOPT_RETURNTRANSFER => TRUE,
                         CURLOPT_HEADER => FALSE,
                         CURLOPT_FOLLOWLOCATION => TRUE
                         // CURLOPT_COOKIEJAR => $this->cookie_file_path,
                         // CURLOPT_POSTFIELDS => 'account=' . urlencode($username) . '&password=' . $password . '&remember=1&url_back=http%3A%2F%2Fwww.zimuzu.tv%2F'
                    );
        curl_setopt_array($ch, $options);
        $searchpage = curl_exec($ch);
        curl_close($ch);
        // echo $searchpage;
        // var_dump($searchpage);
        //这里改一下
        $regex = '|<h2\sclass="resource-tit">【.*】(.*)<label\sid="play_status">(.*)<\/label><\/h2>|sU';
        // <h2 class="resource-tit">【美剧】《权力的游戏》<label id="play_status">第6季完结</label></h2>
        $match = array();
        preg_match($regex, $searchpage, $match);
        // var_dump($match);
        if(!empty($match)){
            return $match[1];
        }
        else{
            return FALSE;
        }
    }

    function get_status($itemid){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.zimuzu.tv/resource/index_json/rid/{$itemid}/channel/tv");
        $options = array(CURLOPT_RETURNTRANSFER => TRUE,
                         CURLOPT_HEADER => TRUE,
                         // CURLOPT_FOLLOWLOCATION => TRUE
                         // CURLOPT_COOKIEJAR => $this->cookie_file_path,
                         // CURLOPT_POSTFIELDS => 'account=' . urlencode($username) . '&password=' . $password . '&remember=1&url_back=http%3A%2F%2Fwww.zimuzu.tv%2F'
                    );
        curl_setopt_array($ch, $options);
        $searchpage = curl_exec($ch);
        curl_close($ch);
        // readfile("http://www.zimuzu.tv/resource/index_json/rid/{$itemid}/channel/tv");/
        // echo $searchpage;
        var_dump($searchpage);
        // echo file_get_contents("http://www.zimuzu.tv/resource/index_json/rid/{$itemid}/channel/tv");
        //
    }

    function get_itempage($itemid){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.zimuzu.tv/resource/{$itemid}");
        $options = array(CURLOPT_RETURNTRANSFER => TRUE,
                         CURLOPT_HEADER => FALSE,
                         CURLOPT_FOLLOWLOCATION => TRUE
                         // CURLOPT_COOKIEJAR => $this->cookie_file_path,
                         // CURLOPT_POSTFIELDS => 'account=' . urlencode($username) . '&password=' . $password . '&remember=1&url_back=http%3A%2F%2Fwww.zimuzu.tv%2F'
                    );
        curl_setopt_array($ch, $options);
        $itempage = curl_exec($ch);
        // curl_close($ch);
        // var_dump($match);
        curl_close($ch);
        return $itempage;
    }

    /**
     * 获取基础信息，包括年代、类型、地区、电视台、语言、首播时间、英文名
     * @param  string $itempage 剧集主页
     * @return array
     */
    function get_baseinfo($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-info">.*<ul>.*<li><strong><span>.*<\/span>(.*)<\/strong>.*<strong\sclass="even"><span>.*<\/span>(.*)<\/strong><\/li>.*<li><strong><span>.*<\/span>(.*)<\/strong>.*<strong\sclass="even"><span>.*<\/span>(.*)<\/strong><\/li>.*<li><strong><span>.*<\/span>(.*)<\/strong>.*<strong\sclass="even"><span>.*<\/span>(.*)<\/strong><\/li>.*<li><strong><span>.*<\/span>(.*)<\/strong>.*<div\sclass="clearfix.*|sU';
        preg_match($regex, $itempage, $match);
        unset($match[0]);
        return array_values($match);
        // array_pop($match);
        // $intro = strip_tags($match[1]);
    }

    /**
     * 获取简介
     * @param  string $itempage 剧集主页
     * @return string           剧集简介
     */
    function get_intro($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-info">.*<a\shref="javascript:void\(0\)"\sclass="f2">\[展开全文\]<\/a>.*<div\sstyle="display:none;">(.*)<\/div>.*<div\sclass="clearfix.*|sU';
        preg_match($regex, $itempage, $match);
        $intro = strip_tags($match[1]);
        return $intro;
    }

    /**
     * 获取编剧
     * @param  string $itempage 剧集主页
     * @return array           编剧
     */
    function get_screenwriter($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-info">.*<li><span>編劇：<\/span>(<a.*>.*<\/a>)<\/li>.*<\/div>.*<div\sclass="clearfix.*|sU';
        preg_match($regex, $itempage, $match);
        if(empty($match)){
            return FALSE;
        }
        else{
            $screenwriter = explode(' / ', strip_tags( $match[1]));
            return $screenwriter;
        }
    }

    /**
     * 获取导演
     * @param  string $itempage 剧集主页
     * @return array           导演
     */
    function get_director($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-info">.*<li><span>导演：<\/span>(<a.*>.*<\/a>)<\/li>.*<\/div>.*<div\sclass="clearfix.*|sU';
        preg_match($regex, $itempage, $match);
        if(empty($match)){
            return FALSE;
        }
        // var_dump($match);
        else{
            $director = explode(' / ', strip_tags( $match[1]));
            return $director;
        }
    }

    /**
     * 获取主演
     * @param  string $itempage 剧集主页
     * @return array           主演
     */
    function get_starring($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-info">.*<li.*><span>主演：<\/span>(<a.*>.*<\/a>)<\/li>.*<\/div>.*<div\sclass="clearfix.*|sU';
        preg_match($regex, $itempage, $match);
        if(empty($match)){
            return FALSE;
        }
        // var_dump($match);
        else{
            $starring = explode(' / ', strip_tags( $match[1]));
            return $starring;
        }
    }

    /**
     * 获取图片
     * @param  string $itempage 剧集主页
     * @return string           图片链接
     */
    function get_image($itempage){
        $match = array();
        $regex = '|<div\sclass="fl-img">.*<p><a\shref="(.*)"\sclass="imglink"\starget="_blank">|sU';
        preg_match($regex, $itempage, $match);
        if(!empty($match)){
            return $match[1];
        }
        else{
            return FALSE;
        }
    }

    function update_subscribe(){
        $itemid = $this->input->get('itemid', TRUE);
        $status = $this->input->get('status', TRUE);
        $iteminfo['ys_itemid'] = $itemid;
        $iteminfo['ys_itemname'] = $this->get_itemname($itemid);
        $iteminfo['ys_userid'] = $this->data['user_info']['yb_userid'];
        $iteminfo['ys_username'] = $this->data['user_info']['yb_username'];
        $iteminfo['ys_date'] = date("Y-m-d h:i:s");

        if($this->Yiju_model->subscribe($iteminfo,$status)){
            if($status == 1){
                $rtn['msg'] = '已订阅';
                $rtn['status'] = 0;
            }
            else{
                $rtn['msg'] = '订阅';
                $rtn['status'] = 1;
            }
        }
        else{
            $rtn['msg'] = 'ooops';
            $rtn['status'] = 2;
        }
        echo json_encode($rtn, JSON_UNESCAPED_UNICODE);
    }

    function get_friends(){
        $friends = $this->friend->myfriends(1, 15);
        return json_encode($friends, JSON_UNESCAPED_UNICODE);
    }

    // function trade(){
    //     // var_dump($this->data['user_info']);
    //     var_dump($this->yiban->trade($this->session->token, 10, 'http://localhost/yiban/yiju/', $this->data['user_info']['yb_userid']));
    // }

}

