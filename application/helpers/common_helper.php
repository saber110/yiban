<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 心理工作重心系统通用
 *
 * @author MaCheng <376780162@qq.com>
 */

// ------------------------------------------------------------------------

if ( ! function_exists('controller_url'))
{
    /**
     * 返回当前控制器url
     * (当使用系统router变更访问地址时此方式不一定正确)
     * 
     * @param  boolean $complete 是否返回完整url
     * @return string            url
     */
    function controller_url($complete = FALSE) {
        static $url = '';
        if($url)
            return $complete ? base_url($url) : $url;

        $CI = get_instance();
        foreach($CI->uri->segments as $segment) {
            $url .= $segment . '/';
            if($segment == $CI->router->class)
                break;
        }
        return $complete ? base_url($url) : $url;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('in_power'))
{
    /**
     * 判断当前用户是否有某权限
     * 
     * @param  integer $require_power 权限id
     * @return boolean
     */
    function in_power($require_power) {
        static $power_list = array();
        if(empty($power_list)) {
            $CI = get_instance();
            $power_str = $CI->session->power;
            $power_list = explode(',', $power_str);
        }
        return in_array($require_power, $power_list);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('front_str'))
{
    /**
     * 截取字符串，默认截取前20个字符
     * @param  string  $str       字符串
     * @param  integer $words_num 每行显示的字符数
     * @return string             截取后的数据
     */
    function front_str($str, $words_num=20){
        if(! $str) return '';
        if(mb_strlen($str) > $words_num){
            $str = mb_substr($str, 0, $words_num) . '···';
        }
        return $str;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('set_document_header'))
{
    /**
     * 设置Word下载HTTP头
     * @param string $file_name 文件名 不包含后缀
     */
    function set_document_header($file_name){
        $file_name = urlencode($file_name);
        header("Content-Type: application/doc");
        header("Content-Disposition: attachment; filename=" . $file_name . ".doc");
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
    }
}
