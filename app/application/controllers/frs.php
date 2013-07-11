<?php
/**
 * sinhs.
 * FRS - controller
 * User: mochammad c. chuluq
 * Date: 09/06/13
 * Time: 10:05
 * Chraven Systems dev. labs.
 */

class Frs extends Member_Controller{
    private $limit = 10;

    function __construct(){
        parent::__construct();
        $this->load->model('sinhs_model');
        $this->load->library('form_validation');
    }

    //validasi input
    private function _validateStep2($id=FALSE){
        if($id){
            $this->form_validation->set_rules('frs_id','id','required|integer|max_length[11]');
        }
        $this->form_validation->set_rules('frs_semester','semester','required|integer|max_length[2]');
        $this->form_validation->set_rules('frs_thn_ajar','tahun ajaran','required|exact_length[9]');
        $this->form_validation->set_rules('frs_pemb_akad','pembimbing akademik','max_length[30]');
        $this->form_validation->set_rules('frs_keterangan[]','keterangan','max_length[255]');
        $this->form_validation->set_rules('mk_id[]','Matakuliah','required|integer|max_length[11]');
        if($this->form_validation->run()==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //melihat daftar FRS yang diambil mahasiswa dikelompokkan per semester, dan melihat detilnya
    function index($par1='default',$par2=null,$par3=null,$par4=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('frs_index','Data FRS');
                break;
            case 'grup':
                $this->_listFrsGrouped($par2,$par3,$par4);
                break;
            case 'detail':
                $this->_listFrsDetail($par2,$par3);
                break;
        }
    }
    private function _listFrsGrouped($offset,$limit,$search){
        if(empty($offset)) $offset = 0;
        if(empty($limit)) $offset = $this->limit;
        $this->load->library('xpage');
        $con['base_url']=base_url('frs/index/grup');
        $con['total_rows']=$this->sinhs_model->countFrsGrouped($search);
        $con['per_page']=$limit;
        $con['uri_segment']=4;
        $this->xpage->initialize($con);
        $data['frs_grouped']=$this->sinhs_model->getFrsGrouped($offset,$limit,$search);
        $data['pagination']=$this->xpage->create_links();
        $data['total']=$this->xpage->show_count();
        $this->load->view('xdata/d_frs_index_grup',$data);
    }
    private function _listFrsDetail($frs_grup1,$frs_grup2){
        $frs_grup = str_replace('%20',' ',$frs_grup1.'/'.$frs_grup2);
        $data['frs_detail']=$this->sinhs_model->getFrsDetail($frs_grup);
        $this->template->display('frs_index_detail','data FRS',$data);
    }

    //membuat frs baru untuk mahasiswa
    function create($act='default',$par1=null,$par2=null,$par3=null,$par4=null){
        switch($act){
            case 'default':
                $this->template->display('frs_create','membuat FRS');
                break;
            case 'step1':
                $this->_step1();
                break;
            case 'step2':
                $this->_step2();
                break;
            case 'step3':
                $this->_step3();
                break;
            case 'browseMk':
                $this->_browseMk($par1,$par2,$par3,$par4);
                break;
        }
    }
    private function _step1(){
        $this->load->view('xform/f_frs_step1');
    }
    private function _step2(){
        $profile = $this->sinhs_model->getMhsProfile($this->session->userdata('user_id'));
        if($_POST){
            $this->form_validation->set_rules('frs_semester','semester','required|integer|max_length[2]');
            $this->form_validation->set_rules('frs_thn_ajar','tahun ajaran','required|exact_length[9]');
            if($this->form_validation->run()==TRUE){
                $data['semester'] = $this->input->post('frs_semester');
                $data['fak_prod'] = $profile['fak_prod'];
                $data['thn_ajar'] = $this->input->post('frs_thn_ajar');
                $data['mkl'] = $this->sinhs_model->getMkFor($this->input->post('frs_semester'),$this->input->post('frs_thn_ajar'),$profile['fak_prod']);
                $this->load->view('xform/f_frs_step2',$data);
            }else{
                $this->load->view('xform/f_frs_step1');
            }
        }
    }
    private function _step3(){
        $profile = $this->sinhs_model->getMhsProfile($this->session->userdata('user_id'));
        if($_POST){
            if($this->_validateStep2()){
                $multi = array();
                $this->load->helper('sinhs');
                $frs_grup = createFrsGrup($profile['nim'],$this->input->post('frs_semester'),$this->input->post('frs_thn_ajar'),$profile['fak_prod']);
                $total_field = sizeof($this->input->post('mk_id'));
                $total_saved = 0;
                $sks = 0;
                for ($i = 0; $i < $total_field; $i++) {
                    if(isset($_POST['mkt'][$i])){
                        $sks = $sks + $_POST['sks'][$i];
                        $total_saved++;
                        $multi[] = array(
                            $frs_grup,
                            $this->input->post('frs_semester'),
                            $this->input->post('frs_thn_ajar'),
                            $profile['fak_prod'],
                            $this->input->post('frs_pemb_akad'),
                            safeInput($_POST['frs_keterangan'][$i]),
                            safeInput($_POST['mk_id'][$i]),
                            $this->session->userdata('user_id'),
                        );
                    }
                }
                if($sks <= 24){
                    $this->sinhs_model->insertFrs($multi);
                    $notif= array('title'=>'Sukses','message'=>$total_saved.' Matakuliah telah disimpan','type'=>'success');
                }else{
                    $kelebihan = $sks - 24;
                    $notif= array('title'=>'Kelebihan SKS','message'=>'Anda kelebihan '.$kelebihan.' SKS.</br> SKS tidak boleh lebih dari 24','type'=>'warning');
                }
            }else{
                $notif= array('title'=>'Validasi','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }
    }
    private function _browseMk($semester,$thn1,$thn2,$fp1){
        $gg = ($semester % 2 == 0) ? 'gnp':'gnj';
        $ta = $thn1.'/'.$thn2;
        $fp = str_replace('%20',' ',$fp1);
        $data['listMk'] = $this->sinhs_model->browseMk($gg,$ta,$fp);
        //echo $gg.' | '.$ta.' | '.$fp;
        $this->load->view('xform/f_frs_browsemk',$data);
    }


    //melihat daftar FRS yang telah dibuat oleh mahasiswa untuk mahasiswa
    function mahasiswa($par1='default',$par2=null,$par3=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('frs_index_mhs','Data FRS');
                break;
            case 'grup':
                $this->_listFrsForMhsGrouped();
                break;
            case 'detail':
                $this->_listFrsForMhsDetail($par2,$par3);
                break;
        }
    }
    private function _listFrsForMhsGrouped(){
        $data['frs_grouped']=$this->sinhs_model->getFrsForMhsGrouped($this->session->userdata('user_id'));
        $this->load->view('xdata/d_frs_index_grup_mhs',$data);
    }
    private function _listFrsForMhsDetail($frs_grup1,$frs_grup2){
        $frs_grup = str_replace('%20',' ',$frs_grup1.'/'.$frs_grup2);
        $data['frs_detail']=$this->sinhs_model->getFrsDetail($frs_grup);
        $data['frs']=$this->sinhs_model->getSingleFrsForMhs($frs_grup);
        $this->template->display('frs_index_mhs_detail','Data FRS',$data);
    }

    //hapus FRS
    function drop($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->sinhs_model->deleteFrs($id);
        $notif= array('title'=>'Sukses','message'=>'Matakuliah dalam FRS Sukses dihapus','type'=>'success');
        echo json_encode($notif);
    }
}