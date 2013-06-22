<?php
/**
 * sinhs.
 * nilai controller
 * User: mochammad c. chuluq
 * Date: 11/06/13
 * Time: 10:50
 * Chraven Systems dev. labs.
 */
class Nilai extends Member_Controller{

    private $limit = 10;

    function __construct(){
        parent::__construct();
        $this->load->model('sinhs_model');
    }

    function index($par1='default',$par2=null,$par3=null,$par4=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('nilai_index','Data Nilai Matakuliah');
                break;
            case 'grup':
                $this->_listMkGrouped($par2,$par3,$par4);
                break;
            case 'detail':
                $this->_listMkDetail($par2,$par3);
                break;
        }
    }
    private function _listMkGrouped($offset,$limit,$search){
        if(empty($offset)) $offset = 0;
        if(empty($limit)) $offset = $this->limit;
        $this->load->library('xpage');
        $con['base_url']=base_url('nilai/index/grup');
        $con['total_rows']=$this->sinhs_model->countMkGrouped($search);
        $con['per_page']=$limit;
        $con['uri_segment']=4;
        $this->xpage->initialize($con);
        $data['mk_grouped']=$this->sinhs_model->getMkGrouped($offset,$limit,$search);
        $data['pagination']=$this->xpage->create_links();
        $data['total']=$this->xpage->show_count();
        $this->load->view('xdata/d_nilai_index_grup',$data);
    }
    private function _listMkDetail($mk_grup1,$mk_grup2){
        $mk_grup = str_replace('%20',' ',$mk_grup1.'/'.$mk_grup2);
        $data['mk_detail']=$this->sinhs_model->getMkDetail($mk_grup);
        $this->load->view('xdata/d_nilai_index_detil',$data);
    }

    function input($mk_id){
        if(empty($mk_id)){echo file_get_contents(base_url('error/e500')); exit;}
        if($_POST){
            if($this->_validate()){
                $this->load->helper('sinhs');
                $total_field = sizeof($this->input->post('frs_id'));
                for ($i = 0; $i < $total_field; $i++) {
                     $data = array(
                        'frs_nilai_angka'=>safeInput($_POST['frs_nilai_angka'][$i]),
                        'frs_nilai_huruf'=>nilaiHuruf($_POST['frs_nilai_angka'][$i]),
                        'frs_id'=>safeInput($_POST['frs_id'][$i])
                    );
                    $this->sinhs_model->fillNilai($data);
                    $notif= array('title'=>'Sukses','message'=>'nilai '.$total_field.' Mahasiswa telah disimpan','type'=>'success');
                }
            }else{
                $notif= array('title'=>'Sukses','message'=>validation_errors(),'type'=>'warning');
            }
            echo json_encode($notif);
        }else{
            $data['mk'] = $this->sinhs_model->getSingleMk($mk_id);
            $data['list'] = $this->sinhs_model->getMhsNFrsForMk($mk_id);
            $this->template->display('nilai_input','Input Nilai',$data);
        }
    }
    private function _validate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('frs_id[]','id FRS','required|integer|max_length[11]');
        $this->form_validation->set_rules('frs_nilai_angka[]','nilai angka','numeric|max_length[3]');
        if($this->form_validation->run() == TRUE){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    function dosen($par1='default',$par2=null,$par3=null,$par4=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('nilai_dosen','Daftar Matakuliah Untuk Dosen');
                break;
            case 'list':
                $this->_listMkForDosen($par2,$par3,$par4);
                break;
            case 'detail':
                $this->_listMkDetail($par2,$par3);
                break;
        }
    }
    private function _listMkForDosen($offset,$limit,$search){
        if(empty($offset)) $offset = 0;
        if(empty($limit)) $offset = $this->limit;
        $this->load->library('xpage');
        $con['base_url']=base_url('nilai/dosen/list');
        $con['total_rows']=$this->sinhs_model->countMkForDosen($search,$this->session->userdata('user_full_name'));
        $con['per_page']=$limit;
        $con['uri_segment']=4;
        $this->xpage->initialize($con);
        $data['mkl']=$this->sinhs_model->getMkForDosen($offset,$limit,$search,$this->session->userdata('user_full_name'));
        $data['pagination']=$this->xpage->create_links();
        $data['total']=$this->xpage->show_count();
        $this->load->view('xdata/d_nilai_dosen',$data);
    }
}