<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Controller - Custom Controller Class
 * User: mochammad c. chuluq
 * Date: 13/05/13
 * Time: 18:43
 */

class Member_Controller extends CI_Controller {
    function __construct(){
        parent::__construct();
        //no cache please...
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-chace');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $this->load->library(array('uac','template'));
        $this->load->helper('sinhs');
        if(!$this->_is_login()){
            redirect(base_url('sign/in'));
        }elseif(!$this->_check_access()){
            redirect(base_url('error/e403'));
        }
    }
    private function _check_access(){
        return $this->uac->validate();
    }
    private function _is_login(){
        return $this->uac->is_login();
    }
}

class MY_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }
}
