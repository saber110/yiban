<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 客服机器人
* author 胡皓斌 huhaobin110@gmail.com
*/
class Chat extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    // $this->load->view("chat/test",$data);
    $this->load->view("chat/header");
    $this->load->view("chat/index");
    $this->load->view("chat/footer");
  }

  public function reply()
  {
    $key="573997e2a06a443fa2c073ae457a6931";
    $tuling = str_replace(' ','',$this->input->get("message"));
    echo json_decode(file_get_contents("http://www.tuling123.com/openapi/api?key=".$key."&info=$tuling"))->{'text'};
  }
}
