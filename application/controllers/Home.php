<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    function __construct(){
        parent::__construct();
        $params = array('app' => 'home');
        $this->load->library('Use_smarty', $params, 'smarty');
    }

    function index(){
        $data['title'] = '易家';
        $this->smarty->main_view('index', $data);
    }

    function about(){
        $data['title'] = '关于我们';
        $this->smarty->main_view('about',$data);
    }
}
