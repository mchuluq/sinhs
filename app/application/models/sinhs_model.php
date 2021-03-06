<?php
/**
 * sinhs.
 * sinhs - model
 * User: mochammad c. chuluq
 * Date: 07/06/13
 * Time: 18:40
 * Chraven Systems dev. labs.
 */
class Sinhs_model extends CI_Model{
    //private property for table name

    private $mk_tbl = 'tbl_matkul';
    private $mk_pk = 'mk_id';
    private $mk_v = 'view_matkul';
    private $mk_hmhs = 'view_matkul_hmhs';

    private $frs_tbl = 'tbl_frs';
    private $frs_pk = 'frs_id';
    private $frs_v = 'view_frs';

    private $fp_tbl = 'tbl_fakultas_prodi';
    private $user_tbl = 'user_member';
    private $user_pk = 'user_id';

    private $frs_matkul_v = 'view_frs_matkul';

    private $khs_detail_v = 'view_khs_detail';

    private $mhs_view = 'view_user_mahasiswa';

    function __construct(){
        parent::__construct();
    }

    // Method Umum untuk berbagai keperluan
    function getFpList(){
        $query = $this->db->get($this->fp_tbl);
        return $query->result_array();
    }
    function getDsnTypeahead(){
        $data= array();
        $this->db->select('user_full_name');
        $this->db->where('group_name','dosen');
        $query = $this->db->get($this->user_tbl);
        foreach($query->result_array() as $dsn):
            $data[] = '"'.$dsn['user_full_name'].'"';
        endforeach;
        return $data;
    }

    function getMhsProfile($id){
        $query = mysql_query("SELECT * FROM ".$this->mhs_view." WHERE ".$this->user_pk." = $id");
        $data =  mysql_fetch_array($query);
        //$meta = explode('|',$data['user_meta']);
        $user['user_id'] = $data['user_id'];
        $user['user_name'] = $data['user_name'];
        $user['user_full_name'] = $data['user_full_name'];
        $user['nim'] = $data['user_code'];

        $user['fak_prod'] = $data['mhs_fak_prodi'];
        $user['thn_angkatan'] = $data['mhs_angkatan'];
        $user['program'] = $data['mhs_program'];
        return $user;
    }

    function getLastSemester($user_id){
    	$query = mysql_query("SELECT MAX(frs_semester) AS max_frs, MAX(frs_thn_ajar) AS max_thn_ajar FROM ".$this->frs_v." WHERE user_id = '$user_id' LIMIT 0, 1");
    	$data = mysql_fetch_array($query);
    	if($data['max_frs'] == null){
    		$mhs = $this->getMhsProfile($user_id);
    		$thn2 = $mhs['thn_angkatan'] + 1;
    		
    		$re['smtr'] =  0;
    		$re['thn_ajar'] = $mhs['thn_angkatan']."/".$thn2;
    	}else{
    		$re['smtr'] =  $data['max_frs'];
    		$re['thn_ajar'] = $data['max_thn_ajar'];
    	}    	
    	return $re;
    }
    
    //function getNextThnAjaran()
    
    function getNextSemester($user_id){
    	$ls = $this->getLastSemester($user_id);
    	if($ls['smtr'] == 0){
    		$re['smtr'] = 1;
    		$re['thn_ajar'] = $ls['thn_ajar'];
    	}elseif($ls['smtr'] == 2 OR $ls['smtr'] == 4 OR $ls['smtr'] == 6){
    		$thn_ajar = explode("/",$ls['thn_ajar']);
    		$thn_1 = $thn_ajar[0] + 1;
    		$thn_2 = $thn_ajar[1] + 1;
    		
    		$re['smtr'] = $ls['smtr'] + 1;
    		$re['thn_ajar'] = $thn_1."/".$thn_2;
    	}elseif($ls['smtr'] == 1 OR $ls['smtr'] == 3 OR $ls['smtr'] == 5 OR $ls['smtr'] == 7){
    		$re['smtr'] = $ls['smtr'] + 1;
    		$re['thn_ajar'] = $ls['thn_ajar'];
    	}else{
    		$re['smtr'] = null;
    		$re['thn_ajar'] = null;
    	}
    	return $re;
    }
    
