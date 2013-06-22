<?php
/**
 * sinhs.
 * users - model
 * User: mochammad c. chuluq
 * Date: 25/05/13
 * Time: 21:52
 * Chraven Systems dev. labs.
 */
class Users_model extends CI_Model{
    private $user_table = 'user_member';
    private $grup_table = 'user_group';
    private $user_pk = 'user_id';
    private $fp_table = 'tbl_fakultas_prodi';

    private $mhs_view = 'view_user_mahasiswa';

    private $mhs_table = 'tbl_mahasiswa';

    private $dsn_table = 'tbl_dosen';

    private $dsn_view = 'view_user_dosen';

    function __construct() {
        parent::__construct();
    }

    function getUsersList($offset=0,$limit=10,$search=null){
        $this->db->order_by($this->user_pk,'desc');
        if(!empty($search)){
            $this->db->like('user_name',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_meta',$search,'both');
            $this->db->or_like('user_code',$search,'both');
            $this->db->or_like('group_name',$search,'both');
        }
        $query = $this->db->get($this->user_table,$limit,$offset);
        return $query->result_array();
    }
    function getMahasiswaList($offset=0,$limit=10,$search=null){
        $this->db->order_by($this->user_pk,'desc');
        if(!empty($search)){
            $this->db->like('user_name',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_code',$search,'both');
            $this->db->or_like('mhs_fak_prodi',$search,'both');
            $this->db->or_like('mhs_angkatan',$search,'both');
            $this->db->or_like('mhs_program',$search,'both');
        }
        $query = $this->db->get($this->mhs_view,$limit,$offset);
        return $query->result_array();
    }
    function getDosenList($offset=0,$limit=10,$search=null){
        $this->db->order_by($this->user_pk,'desc');
        if(!empty($search)){
            $this->db->like('user_name',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('dsn_alamat',$search,'both');
            $this->db->or_like('user_code',$search,'both');
        }
        $query = $this->db->get($this->dsn_view,$limit,$offset);
        return $query->result_array();
    }

    function countUsers($search=null){
        if(!empty($search)){
            $this->db->like('user_name',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_meta',$search,'both');
            $this->db->or_like('user_code',$search,'both');
            $this->db->or_like('group_name',$search,'both');
        }
        $this->db->from($this->user_table);
        return $this->db->count_all_results();
    }
    function countMahasiswa($search=null){
        if(!empty($search)){
            $this->db->like('user_name',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_code',$search,'both');
            $this->db->or_like('mhs_fak_prodi',$search,'both');
            $this->db->or_like('mhs_angkatan',$search,'both');
            $this->db->or_like('mhs_program',$search,'both');
        }
        $query = $this->db->get($this->mhs_view);
        return $query->num_rows();
    }
    function countDosen($search=null){
        if(!empty($search)){
            if(!empty($search)){
                $this->db->like('user_name',$search,'both');
                $this->db->or_like('user_full_name',$search,'both');
                $this->db->or_like('dsn_alamat',$search,'both');
                $this->db->or_like('user_code',$search,'both');
            }
        }
        $query = $this->db->get($this->dsn_view);
        return $query->num_rows();
    }

    function getGroupList(){
        $this->db->select('group_name');
        $query = $this->db->get($this->grup_table);
        return $query->result_array();
    }

    function addUser($data){
        $this->db->insert($this->user_table,$data);
    }
    function addDosen($data_dsn){
        $this->db->insert($this->dsn_table,$data_dsn);
    }
    function getSingleUser($id){
        $query = mysql_query("SELECT * FROM user_member WHERE user_id = $id");
        return mysql_fetch_array($query);
    }
    function getSingleDosen($id){
        $query = mysql_query("SELECT * FROM ".$this->dsn_view." WHERE user_id = $id");
        return mysql_fetch_array($query);
    }
    function getSingleMhs($id){
        $query = mysql_query("SELECT * FROM ".$this->mhs_view." WHERE user_id = $id");
        return mysql_fetch_array($query);
    }
    function updateUser($data){
        $this->db->where($this->user_pk, $data['user_id']);
        $this->db->update($this->user_table, $data);
    }
    function updateDosen($data){
        $this->db->where('dsn_nip', $data['dsn_nip']);
        $this->db->update($this->dsn_table, $data);
    }
    function updateMhs($data){
        $this->db->where('mhs_nim', $data['mhs_nim']);
        $this->db->update($this->mhs_table, $data);
    }
    function deleteUser($id){
        $this->db->where($this->user_pk, $id);
        if($this->db->delete($this->user_table)){
            return TRUE;
        }else{
            return FALSE;
        };
    }

    function changeStatus($id){
        $check = mysql_query("SELECT user_status FROM user_member WHERE user_id='$id'");
        $status = mysql_fetch_array($check);
        switch ($status['user_status']){
            case "1" :
                $query = mysql_query("UPDATE user_member SET user_status = '0' WHERE user_id='$id'");
                break;
            case "0" :
                $query = mysql_query("UPDATE user_member SET user_status = '1' WHERE user_id='$id'");
                break;
        }
        if($query){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    function getFpList(){
        $query = $this->db->get($this->fp_table);
        return $query->result_array();
    }
    function addMahasiswas($datausers,$datamhs){
        $value_users = "(".implode("), (", $datausers).")";
        $value_mhs = "(".implode("), (", $datamhs).")";
        $this->db->query("INSERT INTO ".$this->user_table." (user_name, user_full_name, user_pass, group_name, user_code) VALUES ".$value_users.";");
        $this->db->query("INSERT INTO ".$this->mhs_table." (mhs_nim, mhs_fak_prodi, mhs_angkatan, mhs_program) VALUES ".$value_mhs.";");
    }
}