<?php
/**
 * sinhs.
 * KHS - controller
 * User: mochammad c. chuluq
 * Date: 14/06/13
 * Time: 17:12
 * Chraven Systems dev. labs.
 */
class Khs extends Member_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('sinhs_model');
    }

    function index($par1='default',$par2=null,$par3=null){
        switch($par1){
            default:
            case 'default':
                $this->template->display('khs_index','Data KHS');
                break;
            case 'grup':
                $this->_listKhsForMhsGrouped();
                break;
            case 'detail':
                $this->_listKhsForMhsDetail($par2,$par3);
                break;
        }
    }
    private function _listKhsForMhsGrouped(){
        $data['khs_grouped']=$this->sinhs_model->getFrsForMhsGrouped($this->session->userdata('user_id'));
        $this->load->view('xdata/d_khs_index_grup',$data);
    }
    private function _listKhsForMhsDetail($khs_grup1,$khs_grup2){
        $khs_grup = str_replace('%20',' ',$khs_grup1.'/'.$khs_grup2);
        $data['khs'] = $this->sinhs_model->getSingleFrsGrouped($khs_grup);
        $data['khs_detail']=$this->sinhs_model->getKhsDetail($khs_grup);
        $data['transkrip'] = $this->sinhs_model->getTranskrip($this->session->userdata('user_id'));
        $this->template->display('khs_index_detail','KHS',$data);
    }

    function transkrip(){
        $data['transkrip']=$this->sinhs_model->getTranskrip($this->session->userdata('user_id'));
        $data['mhs'] = $this->sinhs_model->getMhsProfile($this->session->userdata('user_id'));
        $this->template->display('khs_transkrip','Transkrip',$data);
    }


}