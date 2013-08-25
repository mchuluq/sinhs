<?php
/**
 * sinhs.
 * account model - pengolah data akun
 * User: mochammad c. chuluq
 * Date: 04/06/13
 * Time: 22:02
 * Chraven Systems dev. labs.
 */
class Account_model extends CI_Model{
    private $user_tbl = 'user_member';

    function __construct(){
        parent::__construct();
    }

    function getAccountData(){
        $query = $this->db->get_where($this->user_tbl,array('user_id'=>$this->session->userdata('user_id')),1);
        return $query->row();
    }

    function updateData($data){
        $select = $this->db->get_where($this->user_tbl,array('user_id'=>$data['user_id']));
        if ($select->num_rows() != 0)
        {
            return '0';
        }else{
            $this->db->where('user_id', $data['user_id']);
            $this->db->update($this->user_tbl, $data);
            return '1';
        }

    }
    function updateSession($data){
        $log_data = array(
            'user_name'=>$data['user_name']
        );
        $this->session->set_userdata($log_data);
    }
    function checkPass($id,$pass){
        $query = $this->db->get_where($this->user_tbl,array('user_id'=>$id),1);
        $row = $query->row();
        if($row->user_pass == $this->uac->encrypt($pass)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function checkDefaultData($id){
        $query = $this->db->get_where($this->user_tbl,array('user_id'=>$id),1);
        $row = $query->row();

        $passNotChanged= ($this->uac->encrypt($row->user_code) == $row->user_pass) ? TRUE : FALSE;
        $userNameNotChanged= ( $row->user_code == $row->user_name) ? TRUE : FALSE;
        $emptyEmail= (empty($row->user_email)) ? TRUE : FALSE;
        $emptyContact= (empty($row->user_contact)) ? TRUE : FALSE;

        $log_data = array(
            'passNotChanged'=>$passNotChanged,
            'userNameNotChanged'=>$userNameNotChanged,
            'emptyEmail'=>$emptyEmail,
            'emptyContact'=>$emptyContact
        );
        $this->session->set_userdata($log_data);
    }
    function changeBg($id,$bg){
        $this->db->where('user_id', $id);
        $this->db->update($this->user_tbl, array('user_bg'=>$bg));
        $log_data = array(
            'user_bg'=>$bg
        );
        $this->session->set_userdata($log_data);
    }
}