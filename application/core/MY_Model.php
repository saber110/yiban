<?php
/**
 * 基础表模型
 * 提取于common2_m by HYR，增加set方法，修改部分函数
 * 已包含基本增删查改，其他方法陆续添加
 * @author WZR <monkeywzr@gmail.com>
 * @time 2015/12/16
 * 
 */

class MY_Model extends CI_Model{

    protected $id_name;
    protected $table_name;

    public function __construct($id = '', $table = ''){

        parent::__construct();
        $this->load->database();
        $this->id_name = $id;
        $this->table_name = $table;

    }

    /**
     * 设置表名和主键名
     * @param string $id    主键名
     * @param string $table 表名
     */
    public function set($id, $table){

        $this->id_name = $id;
        $this->table_name = $table;
    }


    /**
     * 返回表中所有数据（无条件限制）     
     * @param string $fields     查询返回的字段，例‘name,id’；默认：'*'，'*'
     * @param string $orderfield 排序的列，默认为主键
     * @param string $table 查询的表
     * @param string $order      排序方式'desc'/'ORDER_TYPE_ASC';默认：'desc'
     */
    public function all($fields='*',$orderfield='ORDER_BY_KEY',$table= '', $order='desc'){

        $this->db->select($fields);
        if($orderfield == 'ORDER_BY_KEY')
            $orderfield = $this->id_name;
        $this->db->order_by($orderfield,$order); 
        if($table == '')
            $table = $this->table_name;
        $query=$this->db->get($table);
        if(($query->num_rows())>0){   

            $result=$query->result_array();
            $query->free_result();//释放资源 
            return $result;                 
        }
        else{

            $query->free_result();
            return false;
        }
    }

    /**
     * 自定义查询返回数组
     * @param string $search      查询条件
     * @param string $orderfield  排序字段，默认：'ORDER_BY_KEY'，根据主键排序
     * @param string $fields      查询返回的字段，例‘name,id’；默然：'*'，'*'
     * @param string $order       排序方式'desc'/'ORDER_TYPE_ASC';默认：'desc'
     * @param string $tables      多表查询时附加表名，以逗号分隔
     * @return                    数组/false
     */
    public function select($search, $tables = '', $fields = '*', $orderfield = 'ORDER_BY_KEY', $order = 'desc'){
        $this->db->select($fields);
        if($orderfield == 'ORDER_BY_KEY')
            $orderfield = $this->id_name;
        $this->db->order_by($orderfield, $order); 

        if($tables == ''){

            $tables = $this->table_name;
        }

        $query = $this->db->get_where($tables,$search);
        
        if(($query->num_rows()) > 0){

            $result = $query->result_array(); 
            $query->free_result();//释放资源 
            return $result;     
        }
        else{

            $query->free_result();
            return false;
        }
    }

    /**
     * 根据查询条件返回结果集条数
     * @param string $search  查询条件
     * @param string $tables  多表查询时附加表名，以逗号分隔
     * @return                返回条数
     */
    function get_select_num($search,$tables='')
    {
        $this->db->where($search,NULL,FALSE);
        if($tables == '')
            $tables=$this->table_name;
        $this->db->from($tables);
        return $this->db->count_all_results();  
    }

    /**
     * 查询对应搜索条件的对象，返回数组某字段值（字符串）
     * @param  string $where 传入的查询的条件
     * @param  string $field 查询返回的字段，例‘name’
     * @return string/bool   字段对应值/false
     */
    function get_field($where, $field,$table=""){

        $this->db->where($where);
        if(!empty($table))
            $query=$this->db->get($table);
        else
            $query=$this->db->get($this->table_name);

        if($query->num_rows() > 0){

            $result=$query->result_array();
            $query->free_result();
            return $result[0]["$field"];
        }
        else{

            $query->free_result();
            return false;
        }
    }
    /**
     * 查询对应搜索条件的对象，返回数组某字段值（字符串）
     * @param  string $where 传入的查询的条件
     * @param  string $field 查询返回的字段，例‘name’
     * @return string/bool   字段对应值/false
     */
    function simple_select($fields='*',$where='',$table=""){
        $this->db->select($fields);
        if(!empty($where))
            $this->db->where($where);
        if(!empty($table))
            $query=$this->db->get($table);
        else
            $query=$this->db->get($this->table_name);

        if($query->num_rows() > 0){
            $result=$query->result_array();
            $query->free_result();
            return $result;
        }
        else{
            $query->free_result();
            return false;
        }
    }