    // Model untuk controller matakuliah

    function getMkGrouped($offset=0,$limit=10,$search=null){
        $this->db->order_by('mk_grup','desc');
        if(!empty($search)){
            $this->db->like('mk_grup',$search,'both');
            $this->db->or_like('mk_semester',$search,'both');
            $this->db->or_like('mk_thn_ajar',$search,'both');
            $this->db->or_like('mk_fak_prod',$search,'both');
        }
        $query = $this->db->get($this->mk_v,$limit,$offset);
        return $query->result_array();
    }
    function countMkGrouped($search=null){
        if(!empty($search)){
            $this->db->like('mk_grup',$search,'both');
            $this->db->or_like('mk_semester',$search,'both');
            $this->db->or_like('mk_thn_ajar',$search,'both');
            $this->db->or_like('mk_fak_prod',$search,'both');
        }
        $this->db->from($this->mk_v);
        return $this->db->count_all_results();
    }
    function getMkDetail($mk_grup){
        $query =$this->db->get_where($this->mk_tbl,array('mk_grup'=>$mk_grup));
        return $query->result_array();
    }

    function insertMk($multi){
        $data = array();
        foreach($multi as $key=>$value) {
            $data[] = "'".implode("', '", $value)."'";
        }
        $values = "(".implode("), (", $data).")";
        $this->db->query("INSERT INTO ".$this->mk_tbl." (mk_grup,mk_semester,mk_thn_ajar,mk_fak_prod,mk_kode,mk_nama,mk_sks,mk_dosen) VALUES ".$values.";");
    }

    function getSingleMk($id){
        $query = mysql_query("SELECT * FROM ".$this->mk_tbl." WHERE ".$this->mk_pk." = $id");
        return mysql_fetch_array($query);
    }

    function updateMk($data){
        $this->db->where($this->mk_pk,$data['mk_id']);
        $this->db->update($this->mk_tbl,$data);
    }
    function deleteMk($id){
        $this->db->where($this->mk_pk,$id);
        $this->db->delete($this->mk_tbl);
    }

    function getListThnAjar(){
        $query = $this->db->query("SELECT DISTINCT(mk_thn_ajar) AS mk_thn_ajar FROM ".$this->mk_v."");
        return $query->result_array();
    }

    function sebaranMK($thn_ajar,$fp,$gg){
        $this->db->order_by('mk_semester','asc');
        $this->db->like('mk_grup',$gg);
        $query = $this->db->get_where($this->mk_tbl,array(
            'mk_thn_ajar'=>$thn_ajar,
            'mk_fak_prod'=>$fp
        ));
        return $query->result_array();
    }

