<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 邮件封装
 * @author hhb huhaobin110@gmail.com
 */
class Email extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('My_email');
  }

  public function send($subject="hello",$message="test",$user="中南易班",$to="huhaobin110@gmail.com",$from="hhb@csuyiban.net")
  {
    $subject=$this->input->post()['ContactName'];
    $email = $this->input->post()['ContactEmail'];
    $message = $this->input->post()['ContactComment'];
    $this->my_email->send($to,$subject,$message,$from,$user); 
	echo "<script>alert('你的老板收到了');history.go(-1);</script>";
  }
}
