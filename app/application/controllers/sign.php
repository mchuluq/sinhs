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
    	$data['title'] = 'login';
        $this->form_validation->set_rules('user-log','nama pengguna','required');
        $this->form_validation->set_rules('user-pass','password pengguna','required');
        if($this->form_validation->run() == TRUE){
            $user = $this->input->post('user-log');
            $pass = $this->input->post('user-pass');
            $login = $this->uac->login($user,$pass);
            if($login){
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('error',"username atau password tidak dikenal");
                redirect('sign/in');
            };
        }else{
            $this->load->view('login',$data);
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