    /**
     * 插入一条新数据
     * @param array $data 插入的数组
     * @return            主键id/false
     */
    function insert($data,$table='',$check_data=FALSE,$protect_key=array()){
        if(empty($table))
            $table = $this->table_name;
        if($check_data){
            if(empty($protect_key))
                $data = $this->check_data($data,$table);
            else
                $data = $this->check_data($data,$table,$protect_key);
        }      
        $this->db->insert($table,$data);
        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
    }
    /**
     * 批量插入数据
     * @param  array $data 要插入的数据，二维数组
     * @return int         受影响行数/FALSE
     */
    function insert_batch($data,$table=''){
        if(empty($table))
            $table = $this->table_name;
        $this->db->insert_batch($table,$data);
        return ($this->db->affected_rows() >= 1) ? $this->db->affected_rows() : FALSE;
    }
    
    /**
     * 根据条件删除数据库信息
     *@param  array $data  键名:字段,判断条件
     *@param  array $data  键值:查询字段所要相等的值
     *@return int          受影响行数/FALSE
     */
    function delete($data,$table=''){
        if(empty($table))
            $table = $this->table_name;
        $this->db->where($data);
        $this->db->delete($table);
        return ($this->db->affected_rows() >= 1) ? $this->db->affected_rows() : FALSE;
    }

    /**
     * 根据搜索条件更新数据
     * @param  string $search 查询条件
     * @param  array  $data   更新数组
     * @return int            受影响行数/FALSE
     */
    function update($search, $data, $table='', $check_data=FALSE, $protect_key=array()){
        if(empty($table))
            $table = $this->table_name;
        if($search)
            $this->db->where($search);
        else 
            show_404();
        if($check_data){
            if(empty($protect_key))
                $data = $this->check_data($data,$table);
            else
                $data = $this->check_data($data,$table,$protect_key);
        }  
        $this->db->update($table,$data);
        return ($this->db->affected_rows() >= 1) ? $this->db->affected_rows() : FALSE;
    }   
    /**
     * 批量更新
     * @param  array  $data  要更新的数组，包括查询条件
     * @param  string $filed 查询条件规定的字段
     * @return int           受影响行数/FALSE
     */
    function update_batch($data, $filed,$table=''){
        if(empty($table))
            $table = $this->table_name;
        $this->db->update_batch($table,$data,$filed);
        return ($this->db->affected_rows() >= 1) ? $this->db->affected_rows() : FALSE;
    }
    /**
     * 用于显示分页数据
     * @param $search  键名:字段,判断条件;键值:查询字段所要相等的值.也可为自定义查询语句，如：(`nid`  >  '1' AND `ntitle` LIKE '%2%')
     * @param $num     每页显示个数
     * @param $offset  查询开始位置
     * @param $tables  多表查询时，传入的表,中间以逗号相隔
     * 返回值：数组/false
     *
     */
    function page($num,$offset,$search='',$orderfield='0',$order='desc',$fields='*',$tables='')
    {
        $this->db->select($fields);
        if($orderfield=='0')
            $orderfield=$this->table_name.'.'.$this->id_name;
        $this->db->order_by($orderfield, $order);
        if($tables!='')
        {
            if($this->table_name != ''){
                $tables=$this->table_name.",{$tables}";
            }
        }
        else
            $tables=$this->table_name;
        if($search!=''&&is_numeric($num)&&is_numeric($offset))
            $query=$this->db->get_where($tables,$search,$num,$offset);
        elseif($search==''&&is_numeric($num)&&is_numeric($offset))
            $query=$this->db->get($tables,$num,$offset);
        else
            show_404();
        if($query->num_rows()>0)
        {
            $result=$query->result_array();
            $query->free_result();
            return $result;
        }
        else
        {
            $query->free_result();
            return false;
        }
    }

