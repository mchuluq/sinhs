<?php
/**
 * sinhs.
 * User: mochammad c. chuluq
 * Date: 21/05/13
 * Time: 12:27
 * Chraven Systems dev. labs.
 */
class Users extends Member_Controller{
    private $limit = 20;

    function __construct(){
        parent::__construct();
        $this->load->model('users_model');
    }

    function index($act='all',$seg3=null,$seg4=null,$seg5=null){
        switch($act){
            default :
            case "all" :
                $this->listUsers($seg3,$seg4,$seg5);
                break;
            case "mahasiswa" :
                $this->listMahasiswa($seg3,$seg4,$seg5);
                break;
            case "dosen" :
                $this->listDosen($seg3,$seg4,$seg5);
                break;
            case "status":
                $this->changeStatus($seg3);
                break;
            case "delete":
                $this->delete($seg3);
                break;
        }
    }

    private function listUsers($offset=0,$limit=null,$search=null){
        if($this->template->is_ajax()){
            if(empty($offset)) $offset = 0;
            if(empty($limit)) $offset = $this->limit;
            $this->load->library('xpage');
            $con['base_url']='';
            $con['total_rows']=$this->users_model->countUsers($search);
            $con['per_page']=$limit;
            $con['uri_segment']=4;
            $this->xpage->initialize($con);
            $data['users']=$this->users_model->getUsersList($offset,$limit,$search);
            $data['pagination']=$this->xpage->create_links();
            $data['total']=$this->xpage->show_count();
            $this->load->view('xdata/d_users',$data);
        }else{
            $this->template->display('users','Data User');
        }

    }
    private function listMahasiswa($offset=0,$limit=null,$search=null){
        if($this->template->is_ajax()){
            if(empty($offset)) $offset = 0;
            if(empty($limit)) $offset = $this->limit;
            $this->load->library('xpage');
            $con['base_url']='';
            $con['total_rows']=$this->users_model->countMahasiswa($search);
            $con['per_page']=$limit;
            $con['uri_segment']=4;
            $this->xpage->initialize($con);
            $data['users']=$this->users_model->getMahasiswaList($offset,$limit,$search);
            $data['pagination']=$this->xpage->create_links();
            $data['total']=$this->xpage->show_count();
            $this->load->view('xdata/d_users_mahasiswa',$data);
        }else{
            $this->template->display('users_mahasiswa','Data Mahasiswa');
        }
    }
    private function listDosen($offset=0,$limit=null,$search=null){
        if($this->template->is_ajax()){
            if(empty($offset)) $offset = 0;
            if(empty($limit)) $offset = $this->limit;
            $this->load->library('xpage');
            $con['base_url']='';
            $con['total_rows']=$this->users_model->countDosen($search);
            $con['per_page']=$limit;
            $con['uri_segment']=4;
            $this->xpage->initialize($con);
            $data['users']=$this->users_model->getDosenList($offset,$limit,$search);
            $data['pagination']=$this->xpage->create_links();
            $data['total']=$this->xpage->show_count();
            $this->load->view('xdata/d_users_dosen',$data);
        }else{
            $this->template->display('users_dosen','Data Dosen');
        }
    }

    private function changeStatus($id){
        $change = $this->users_model->changeStatus($id);
        if($change){
            $notif= array('title'=>'Sukses','message'=>'Status user telah diubah','type'=>'success');
        }else {
            $notif= array('title'=>'gagal','message'=>'Status user gagal diubah','type'=>'warning');
        }
        echo json_encode($notif);
    }
    private function delete($id=null){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $do = $this->users_model->deleteUser($id);
        if($do){
            $notif= array('title'=>'Sukses','message'=>'hapus user sukses','type'=>'success');
        }else{
            $notif= array('title'=>'gagal','message'=>'tidak dapat mengapus user','type'=>'error');
        }
        echo json_encode($notif);
    }

