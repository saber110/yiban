<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 易班SDK接入
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   yibanSDK
 * @author WZR <monkeywzr@gmail.com>
 * @date 2016/6/26
 */

require_once( APPPATH.'third_party/yibansdk/yb-globals.inc.php' );

class YibanSDK{

    public $YBOpenApi;
    public $YBException;

    function __construct($config=NULL){
        if(is_array($config) && !empty($config)){
            $this->YBOpenApi = YBOpenApi::getInstance()->init($config['appID'], $config['appSecret'], $config['callback']);
        }
    }

    public function init($config){
        $this->YBOpenApi = YBOpenApi::getInstance()->init($config['appID'], $config['appSecret'], $config['callback']);
    }

    public function getAuthorize(){
        if($this->YBOpenApi)
            return $this->YBOpenApi->getAuthorize();
    }

    public function getFrameUtil(){
        if($this->YBOpenApi)
            return $this->YBOpenApi->getFrameUtil();
    }	
	
    public function getUser($token){
        if($token){
            $this->YBOpenApi = YBOpenApi::getInstance()->bind($token);
            return $this->YBOpenApi->getUser();
        }
    }
}