    //model untuk controller FRS
    function getMkFor($semester,$thn_ajar,$fak_prod){
        $where = array('mk_semester'=>$semester,'mk_thn_ajar'=>$thn_ajar,'mk_fak_prod'=>$fak_prod);
        $this->db->where($where);
        $query = $this->db->get($this->mk_tbl);
        return $query->result_array();
    }
    function insertFrs($multi){
        $data = array();
        foreach($multi as $key=>$value) {
            $data[] = "'".implode("', '", $value)."'";
        }
        $values = "(".implode("), (", $data).")";
        $this->db->query("INSERT INTO ".$this->frs_tbl." (frs_grup,frs_semester,frs_thn_ajar,frs_fak_prod,frs_pemb_akad,frs_keterangan,mk_id,user_id) VALUES ".$values.";");
    }
    function getFrsGrouped($offset=0,$limit=10,$search=null){
        $this->db->order_by('frs_semester','desc');
        if(!empty($search)){
            $this->db->like('frs_grup',$search,'both');
            $this->db->or_like('frs_semester',$search,'both');
            $this->db->or_like('frs_thn_ajar',$search,'both');
            $this->db->or_like('frs_fak_prod',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_code',$search,'both');
        }
        $query = $this->db->get($this->frs_v,$limit,$offset);
        return $query->result_array();
    }
    function countFrsGrouped($search=null){
        if(!empty($search)){
            $this->db->like('frs_grup',$search,'both');
            $this->db->or_like('frs_semester',$search,'both');
            $this->db->or_like('frs_thn_ajar',$search,'both');
            $this->db->or_like('frs_fak_prod',$search,'both');
            $this->db->or_like('user_full_name',$search,'both');
            $this->db->or_like('user_code',$search,'both');
        }
        $this->db->from($this->frs_v);
        return $this->db->count_all_results();
    }
    function getFrsDetail($frs_grup){
        $query =$this->db->get_where($this->frs_matkul_v,array('frs_grup'=>$frs_grup));
        return $query->result_array();
    }

    function getFrsForMhsGrouped($id){
        $this->db->where('user_id',$id);
        $this->db->order_by('frs_grup','desc');
        $query = $this->db->get($this->frs_v);
        return $query->result_array();
    }
    function getSingleFrsForMhs($frs_grup){
        $query = mysql_query("SELECT * FROM ".$this->frs_v." WHERE frs_grup = '$frs_grup' ");
        return mysql_fetch_array($query);
    }
    function deleteFrs($id){
        $this->db->where($this->frs_pk,$id);
        $this->db->delete($this->frs_tbl);
    }

    function browseMk($gg,$ta,$fp,$ns){
        $query = $this->db->query("SELECT * FROM ".$this->mk_tbl." WHERE mk_thn_ajar = '$ta' AND mk_fak_prod LIKE '%$fp%' AND mk_grup LIKE '%$gg%' AND mk_semester <> '$ns';");
        return $query->result_array();
    }


    //nilai model
    function getMhsNFrsForMk($mk_id){
        $query = $this->db->query("SELECT a.*, b.user_full_name,b.user_code FROM ".$this->frs_tbl." a,".$this->user_tbl." b WHERE a.user_id  = b.user_id AND a.mk_id = ".$mk_id.";");
        return $query->result_array();
    }
    function fillNilai($data){
        $this->db->where($this->frs_pk,$data['frs_id']);
        $this->db->update($this->frs_tbl,$data);
    }
    function getMkForDosen($offset=0,$limit=10,$search=null,$dosen){
        $this->db->order_by('mk_id','desc');
        if(!empty($search)){
            $this->db->like('mk_grup',$search,'both');
            $this->db->or_like('mk_semester',$search,'both');
            $this->db->or_like('mk_thn_ajar',$search,'both');
            $this->db->or_like('mk_fak_prod',$search,'both');
        }
        $this->db->where('mk_dosen',$dosen);
        $query = $this->db->get($this->mk_hmhs,$limit,$offset);
        return $query->result_array();
    }
    function countMkForDosen($search=null,$dosen){
        if(!empty($search)){-
            $this->db->like('mk_grup',$search,'both');
            $this->db->or_like('mk_semester',$search,'both');
            $this->db->or_like('mk_thn_ajar',$search,'both');
            $this->db->or_like('mk_fak_prod',$search,'both');
        }
        $this->db->where('mk_dosen',$dosen);
        $this->db->from($this->mk_hmhs);
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
    function updateFrsStatus($data){
       $this->db->query("UPDATE ".$this->frs_tbl." SET frs_status = '".$data['frs_status']."' WHERE ".$this->frs_pk." = ".$data['frs_id']."");
    }


    //KHS model
    function getSingleFrsGrouped($frs_grup){
        $query = mysql_query("SELECT * FROM ".$this->frs_v." WHERE frs_grup = '$frs_grup' ");
        return mysql_fetch_array($query);
    }
    function getKhsDetail($frs_grup){
        $query =$this->db->get_where($this->khs_detail_v,array('frs_grup'=>$frs_grup));
        return $query->result_array();
    }
    function getTranskrip($id){
        $query =$this->db->get_where($this->khs_detail_v,array('user_id'=>$id));
        return $query->result_array();
    }


}