    function add($type="default"){
        switch($type){
            default :
            case "default" :
                $this->addDefault();
                break;
            case "mahasiswa" :
                $this->addMahasiswa();
                break;
            case "dosen" :
                $this->addDosen();
                break;
        }
    }
    private function addDefault(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name','nama lengkap','required');
            $this->form_validation->set_rules('user_code','nomor induk','required');
            $this->form_validation->set_rules('group_name','grup','required');
            $this->form_validation->set_rules('user_status','status user','required');
            if($this->form_validation->run()){
                $data = array(
                    'user_full_name'=>$this->input->post('user_full_name'),
                    'user_code'=>$this->input->post('user_code'),
                    'group_name'=>$this->input->post('group_name'),
                    'user_status'=>$this->input->post('user_status'),
                    'user_name'=>$this->input->post('user_code'),
                    'user_pass'=>$this->uac->encrypt($this->input->post('user_code')),
                );
                $this->users_model->addUser($data);
                $notif= array('title'=>'Sukses','message'=>'simpan user baru sukses','type'=>'success');
            }else{
                $notif= array('title'=>'validasi','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            $data['glist'] = $this->users_model->getGroupList();
            $data['user']=array(
                'u_id'=>"",
                'u_f_name'=>"",
                'u_code'=>"",
                'g_name'=>"",
                'u_stat'=>0,
                'action'=>base_url('users/add/default'),
                'title'=>"Tambah User"
            );
            $this->template->display('users_f_user','Tambah User',$data);
        }

    }
    private function addMahasiswa(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name[]','nama lengkap','required');
            $this->form_validation->set_rules('user_code[]','NIM','required');
            $this->form_validation->set_rules('mhs_fak_prod[]','Fakultas / Prodi','required');
            $this->form_validation->set_rules('mhs_angkatan[]','Tahun Angkatan','required');
            $this->form_validation->set_rules('mhs_program[]','Jenis Program','required');
            if($this->form_validation->run()){
                $this->load->helper('sinhs');
                $total_field = sizeof($this->input->post('user_code'));
                $users = array();
                $mhs = array();
                for ($i = 0; $i < $total_field; $i++) {
                    $users[] = array(
                        safeInput($_POST['user_code'][$i]),
                        safeInput($_POST['user_full_name'][$i]),
                        $this->uac->encrypt(safeInput($_POST['user_code'][$i])),
                        'mahasiswa',
                        safeInput($_POST['user_code'][$i]),
                    );
                    $mhs[] =array(
                        safeInput($_POST['user_code'][$i]),
                        safeInput($_POST['mhs_fak_prod'][$i]),
                        safeInput($_POST['mhs_angkatan'][$i]),
                        safeInput($_POST['mhs_program'][$i])
                    );
                }
                $datamhs = array();
                $datausers = array();
                foreach($users as $key=>$value) {
                    $datausers[] = "'".implode("', '", $value)."'";
                }
                foreach($mhs as $key=>$value) {
                    $datamhs[] = "'".implode("', '", $value)."'";
                }
                $this->users_model->addMahasiswas($datausers,$datamhs);
                $notif= array('title'=>'Sukses','message'=>$total_field.' Mahasiswa telah ditambahkan','type'=>'success');
            }else{
                $notif= array('title'=>'validasi','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            foreach($this->users_model->getFpList() as $fp):
                $data['fpl'][] = '"'.$fp['fp_fak_prodi'].'"';
            endforeach;
            $data['user']=array(
                'u_id'=>"",
                'u_f_name'=>"",
                'u_code'=>"",
                'g_name'=>"",
                'u_stat'=>0,
                'action'=>base_url('users/add/mahasiswa'),
                'title'=>"Tambah Mahasiswa"
            );
            $this->template->display('users_f_mahasiswa','Tambah Mahasiswa',$data);
        }
    }
    private function addDosen(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name','nama lengkap','required');
            $this->form_validation->set_rules('user_code','nomor induk','required');
            $this->form_validation->set_rules('user_status','status user','required');
            $this->form_validation->set_rules('dsn_alamat','alamat dosen','required');
            if($this->form_validation->run()){
                $data_user = array(
                    'user_full_name'=>$this->input->post('user_full_name'),
                    'user_code'=>$this->input->post('user_code'),
                    'group_name'=>"dosen",
                    'user_status'=>$this->input->post('user_status'),
                    'user_name'=>$this->input->post('user_code'),
                    'user_pass'=>$this->uac->encrypt($this->input->post('user_code')),
                );
                $data_dsn = array(
                    'dsn_nip'=>$this->input->post('user_code'),
                    'dsn_alamat'=>$this->input->post('dsn_alamat'),
                );
                $this->users_model->addUser($data_user);
                $this->users_model->addDosen($data_dsn);
                $notif= array('title'=>'Sukses','message'=>'simpan user baru sukses','type'=>'success');
            }else{
                $notif= array('title'=>'validasi','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            $data['glist'] = $this->users_model->getGroupList();
            $data['user']=array(
                'u_id'=>"",
                'u_f_name'=>"",
                'u_code'=>"",
                'd_a'=>"",
                'd_t'=>"-",
                'u_stat'=>0,
                'action'=>base_url('users/add/dosen'),
                'title'=>"Tambah Dosen"
            );
            $this->template->display('users_f_dosen','Tambah Dosen',$data);
        }

    }

    function update($type="default",$id=null){
        switch($type){
            default:
            case "default" :
                $this->updateDefault($id);
                break;
            case "mahasiswa":
                $this->updateMahasiswa($id);
                break;
            case "dosen":
                $this->updateDosen($id);
                break;
        }
    }
    private function updateDefault($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name','nama lengkap','required');
            $this->form_validation->set_rules('user_id','user id','required');
            $this->form_validation->set_rules('user_code','nomor induk','required');
            $this->form_validation->set_rules('group_name','grup','required');
            $this->form_validation->set_rules('user_status','status user','required');
            if($this->form_validation->run()){
                $data = array(
                    'user_id'=>$this->input->post('user_id'),
                    'user_full_name'=>$this->input->post('user_full_name'),
                    'user_code'=>$this->input->post('user_code'),
                    'group_name'=>$this->input->post('group_name'),
                    'user_status'=>$this->input->post('user_status')
                );
                $this->users_model->updateUser($data);
                $notif= array('title'=>'Sukses','message'=>'data user telah diubah','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'Validasi','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $data['glist'] = $this->users_model->getGroupList();
            $user = $this->users_model->getSingleUser($id);
            $data['user']=array(
                'u_id'=>$user['user_id'],
                'u_f_name'=>$user['user_full_name'],
                'u_code'=>$user['user_code'],
                'g_name'=>$user['group_name'],
                'u_stat'=>$user['user_status'],
                'action'=>base_url('users/update/default/'.$user['user_id']),
                'title'=>"Ubah User"
            );
            $this->template->display('users_f_user','Ubah User',$data);
        }
    }
    private function updateMahasiswa($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name','nama lengkap','required');
            $this->form_validation->set_rules('user_id','user id','required');
            $this->form_validation->set_rules('user_code','nomor induk','required');
            $this->form_validation->set_rules('user_status','status user','required');
            $this->form_validation->set_rules('mhs_fak_prod','Fakultas / Prodi','required');
            $this->form_validation->set_rules('mhs_angkatan','Tahun Angkatan','required');
            $this->form_validation->set_rules('mhs_program','Jenis Program','required');
            if($this->form_validation->run()){
                $data = array(
                    'user_id'=>$this->input->post('user_id'),
                    'user_full_name'=>$this->input->post('user_full_name'),
                    'user_code'=>$this->input->post('user_code'),
                    'user_status'=>$this->input->post('user_status'),
                );
                $dataMhs = array(
                    'mhs_nim'=>$this->input->post('user_code'),
                    'mhs_fak_prodi'=>$this->input->post('mhs_fak_prod'),
                    'mhs_angkatan'=>$this->input->post('mhs_angkatan'),
                    'mhs_program'=>$this->input->post('mhs_program'),
                );
                $this->users_model->updateUser($data);
                $this->users_model->updateMhs($dataMhs);
                $notif= array('title'=>'Sukses','message'=>'data mahasiswa telah diubah','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'validasi','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $user = $this->users_model->getSingleMhs($id);
            foreach($this->users_model->getFpList() as $fp):
                $data['fpl'][] = '"'.$fp['fp_fak_prodi'].'"';
            endforeach;
            $data['user']=array(
                'u_id'=>$user['user_id'],
                'u_f_name'=>$user['user_full_name'],
                'u_code'=>$user['user_code'],
                'u_stat'=>$user['user_status'],
                'm_f_p'=>$user['mhs_fak_prodi'],
                'm_ang'=>$user['mhs_angkatan'],
                'm_pro'=>$user['mhs_program'],
                'action'=>base_url('users/update/mahasiswa/'.$user['user_id']),
                'title'=>"Ubah User"
            );
            $this->template->display('users_fu_mahasiswa','Ubah User',$data);
        }
    }
    private function updateDosen($id){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_full_name','nama lengkap','required');
            $this->form_validation->set_rules('user_code','nomor induk','required');
            $this->form_validation->set_rules('user_status','status user','required');
            $this->form_validation->set_rules('dsn_alamat','alamat dosen','required');
            if($this->form_validation->run()){
                $data = array(
                    'user_full_name'=>$this->input->post('user_full_name'),
                    'user_code'=>$this->input->post('user_code'),
                    'user_id'=>$this->input->post('user_id'),
                    'user_status'=>$this->input->post('user_status')
                );
                $dataDsn = array(
                    'dsn_nip'=>$this->input->post('user_code'),
                    'dsn_alamat'=>$this->input->post('dsn_alamat')
                );
                $this->users_model->updateUser($data);
                $this->users_model->updateDsn($dataDsn);
                $notif= array('title'=>'Sukses','message'=>'data dosen sukses diubah','type'=>'success');
            }else{
                $notif= array('title'=>'validasi','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            $user = $this->users_model->getSingleDosen($id);
            $data['user']=array(
                'u_id'=>$user['user_id'],
                'u_f_name'=>$user['user_full_name'],
                'u_code'=>$user['user_code'],
                'u_stat'=>$user['user_status'],
                'd_a'=>$user['dsn_alamat'],
                'action'=>base_url('users/update/dosen/'.$user['user_id']),
                'title'=>"Ubah Data Dosen"
            );
            $this->template->display('users_f_dosen','Ubah Data Dosen',$data);
        }

    }
}