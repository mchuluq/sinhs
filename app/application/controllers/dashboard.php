<?php
/**
 * sinhs.
 * Dashboard - single screen information
 * User: mochammad c. chuluq
 * Date: 20/05/13
 * Time: 20:29
 * Chraven Systems dev. labs.
 */
class Dashboard extends Member_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('dashboard_model');
    }

    function index(){
        $data['widgets'] = $this->dashboard_model->getWidgets($this->session->userdata('group_name'));
        $this->template->display('dashboard','dashboard',$data);
    }
}