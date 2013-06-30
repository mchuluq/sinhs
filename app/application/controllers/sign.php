<?php
/**
 * authentication - controller
 * User: mochammad c. chuluq
 * Date: 18/05/13
 * Time: 19:28
 * Chraven Systems dev. labs.
 */
class Sign extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library(array('uac','form_validation'));
    }

    //fungsi umum untuk form login, form aktivasi, dan logout
    function index(){
        $this->in();
    }
    function in(){
        if($this->session->userdata('log_status')){
            redirect(base_url('dashboard'));
        }else{
            $data['title'] = 'login';
            $this->form_validation->set_rules('user-log','nama pengguna','required');
            $this->form_validation->set_rules('user-pass','password pengguna','required');
            if($this->form_validation->run() == TRUE){
                $user = $this->input->post('user-log');
                $pass = $this->input->post('user-pass');
                $login = $this->uac->login($user,$pass);
                if($login == '0'){
                    redirect('dashboard');
                }elseif($login == '1'){
                    $this->session->set_flashdata('error',"password anda tidak dikenali");
                    $this->session->set_flashdata('uname',$user);
                    redirect('sign/in');
                }elseif($login == '2'){
                    $this->session->set_flashdata('error',"username tidak dikenal");
                    redirect('sign/in');
                };
            }else{
                $this->load->view('login',$data);
            }
        }
    }
    function out(){
        if($this->uac->logout()){
            redirect("sign/in");
        }else{
            redirect("dashboard");
        };

    }
    function up(){}

    //fungsi khusus untuk recovery password dan aktivas akun
    function recover($key){}
    function activation($key){}
}