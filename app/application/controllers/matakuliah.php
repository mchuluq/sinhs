<?php
/**
 * sinhs.
 * matakuliah controller
 * User: mochammad c. chuluq
 * Date: 07/06/13
 * Time: 18:06
 * Chraven Systems dev. labs.
 */
class matakuliah extends Member_Controller{

    //class property area
    private $limit = 20;

    //constructor
    function __construct(){
        parent::__construct();
        $this->load->model('sinhs_model');
    }

    //private area
    private function _validate($id=FALSE){
        $this->load->library('form_validation');
        if($id){
            $this->form_validation->set_rules('mk_id','id','required|integer|max_length[11]');
        }
        $this->form_validation->set_rules('mk_semester','semester','required|integer|max_length[2]');
        $this->form_validation->set_rules('mk_thn_ajar','tahun ajaran','required|exact_length[9]');
        $this->form_validation->set_rules('mk_fak_prod','Fakultas / Prodi','required|max_length[60]');
        $this->form_validation->set_rules('mk_kode[]','Kode MK','max_length[15]');
        $this->form_validation->set_rules('mk_nama[]','Matakuliah','required|max_length[60]');
        $this->form_validation->set_rules('mk_sks[]','SKS','required|is_natural_no_zero|max_length[1]');
        $this->form_validation->set_rules('mk_dosen[]','Dosen','max_length[50]');
        if($this->form_validation->run()==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    private function _listMkGrouped($offset,$limit,$search){
        if(empty($offset)) $offset = 0;
        if(empty($limit)) $offset = $this->limit;
        $this->load->library('xpage');
            $con['base_url']=base_url('matakuliah/index/grup');
            $con['total_rows']=$this->sinhs_model->countMkGrouped($search);
            $con['per_page']=$limit;
            $con['uri_segment']=4;
        $this->xpage->initialize($con);
        $data['mk_grouped']=$this->sinhs_model->getMkGrouped($offset,$limit,$search);
        $data['pagination']=$this->xpage->create_links();
        $data['total']=$this->xpage->show_count();
        $this->load->view('xdata/d_matakuliah_index_grup',$data);
    }
    private function _listMkDetail($mk_grup1,$mk_grup2){
        $mk_grup = str_replace('%20',' ',$mk_grup1.'/'.$mk_grup2);
        $data['mk_detail']=$this->sinhs_model->getMkDetail($mk_grup);
        $this->template->display('matakuliah_index_detail','Data Matakuliah',$data);
    }

    //public area
    function index($par1='default',$par2=null,$par3=null,$par4=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('matakuliah_index','Data Matakuliah');
                break;
            case 'grup':
                $this->_listMkGrouped($par2,$par3,$par4);
                break;
            case 'detail':
                $this->_listMkDetail($par2,$par3);
                break;
        }
    }

    function add(){
        if($_POST){
            if($this->_validate()){
                $this->load->helper('sinhs');
                $mk_grup = createMkGrup($this->input->post('mk_semester'),$this->input->post('mk_thn_ajar'),$this->input->post('mk_fak_prod'));
                $total_field = sizeof($this->input->post('mk_kode'));
                for ($i = 0; $i < $total_field; $i++) {
                    $multi[] = array(
                        $mk_grup,
                        $this->input->post('mk_semester'),
                        $this->input->post('mk_thn_ajar'),
                        $this->input->post('mk_fak_prod'),
                        safeInput($_POST['mk_kode'][$i]),
                        safeInput($_POST['mk_nama'][$i]),
                        safeInput($_POST['mk_sks'][$i]),
                        safeInput($_POST['mk_dosen'][$i])
                    );
                }
                $this->sinhs_model->insertMk($multi);
                $notif= array('title'=>'Sukses','message'=>$total_field.' Matakuliah telah disimpan','type'=>'success');
            }else{
                $notif= array('title'=>'Validasi','message'=>validation_errors(),'type'=>'warning');
            }
            echo json_encode($notif);
        }else{
            $data['dsnl'] = $this->sinhs_model->getDsnTypeahead();
            $data['fpl'] = $this->sinhs_model->getFpList();
            $this->template->display('matakuliah_add','Tambah Data Matakuliah',$data);
        }
    }

    function edit($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        if($_POST){
            if($this->_validate(TRUE)){
                $this->load->helper('sinhs');
                $mk_grup = createMkGrup($this->input->post('mk_semester'),$this->input->post('mk_thn_ajar'),$this->input->post('mk_fak_prod'));
                $data= array(
                    'mk_id'=>$this->input->post('mk_id'),
                    'mk_grup'=>$mk_grup,
                    'mk_semester'=>$this->input->post('mk_semester'),
                    'mk_thn_ajar'=>$this->input->post('mk_thn_ajar'),
                    'mk_fak_prod'=>$this->input->post('mk_fak_prod'),
                    'mk_kode'=>$this->input->post('mk_kode'),
                    'mk_nama'=>$this->input->post('mk_nama'),
                    'mk_sks'=>$this->input->post('mk_sks'),
                    'mk_dosen'=>$this->input->post('mk_dosen'),
                );
                $this->sinhs_model->updateMk($data);
                $notif= array('title'=>'Sukses','message'=>'Matakuliah Sukses diperbarui','type'=>'success');
            }else{
                $notif= array('title'=>'Sukses','message'=>validation_errors(),'type'=>'warning');
            }
            echo json_encode($notif);
        }else{
            $data['mk'] = $this->sinhs_model->getSingleMk($id);
            $data['dsnl'] = $this->sinhs_model->getDsnTypeahead();
            $data['fpl'] = $this->sinhs_model->getFpList();
            $this->template->display('matakuliah_edit','Tambah Data Matakuliah',$data);
        }
    }

    function drop($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->sinhs_model->deleteMk($id);
        $notif= array('title'=>'Sukses','message'=>'Matakuliah Sukses dihapus','type'=>'success');
        echo json_encode($notif);
    }

    //sebaran mata kuliah
    function sebaran(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('thn_ajar','Tahun ajar','required');
            $this->form_validation->set_rules('fp','Fakultas Prodi','required');
            $this->form_validation->set_rules('gg','ganjil Genap','required');
            if($this->form_validation->run()==TRUE){
                $data['matkul'] = $this->sinhs_model->sebaranMk($this->input->post('thn_ajar'),$this->input->post('fp'),$this->input->post('gg'));
                $data['ta'] = $this->input->post('thn_ajar');
                $data['fp'] = $this->input->post('fp');
                $this->load->view('xdata/d_matakuliah_sebaran',$data);
            }
        }else{
            $data['thn_ajar'] = $this->sinhs_model->getListThnAjar();
            $data['fp_list'] = $this->sinhs_model->getFpList();
            $this->template->display('matakuliah_sebaran','Sebaran Matakuliah',$data);
        }

    }
}