    function get_follow_list($where, $page, $num=20)
    {
        $query = $this->db->select('follow_id,B.case_id,report,interview,plan,
                create_time,s_attention_follow.commit_time,follow_stage,
                if_commit,new_star,stu_number,sname')
            ->from('s_attention_follow')
            ->join('s_attention_case AS B', 'B.case_id=s_attention_follow.case_id')
            ->join('s_student', 'sid=stu_id')
            ->where($where)
            ->limit($num, ($page-1)*$num)
            ->order_by('create_time', 'desc')
            ->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    /**
     * 综合查询获取分页数据
     * @param  string               $fields     要获取的字段
     * @param  string               $from_table 主表
     *  
     * @param  string/array         $search     查询条件,用法如下
     *                              $search['where']=array('name'=>'Lin','sex'=>'man');
     *                              $search['or_where']=array('name'=>'Lin','sex'=>'man');
     *                              $search['like']=array('name'=>'Lin','sex'=>'man');
     *                              $search['or_like']=array('name'=>'Lin','sex'=>'man');;
     *                              $search[where_in]=('key'=>'name','value'=>"'lin','chen','liu'");
     *                              
     * @param  string               $page       页数
     * @param  integer              $num        分页数目
     * 
     * @param  array                $order_by   排序的条件,用法如下
     *                              $order_by['order_key']='user_id';
     *                              $order_by['direction']='asc'; 
     *                              多种情况可使用一维关联数组如$order_by[0]['order_key']，$order_by[1]['order_key']
     *                                      
     * @param  array                $join       连表查询的条件，用法如下
     *                              $join['table']='user' 
     *                              $join['direction']='user.type_id=user_type.type_id' 
     *                              多种情况可使用一维关联数组             
     *                              
     * @return 查询结果集
     */
    public function get_page($fields="*",$from_table="",$search="",$page="",$num=10,$order_by=array(),$join=array()){
        if(empty($from_table))
            $from_table = $this->table_name;
        //获取的字段
        $this->db->select($fields);
        //主表
        $this->db->from($from_table);
        //查询条件
        if(!empty($search)){
            if(is_string($search))
                $this->db->where($search);
            elseif(is_array($search)){
                if (!empty($search['like'])) {
                    $this->db->like($search['like']);
                }
                if (!empty($search['or_like'])) {
                    $this->db->or_like($search['or_like']);
                }
                if (!empty($search['where'])) {
                    $this->db->where($search['where']);
                }
                if (!empty($search['or_where'])) {
                    $this->db->or_where($search['or_where']);
                }
                if (!empty($search['where_in'])) {
                    $this->db->where_in($search['where_in']['key'],$search['where_in']['value']);
                }
            }
        }
        //获取分页数据
        if(!empty($page)&&is_numeric($page))
            $this->db->limit($num, ($page-1)*$num);
        //排序方式
        if(!empty($order_by)){
            if(!empty($order_by['order_key'])&&!empty($order_by['direction'])){
                $this->db->order_by($order_by['order_key'],$order_by['direction']);
            }elseif(!empty($order_by[0]['order_key'])){
                foreach ($order_by as $row) {
                    $this->db->order_by($row['order_key'],$row['direction']);
                }
            }
        }
        //连表
        if(!empty($join)){
            if(!empty($join['table'])&&!empty($join['cond']))
                $this->db->join($join['table'],$join['cond']);
            elseif(!empty($join[0]['table'])&&!empty($join[0]['cond'])){
                foreach ($join as $row) {
                    $this->db->join($row['table'],$row['cond']);
                }
            }
        }
        $query=$this->db->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;      
    }
    /**
     * 查询对应id的对象，返回数组
     * @param int    $id     传入的查询的值
     * @param string $table  表名，为空时则查询当前表
     * @param string $fields 查询返回的字段，例‘name,id’；默然：SEARCH_ALL_FIELD，'*'
     * @return 数组/false
     * @example 返回数组示例<br/>
     * array('id'=>'1','name'=>'xxx');
     */
    function select_by_id($id,$fields="*",$table='')
    {   
        if(empty($table))
            $table = $this->table_name;
        if(is_numeric($id) && $id)
        {
            $this->db->select($fields);
            $this->db->where($this->id_name,$id);
        }elseif (is_array($id)&&!empty($id['name'])&&!empty($id['value'])) {
            $this->db->select($fields);
            $this->db->where($id['name'],$id['value']);
        }          
        else 
            return FALSE;
        $query=$this->db->get($table);
        if($query->num_rows()>0)
        {
            $result=$query->result_array();
            $query->free_result();
            return $result[0];
        }
        else
        {
            $query->free_result();
            return FALSE;
        }
    }

    /**
     * 获取一行
     * @param  array  $where 检索条件
     * @param  string $table 表名
     * @param  string $field 检索字段 默认全部
     * @return array         一行数据关联数组
     */
    function get_row($where, $table='', $field='') {
        $this->db->where($where);
        if($field)
            $this->db->select($field);
        if($table)
            $query = $this->db->get($table);
        else
            $query = $this->db->get($this->table_name);
        if($query->num_rows() < 1)
            return array();
        $result = $query->row_array();

        return $result;
    }

    /**
     * 检查要插入/更改的数组，返回安全可靠的数组
     * 能有效防止CI框架利用键值注入的漏洞
     * @param  srting $array       要插入的值
     * @param  string $table       表名
     * @param  array  $protect_key 不让修改的键名 array('user_id','rank_id');
     * @return array
     */
    public function check_data($post,$table='',$protect_key=array()){
        //获取所有字段名
        $fields = $this->db->list_fields($table);
        //去除保护键
        if(!empty($protect_key))
            $fields= array_diff($fields,$protect_key);
        $data = array();
        //取能用
        foreach ($fields as $key => $value) {
            foreach ($post as $post_key => $post_value) {
                if($value==$post_key){
                    $data["$post_key"] =  $post_value;
                    unset($post["$post_key"]);
                }
            }
        }
        // //去掉保护键
        // if(!empty($protect_key)){
        //     foreach ($protect_key as $key => $value) {
        //         foreach ($data as $data_key => $data_value) {
        //             if($data_key==$value){
        //                 unset($data["$data_key"]);
        //             }
        //         }
        //     }
        // }
        return $data;
    }

    /**
     * 获取系统设置值
     * @param  string $setting_key 系统设置键
     * @return ar
     */
    public function get_setting($setting_key){       
        return $this->get_field(array('setting_key'=>$setting_key),'value','settings');
    } 

    /**
     * 获取某字段值
     * @param $field
     *      String 查询字段
     * @param $where
     *      array() 查询条件
     * @param $table
     *      String 查询表，默认当前表
     * @return
     *      String 字段值或空
     */
    function select_field($field, $where, $table='')
    {
        $this->db->select($field);
        $this->db->where($where);
        if($table)
            $query = $this->db->get($table);
        else
            $query = $this->db->get($this->_table);
        if($query->num_rows() < 1)
            return '';
        $result = $query->row_array();

        if(strpos($field, ','))
            return $result;
        return $result[$field];
    }
    
    /**
     * 选取全部
     * @param  string $table 表名
     * @return array         全部内容
     */
    function select_all($table)
    {
        $query = $this->db->get($table);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    /**
     * 获取个数
     * @param  string   $table 表名
     * @param  array    $where 筛选条件
     * @return integer         继次工作个数
     */
    function get_count($table, $where=array())
    {
        $this->db->from($table);
        if(!empty($where))
            $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 获取该圈是否需要审核
     * @param  string $setting_key 设置表的key
     * @return string              0代表不审核，所有信息可以显示
     *                             1代表需要审核，未审核的信息不能显示
     *                             2代表不需要审核，但是会显示【已审核】、【未审核】
     */
    function get_value($setting_key){
        $where = array(
            'setting_key'=>$setting_key
            );
        return $this->get_field($where,'value','settings');
    }

    /**
     * 判断用户是否具有该控制器的权限
     * @param  string  $controller 控制器名称
     * @param  integer $type_id    用户角色类型
     * @return [type] [description]
     */
    function check_power($controller,$type_id=''){
        if(!is_numeric($type_id))
            $type_id = $this->session->type_id;
        if(!empty($type_id)&&is_numeric($type_id)){
            $like = array(
                'power_list'=>'|'.$controller.'|'
                );
            $where = array(
                'type_id'=>$type_id
                );
            $query = $this->db->select('type_id,power_list')
                ->from('user_type')
                ->like($like)
                ->where($where)
                ->get();
            $result = $query->row_array();
            if($result)
                return TRUE;
            else return FALSE;
        }
        return FALSE;
    }

    /**
     * 更新自增
     * @param  inte   $num         要增加的数目
     * @param  string $filed       要更新的字段
     * @param  string $table       表名
     * @param  array  $where       查询条件
     * @return 影响个数/FALSE      
     */
    function update_self_add($field,$table,$where,$num=1){
        $this->db->set($field, "$field+$num",FALSE);
        $this->db->where($where);
        $this->db->update($table);
        return ($this->db->affected_rows() >= 1) ? $this->db->affected_rows() : FALSE;
    }
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
