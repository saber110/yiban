<?php

/**
 * application/libraries/My_email.php
 * 邮件封装
 * @author hhb huhaobin110@gmail.com
 * @date 2016/10/21
 */

class My_email{
    private $CI;
    public function __construct()
    {
        // parent::__construct();
        $this->CI =& get_instance();
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

        $this->CI->load->library('email',$config);
        // $this->email->initialize($config);
    }


    public function send($to,$subject,$message,$from="hhb@csuyiban.net",$user="中南易班")
    {

        $this->CI->email->from($from, $user);
        $this->CI->email->to($to);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');

        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        $this->CI->email->send();
        echo $this->CI->email->print_debugger();

    }
}
