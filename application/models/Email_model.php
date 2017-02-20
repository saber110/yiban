<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends MY_Model{
	
	public function __construct()
	{
		parent::__construct();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.exmail.qq.com';
		$config['smtp_user'] = 'hhb@csuyiban.net';
		$config['smtp_pass'] = 'HHByiban2016';
		$config['mailtype'] = 'html';
		$config['validate'] = true;
		$config['priority'] = 1;
		$config['crlf'] = "\r\n";
		$config['newline']="\r\n";
		$config['smtp_port'] = 465;
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;

		$this->load->library('email',$config);
		// $this->email->initialize($config);
		// var_dump("expression");
		// exit();
	}


	public function send($to,$subject,$message,$from="hhb@csuyiban.net",$user="hhb")
	{

		$this->email->from($from, $user);
		$this->email->to($to);
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
		echo $this->email->print_debugger();

	}
}