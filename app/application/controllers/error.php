<?php
/**
 * sinhs.
 * error - custom error page
 * User: mochammad c. chuluq
 * Date: 20/05/13
 * Time: 20:32
 * Chraven Systems dev. labs.
 */
class Error extends CI_Controller{

    var $error403 = array(
        'title'=>'Forbidden',
        'error_type'=>'403',
        'message'=>'Akses ke laman ini tidak diperkenankan',
        'type'=>'warning'
    );
    var $error404 = array(
        'title'=>'Page Not Found',
        'error_type'=>'404',
        'message'=>'Maaf, Laman yang anda minta tidak ditemukan',
        'type'=>'warning'
    );
    var $error405 = array(
        'title'=>'Method Not Allowed',
        'error_type'=>'405',
        'message'=>'Terdapat kesalahan, Metode tidak diperkenankan',
        'type'=>'warning'
    );
    var $error500 = array(
        'title'=>'Internal Server Error',
        'error_type'=>'500',
        'message'=>'Terdapat kesalahan di server',
        'type'=>'warning'
    );
    var $error503 = array(
        'title'=>'Service Unavailable',
        'error_type'=>'503',
        'message'=>'Maaf,Terdapat kesalahan, Layanan tidak tersedia',
        'type'=>'warning'
    );

    function __construct(){
        parent::__construct();
    }

    private function _is_ajax(){
        return ( $this->input->server('HTTP_X_REQUESTED_WITH')&&( $this->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
    }
    private function _show_error($data){
        if($this->_is_ajax()){
            echo json_encode($data);
        }else{
            $this->load->view('errors/errors',$data);
        }
    }

    function index(){
        $this->e404();
    }
    function e404(){
        $this->_show_error($this->error404);
    }
    function e403(){
        $this->_show_error($this->error403);
    }
    function e405(){
        $this->_show_error($this->error405);
    }
    function e500(){
        $this->_show_error($this->error500);
    }
    function e503(){
        $this->_show_error($this->error503);
    }
}