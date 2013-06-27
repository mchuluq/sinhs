<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * sinhs.
 * control panel model - proses data untuk control panel
 * User: mochammad c. chuluq
 * Date: 21/05/13
 * Time: 22:22
 * Chraven Systems dev. labs.
 */
class Control_model extends CI_Model{
    private $user_tbl = 'user_member';
    private $group_tbl = 'user_group';
    private $access_tbl = 'user_access';
    private $menu_tbl ='user_menu';
    private $widget_tbl = 'i_widgets';

    function __construct() {
        parent::__construct();
    }

    function getGroup(){
        $query = $this->db->query("SELECT a.*, (SELECT COUNT(user_id) FROM ".$this->user_tbl." WHERE a.group_name = ".$this->user_tbl.".group_name) as total_users FROM ".$this->group_tbl." a");
        return $query->result_array();
    }
    function getMenu(){
        $this->db->order_by("menu_class");
        $this->db->order_by("menu_method");
        $this->db->order_by("menu_param");
        $query = $this->db->get($this->menu_tbl);
        return $query->result_array();
    }

    function addGroup($data){
        $this->db->insert($this->group_tbl,$data);
    }
    function getSingleGroup($gname){
        $query = mysql_query("SELECT * FROM ".$this->group_tbl." WHERE group_name = '$gname'");
        return mysql_fetch_array($query);
    }
    function updateGroup($data){
        $this->db->where('group_name', $data['group_name']);
        $this->db->update($this->group_tbl, $data);
    }
    function deleteGroup($id){
        $this->db->where('group_name', $id);
        if($this->db->delete($this->group_tbl)){
            return TRUE;
        }else{
            return FALSE;
        };
    }

    function addMenu($data){
        $this->db->insert($this->menu_tbl,$data);
    }
    function getSingleMenu($mid){
        $query = mysql_query("SELECT * FROM ".$this->menu_tbl." WHERE menu_id = '$mid'");
        return mysql_fetch_array($query);
    }
    function updateMenu($data){
        $this->db->where('menu_id', $data['menu_id']);
        $this->db->update($this->menu_tbl, $data);
    }
    function deleteMenu($id){
        $this->db->where('menu_id', $id);
        if($this->db->delete($this->menu_tbl)){
            return TRUE;
        }else{
            return FALSE;
        };
    }

    function getListMenu(){
        $this->db->select('menu_access,menu_title');
        $query = $this->db->get($this->menu_tbl);
        return $query->result_array();
    }
    function getListGroup(){
        $this->db->select('group_name');
        $query = $this->db->get($this->group_tbl);
        return $query->result_array();
    }
    function addAccess($data){
        $this->db->insert($this->access_tbl,$data);
    }
    function deleteAccess($id){
        $this->db->where('access_id', $id);
        if($this->db->delete($this->access_tbl)){
            return TRUE;
        }else{
            return FALSE;
        };
    }

    function widget_list(){
        $query = $this->db->get($this->widget_tbl);
        return $query->result_array();
    }
    function getSingleWidget($id){
        $query = mysql_query("SELECT * FROM ".$this->widget_tbl." WHERE w_id = '$id'");
        return mysql_fetch_array($query);
    }
    function addWidget($data){
        $this->db->insert($this->widget_tbl,$data);
    }
    function editWidget($data){
        $this->db->where('w_id',$data['w_id']);
        $this->db->update($this->widget_tbl,$data);
    }
    function dropWidget($id){
        $this->db->where('w_id',$id);
        $this->db->delete($this->widget_tbl);
    }


}