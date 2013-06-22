<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * UAC - User Access Control
 * User: mochammad c. chuluq
 * Date: 13/05/13
 * Time: 18:43
 * custom CI lib for Controlling Access for User
 */

class Uac {

    public $openAccess = array('dashboard','account','welcome','about');
    public $group_tbl = 'user_group';
    public $user_tbl = 'user_member';

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->helper('date');
    }

    private function _update_logdata($id){
        $data = array('user_last_login'=>date('Y-m-d'));
        $this->CI->db->where('user_id', $id);
        $this->CI->db->update('user_member', $data);
    }

    function login($user,$pass){
        $epass = $this->encrypt($pass);
        $query = $this->CI->db->get_where($this->user_tbl,array('user_name'=>$user,'user_status'=>'1'),1);
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            if($row->user_pass == $epass){
                $passNotChanged= ($this->encrypt($row->user_code) == $row->user_pass) ? TRUE : FALSE;
                $userNameNotChanged= ( $row->user_code == $row->user_name) ? TRUE : FALSE;
                $emptyEmail= (empty($row->user_email)) ? TRUE : FALSE;
                $emptyContact= (empty($row->user_contact)) ? TRUE : FALSE;

                $log_data = array(
                    'log_status'=>TRUE,
                    'user_name'=>$row->user_name,
                    'user_id'=>$row->user_id,
                    'user_full_name'=>$row->user_full_name,
                    'group_name'=>$row->group_name,
                    'login_since'=>now(),
                    'user_bg'=>$row->user_bg,

                    'allowToAccess'=>$this->allowToAccess($row->group_name),
                    'passNotChanged'=>$passNotChanged,
                    'userNameNotChanged'=>$userNameNotChanged,
                    'emptyEmail'=>$emptyEmail,
                    'emptyContact'=>$emptyContact
                );
                $this->CI->session->set_userdata($log_data);
                $this->_update_logdata($row->user_id);
                return TRUE;
            }else{ return FALSE; }
        }else{ return FALSE; }
    }
    function logout(){
        $this->CI->session->sess_destroy();
    }
    function encrypt($string){
        return hash("haval256,5",$this->CI->config->item('encryption_key').md5($string));
    }
    function is_login(){
        return (($this->CI->session->userdata('log_status')) ? TRUE : FALSE);
    }
    function allowToAccess($group){
        $query = $this->CI->db->query("SELECT a.menu_access FROM user_access a WHERE a.group_name = '$group'");
        return $query->result_array();
    }
    function groupAccess($group){
        $query = $this->CI->db->query("SELECT a.menu_access,a.access_id,b.menu_title FROM user_access a,user_menu b WHERE a.group_name = '$group' AND a.menu_access = b.menu_access");
        return $query->result_array();
    }
    function validate(){
        $allow = array();
        $class = $this->CI->uri->rsegment(1); //first segment or one segment
        $method = $this->CI->uri->rsegment(2); //second segment
        $param = $this->CI->uri->rsegment(3); //third segment
        $twosegments = $class.'/'.$method; //with two segment
        $threesegments = $class.'/'.$method.'/'.$param; //with three segments
        foreach ($this->CI->session->userdata('allowToAccess') as $row){
            $allow[] =  $row['menu_access'];
        }
        return ((in_array($class,$this->openAccess) || in_array($class,$allow) || in_array($twosegments,$allow) || in_array($threesegments,$allow)) ? TRUE : FALSE );
    }
    function buildMenu($group){
        ob_start();
        $uls=mysql_query("SELECT DISTINCT(a.menu_class) FROM user_menu a, user_access b WHERE a.menu_access = b.menu_access AND b.group_name = '$group'");
        while($ul=mysql_fetch_array($uls)){?>
            <div class="ch-aside-sub">
                <h3><?php echo $ul['menu_class']?></h3>
                <ul>
                    <?php
                    $lis = mysql_query("SELECT a.menu_access,b.menu_title FROM user_access a,user_menu b WHERE a.group_name = '$group' AND a.menu_access = b.menu_access AND b.menu_show = '1' AND b.menu_class = '".$ul['menu_class']."'");
                    while($li=mysql_fetch_array($lis)){?>
                        <li><a href="<?php echo base_url($li['menu_access'])?>"><?php echo $li['menu_title']?></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php }
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
}