<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Smarty Class
*
* 移植于心理健康工作系统MC版本
* 根据Kepler Gelotte版本修改
*
* @package    CodeIgniter
* @subpackage Libraries
* @category   Smarty
* @author     WZR <monkeywzr@gmail.com>
*/

require_once( APPPATH.'third_party/smarty-3.1.29/libs/Smarty.class.php' );

class Use_smarty extends Smarty {

    public function __construct($params)
    {
        parent::__construct();

        $this->compile_dir = APPPATH . "views/temp";
        $this->template_dir = APPPATH . "views/{$params['app']}";
        $this->assign( 'APPPATH', APPPATH );
        $this->assign( 'BASEPATH', BASEPATH );

        // Assign CodeIgniter object by reference to CI
        if ( method_exists( $this, 'assignByRef') )
        {
            $CI =& get_instance();
            $this->assignByRef("CI", $CI);
        }
    }


    /**
    *  Parse a template using the Smarty engine
    *
    * This is a convenience method that combines assign() and
    * display() into one step.
    *
    * Values to assign are passed in an associative array of
    * name => value pairs.
    *
    * If the output is to be returned as a string to the caller
    * instead of being output, pass true as the third parameter.
    *
    * @access    public
    * @param     string
    * @param     array
    * @param     bool
    * @return    string
    */
    public function view($template, $data = array(), $return = FALSE)
    {
        $file = $template . '.php';
        foreach ($data as $key => $val)
        {
            $this->assign($key, $val);
        }

        if (! $return)
        {
            $CI =& get_instance();
            $CI->output->append_output( $this->fetch($file) );
            return;
        }
        else
        {
            return $this->fetch($file);
        }
    }

    /**
     * 加载前端界面
     * 自动加载头文件
     * @param  string  $template 模板名
     * @param  array   $data     绑定变量
     * @param  boolean $return   是否返回输出结果
     * @return mix               输出结果或者不返回
     */
    public function main_view($template, $data = array(), $return = FALSE)
    {
        if ($return)
        {
            $output = $this->view('header', $data, TRUE);
            $output .= $this->view($template, $data, TRUE);
            $output = $this->view('footer', $data, TRUE);
            return $output;
        }
        else
        {
            $this->view('header', $data);
            $this->view($template, $data);
            $this->view('footer', $data);
        }
    }

    public function main_view_all($template, $data = array(), $return = FALSE)
    {
        if ($return)
        {
            $output .= $this->view($template, $data, TRUE);
            return $output;
        }
        else
        {
            $this->view($template, $data);
        }
    }
}
// END Smarty Class
