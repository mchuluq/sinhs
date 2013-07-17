<?php
/**
 * sinhs.
 * control panel - all configuration for this app
 * User: mochammad c. chuluq
 * Date: 21/05/13
 * Time: 11:27
 * Chraven Systems dev. labs.
 */
class Control Extends Member_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('control_model');
    }

    //control panel home
    function index(){
        $this->template->display('control','control panel');
    }

    //User Access Control Center
    function uac($act='index',$id=''){
        switch ($act) {
            default :
            case "index" :
                $this->template->display('control_uac','user access control');
                break;
            case "view" ;
                $this->viewUac();
                break;
            case "agrup" ;
                $this->addGroup();
                break;
            case "ugrup" :
                $this->updateGroup($id);
                break;
            case "dgrup" :
                $this->deleteGroup($id);
                break;
            case "amenu" :
                $this->addMenu();
                break;
            case "umenu" :
                $this->updateMenu($id);
                break;
            case "dmenu" :
                $this->deleteMenu($id);
                break;
            case "aaccess" :
                $this->addAccess();
                break;
            case "daccess" :
                $this->deleteAccess($id);
                break;
        }

    }

    private function viewUac(){
        $data['groups'] = $this->control_model->getGroup();
        $data['menus'] = $this->control_model->getMenu();
        $this->load->view('xdata/d_uac',$data);
    }

    private function addGroup(){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('groupName','nama grup','required');
            $this->form_validation->set_rules('groupDesc','deskripsi grup','required');
            if($this->form_validation->run() == TRUE){
                $data = array('group_name'=>$this->input->post('groupName'),'group_desc'=>$this->input->post('groupDesc'));
                $this->control_model->addGroup($data);
                $notif= array('title'=>'UAC','message'=>'simpan grup sukses','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'UAC','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $data['grup']=array("g_name"=>"","g_desc"=>"","action"=>base_url('control/uac/agrup'));
            $this->load->view('xform/f_group',$data);
        }
    }
    private function updateGroup($id){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('groupName','nama grup','required');
            $this->form_validation->set_rules('groupDesc','deskripsi grup','required');
            if($this->form_validation->run() == TRUE){
                $data = array('group_name'=>$this->input->post('groupName'),'group_desc'=>$this->input->post('groupDesc'));
                $this->control_model->updateGroup($data);
                $notif= array('title'=>'UAC','message'=>'update grup sukses','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'UAC','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $group = $this->control_model->getSingleGroup($id);
            $data['grup']=array('g_name'=>$group['group_name'],'g_desc'=>$group['group_desc'],"action"=>base_url('control/uac/ugrup/'.$group['group_name']));
            $this->load->view('xform/f_group',$data);
        }
    }
    private function deleteGroup($id){
        $this->template->with_ajax();
        $do = $this->control_model->deleteGroup($id);
        if($do){
            $notif= array('title'=>'UAC','message'=>'hapus grup sukses','type'=>'success');
            echo json_encode($notif);
        }else{
            $notif= array('title'=>'UAC','message'=>'tidak dapat mengapus grup','type'=>'error');
            echo json_encode($notif);
        }
    }

    private function addMenu(){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('menu_title','nama menu','required');
            $this->form_validation->set_rules('menu_access','nama access','required');
            if($this->form_validation->run() == TRUE){
                $data = array(
                    "menu_id"=>$this->input->post('menu_id'),
                    "menu_title"=>$this->input->post('menu_title'),
                    "menu_class"=>$this->input->post('menu_class'),
                    "menu_method"=>$this->input->post('menu_method'),
                    "menu_param"=>$this->input->post('menu_param'),
                    "menu_access"=>$this->input->post('menu_access'),
                    "menu_show"=>$this->input->post('menu_show')
                );
                $this->control_model->addMenu($data);
                $notif= array('title'=>'UAC','message'=>'simpan menu sukses','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'UAC','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $data['menu']=array("menu_id"=>"","menu_title"=>"","menu_class"=>"","menu_method"=>"","menu_param"=>"","menu_access"=>"","menu_show"=>"1","action"=>base_url('control/uac/amenu'));
            $this->load->view('xform/f_menu',$data);
        }
    }
    private function updateMenu($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('menu_id','id menu','required');
            $this->form_validation->set_rules('menu_title','nama menu','required');
            $this->form_validation->set_rules('menu_access','nama access','required');
            if($this->form_validation->run() == TRUE){
                $data = array(
                    "menu_id"=>$this->input->post('menu_id'),
                    "menu_title"=>$this->input->post('menu_title'),
                    "menu_class"=>$this->input->post('menu_class'),
                    "menu_method"=>$this->input->post('menu_method'),
                    "menu_param"=>$this->input->post('menu_param'),
                    "menu_access"=>$this->input->post('menu_access'),
                    "menu_show"=>$this->input->post('menu_show')
                );
                $this->control_model->updateMenu($data);
                $notif= array('title'=>'UAC','message'=>'update menu sukses','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'UAC','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $menu = $this->control_model->getSingleMenu($id);
            $data['menu']=array(
                "menu_id"=>$menu['menu_id'],
                "menu_title"=>$menu['menu_title'],
                "menu_class"=>$menu['menu_class'],
                "menu_method"=>$menu['menu_method'],
                "menu_param"=>$menu['menu_param'],
                "menu_access"=>$menu['menu_access'],
                "menu_show"=>$menu['menu_show'],
                "action"=>base_url("control/uac/umenu/".$menu['menu_id']));
            $this->load->view('xform/f_menu',$data);
        }
    }
    private function deleteMenu($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->template->with_ajax();
        $do = $this->control_model->deleteMenu($id);
        if($do){
            $notif= array('title'=>'UAC','message'=>'menu telah di hapus','type'=>'success');
            echo json_encode($notif);
        }else{
            $notif= array('title'=>'UAC','message'=>'tidak dapat mengapus menu','type'=>'error');
            echo json_encode($notif);
        }
    }

    private function addAccess(){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('group_name','nama grup','required');
            $this->form_validation->set_rules('menu_access','nama access','required');
            if($this->form_validation->run() == TRUE){
                $data = array('group_name'=>$this->input->post('group_name'),'menu_access'=>$this->input->post('menu_access'));
                $this->control_model->addAccess($data);
                $notif= array('title'=>'UAC','message'=>'akses baru telah disimpan','type'=>'success');
                echo json_encode($notif);
            }else{
                $notif= array('title'=>'UAC','message'=>validation_errors(),'type'=>'error');
                echo json_encode($notif);
            }
        }else{
            $lgroup = $this->control_model->getListGroup();
            $lmenu = $this->control_model->getListMenu();
            $data['access']=array("menu_access"=>$lmenu,"group_name"=>$lgroup,"action"=>base_url('control/uac/aaccess'));
            $this->load->view('xform/f_access',$data);
        }
    }
    private function deleteAccess($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->template->with_ajax();
        $do = $this->control_model->deleteAccess($id);
        if($do){
            $notif= array('title'=>'UAC','message'=>'access telah di hapus','type'=>'success');
            echo json_encode($notif);
        }else{
            $notif= array('title'=>'UAC','message'=>'tidak dapat mengapus access','type'=>'error');
            echo json_encode($notif);
        }
    }


    //elFinder file explorer
    function explorer($act='index'){
        $this->load->library('elfinder_lib');
        switch($act){
            case 'index':
                $data['init'] = $this->elfinder_lib->init();
                $this->template->display('control_file_manager','File manager',$data);
                break;
            case 'elfinder':
                $this->elfinder();
                break;
            default :
                redirect(base_url('error/e404'));
        }

    }
    private function elfinder(){
        $this->elfinder_lib->connect();
    }


    //database backup
    function backup_db(){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('backup_type','Tipe Backup','required');
            if($this->form_validation->run()){
                $this->load->dbutil();
                $this->load->helper('file');
                switch($this->input->post('backup_type')){
                    case 'full' :
                        $filename = 'backup_db_full_'.date('Y_m_d_H_i_s');
                        $prefs = array(
                            'tables'      => array(),
                            'ignore'      => array(),
                            'format'      => 'txt',
                            'filename'    => '',
                            'add_drop'    => TRUE,
                            'add_insert'  => TRUE,
                            'newline'     => "\n"
                        );
                        $backup =& $this->dbutil->backup($prefs);
                        write_file('./mediafiles/bdb/'.$filename.'.sql', $backup);
                        $message = 'Backup penuh telah dibuat dengan nama : '.$filename.'.sql';
                        break;
                    case 'partial':
                        $filename = 'backup_db_partial_'.date('Y_m_d_H_i_s');
                        $prefs = array(
                            'tables'      => array(),
                            'ignore'      => array('user_member','user_group','user_access','user_menu'),
                            'format'      => 'txt',
                            'filename'    => '',
                            'add_drop'    => TRUE,
                            'add_insert'  => TRUE,
                            'newline'     => "\n"
                        );
                        $backup =& $this->dbutil->backup($prefs);
                        write_file('./mediafiles/bdb/'.$filename.'.sql', $backup);
                        $message = 'Backup sebagian telah dibuat dengan nama : '.$filename.'.sql';
                        break;
                    default :
                        $message = 'Tidak dapat membuat backup';
                        break;
                }
                $notif= array('title'=>'Backup DB','message'=>$message,'type'=>'info');
            }else{
                $notif= array('title'=>'Backup DB','message'=>validation_errors(),'type'=>'success');
            }
            echo json_encode($notif);
        }else{
            $this->load->view('xform/f_backup_db');
        }

    }


    //system backup
    function backup_system(){
        $this->template->with_ajax();
        if($_POST){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('backup_type','Tipe Backup','required');
            if($this->form_validation->run()){

                switch($this->input->post('backup_type')){
                    case 'app' :
                        $filename = 'backup_system_application_'.date('Y_m_d_H_i_s');
                        $this->load->library('zip');
                        $this->zip->read_dir('./app/');
                        $this->zip->archive('./mediafiles/bsystem/'.$filename.'.zip');
                        $notif= array('title'=>'Backup System','message'=>'Backup system telah dibuat dengan nama : '.$filename.'.zip','type'=>'info');
                        break;
                    case 'assets':
                        $filename = 'backup_system_assets_'.date('Y_m_d_H_i_s');
                        $this->load->library('zip');
                        $this->zip->read_dir('./assets/');
                        $this->zip->archive('./mediafiles/bsystem/'.$filename.'.zip');
                        $notif= array('title'=>'Backup System','message'=>'Backup system telah dibuat dengan nama : '.$filename.'.zip','type'=>'info');
                        break;
                    default :
                        $notif= array('title'=>'Backup System','message'=>'Gagal Membuat Backup System','type'=>'info');
                        break;
                }
            }else{
                $notif= array('title'=>'Backup DB','message'=>validation_errors(),'type'=>'success');
            }
            echo json_encode($notif);
        }else{
            $this->load->view('xform/f_backup_system');
        }
    }


    //widget manager
    function widget($act="list",$par=null){
        switch($act){
            case "list":
                $this->_widget_list();
                break;
            case "add":
                $this->_widget_add();
                break;
            case "edit":
                $this->_widget_edit($par);
                break;
            case "drop":
                $this->_widget_drop($par);
                break;
        }
    }
    private function _widget_list(){
        $data['widget_list'] = $this->control_model->widget_list();
        $this->template->display('control_widget','Widget Manager',$data);
    }
    private function _widget_add(){
        if($_POST){
            if($this->_validate_widget()){
                $data=array(
                    'w_name'=>str_replace(' ','',$this->input->post('w_name')),
                    'w_title'=>$this->input->post('w_title'),
                    'w_for'=>$this->input->post('w_for'),
                );
                $this->control_model->addWidget($data);
                $notif= array('title'=>'Sukses','message'=>'widget "'.$this->input->post('w_title').'" telah disimpan','type'=>'success');
            }else{
                $notif= array('title'=>'Sukses','message'=>validation_errors(),'type'=>'warning');
            }
            echo json_encode($notif);
        }else{

            $data['widget']=array(
                'w_id'=>'0',
                'w_title'=>'',
                'w_for'=>explode(',',''),
                'w_name'=>''
            );
            $data['group'] =array();
            foreach($this->control_model->getListGroup() as $key=>$value) {
                $data['group'][] = $value['group_name'];
            }
            array_push($data['group'],'all');
            $data['action'] = base_url('control/widget/add');
            $this->load->view('xform/f_widget',$data);
        }
    }
    private function _widget_edit($id){
        if($_POST){
            if($this->_validate_widget(TRUE)){
                $data=array(
                    'w_name'=>str_replace(' ','',$this->input->post('w_name')),
                    'w_title'=>$this->input->post('w_title'),
                    'w_for'=>$this->input->post('w_for'),
                    'w_id'=>$this->input->post('w_id'),
                );
                $this->control_model->editWidget($data);
                $notif= array('title'=>'Sukses','message'=>'widget "'.$this->input->post('w_title').'" telah diubah','type'=>'success');
            }else{
                $notif= array('title'=>'Sukses','message'=>validation_errors(),'type'=>'warning');
            }
            echo json_encode($notif);
        }else{
            $gw = $this->control_model->getSingleWidget($id);
            $data['widget']=array(
                'w_id'=>$gw['w_id'],
                'w_title'=>$gw['w_title'],
                'w_for'=>explode(',',$gw['w_for']),
                'w_name'=>$gw['w_name']
            );
            $data['group'] =array();
            foreach($this->control_model->getListGroup() as $key=>$value) {
                $data['group'][] = $value['group_name'];
            }
            array_push($data['group'],'all');
            $data['action'] = base_url('control/widget/edit/'.$id);
            $this->load->view('xform/f_widget',$data);
        }
    }

    private function _validate_widget($id=FALSE){
        $this->load->library('form_validation');
        if($id){
            $this->form_validation->set_rules('w_id','id','required|integer|max_length[11]');
        }
        $this->form_validation->set_rules('w_name','Nama file','required');
        $this->form_validation->set_rules('w_title','Judul Widget','required');
        $this->form_validation->set_rules('w_for','Group','required');
        if($this->form_validation->run()==TRUE){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    private function _widget_drop($id){
        if(empty($id)){echo file_get_contents(base_url('error/e500')); exit;}
        $this->control_model->dropWidget($id);
        $notif= array('title'=>'Sukses','message'=>'Widget Telah dihapus','type'=>'success');
        echo json_encode($notif);
    }

}