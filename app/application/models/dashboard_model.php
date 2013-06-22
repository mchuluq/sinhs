<?php
/**
 * sinhs.
 * dashbard - model
 * User: mochammad c. chuluq
 * Date: 16/06/13
 * Time: 0:54
 * Chraven Systems dev. labs.
 */
class Dashboard_model extends CI_Model{
    private $i_widgets = 'i_widgets';

    function __construct(){
        parent::__construct();
    }

    function getWidgets($group){
        //$this->db->order_by('w_width','DESC');
        $this->db->like('w_for','all','both');
        $this->db->or_like('w_for',$group,'both');
        $query = $this->db->get($this->i_widgets);
        return $query->result_array();
    }
}