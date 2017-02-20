<?php defined('BASEPATH') OR exit('No direct script access allowed');



//没用上，因为怎么搞也不执行钩子，不知道咋回事
class YBAuthorize{

    function __construct() {
        $this->CI = &get_instance();
    }

    function authorize(){
        if(!$this->CI->session->token){
            redirect('http:///www.baidu.com');
        }
    }
}
