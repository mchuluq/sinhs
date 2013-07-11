<?php
/**
 * sinhs.
 * User: mochammad c. chuluq
 * Date: 04/06/13
 * Time: 19:42
 * Chraven Systems dev. labs.
 */
class Account extends Member_Controller{

    const STRONG_PASS = '/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/'; //one lowercase letter, one uppercase letter, one number, and be at least 6 characters long.
    private $forbiden = array('Pas5word','12345','password');


    function __construct(){
        parent::__construct();
        $this->load->model('account_model');
    }

    function index(){
        $data['user_data'] = $this->account_model->getAccountData();
        $this->template->display('account',$this->session->userdata('user_name'),$data);
    }
    function profile(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_name','user name','required');
            $this->form_validation->set_rules('user_contact','no. kontak','numeric');
            $this->form_validation->set_rules('user_email','email','valid_email');
            if($this->form_validation->run() == TRUE){
                $data['user_id'] = $this->session->userdata('user_id');
                $data['user_name'] = $this->input->post('user_name');
                $data['user_contact'] = $this->input->post('user_contact');
                $data['user_email'] = $this->input->post('user_email');

                $send = $this->account_model->updateData($data);
                if($send == '1'){
                    $this->account_model->updateSession($data);
                    $this->account_model->checkDefaultData($data['user_id']);
                    $notif= array('title'=>'Account','message'=>'sukses memperbarui data akun','type'=>'success');
                }elseif($send == '0'){
                    $notif= array('title'=>'Account','message'=>'username "'.$this->input->post('user_name').'" tidak dapat digunakan ','type'=>'error');
                };
            }else{
                $notif= array('title'=>'Account','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            redirect(base_url('account'));
        }
    }
    function password(){
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pass_old','password lama','required');
            $this->form_validation->set_rules('pass_new1','password baru','required|callback_password_check');
            $this->form_validation->set_rules('pass_new2','pengulangan password baru','required|matches[pass_new1]');
            if($this->form_validation->run() == TRUE){
                $data['user_id'] = $this->session->userdata('user_id');
                $data['user_pass'] = $this->uac->encrypt($this->input->post('pass_new1'));
                if($this->account_model->checkPass($data['user_id'],$this->uac->encrypt($this->input->post('pass_old')))){
                    $this->account_model->updateData($data);
                    $this->account_model->checkDefaultData($data['user_id']);
                    $notif= array('title'=>'Password','message'=>'sukses memperbarui password','type'=>'success');
                }else{
                    $notif= array('title'=>'Password','message'=>'Password lama anda tidak dikenali','type'=>'error');
                }
            }else{
                $notif= array('title'=>'Password','message'=>validation_errors(),'type'=>'error');
            }
            echo json_encode($notif);
        }else{
            redirect(base_url('account'));
        }
    }
    public function password_check($str){
        if(empty($mk_id)){echo file_get_contents(base_url('error/e404')); exit;}
        if(in_array($str,$this->forbiden)){
            $this->form_validation->set_message('password_check', 'Password terlalu mudah ditebak');
            return FALSE;
        }elseif (!preg_match(self::STRONG_PASS, $str)){
            $this->form_validation->set_message('password_check', 'harap masukkan setidaknya 1 huruf kecil, 1 huruf besar,1 nomor, dan lebih dari 6 karakter untuk %s. contoh : "Pas5word" ');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    function  backgroundChanger($style){
        $this->account_model->changeBg($this->session->userdata('user_id'),$style);
        //echo json_encode(array('title'=>'Account','message'=>'backround changed','type'=>'success'));
    }
}