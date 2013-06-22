<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Template - custom library untuk mengolah template aplikasi
 * User: mochammad c. chuluq
 * Date: 18/05/13
 * Time: 19:37
 * Chraven Systems dev. labs.
 */
class Template {
    //template path
    private $path = 'template';
	
    //nama tema, jika ada ??? :)
    public $theme = 'default';
	
    //bagian2 file template
    private $embedded = 'embed';
    private $header = 'header';
    private $head_area = 'head_area';
    private $sidebar = 'sidebar';
    private $footer = 'footer';

    //default background theme
    private $default_bg = "styleGrid";



    function __construct(){
        $this->ci =& get_instance();
    }

    function is_ajax(){
        return ( $this->ci->input->server('HTTP_X_REQUESTED_WITH')&&( $this->ci->input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
    }
    function with_ajax(){
        if($this->is_ajax()){
            return TRUE;
        }else{
            redirect(base_url('error/e405'));
        };
    }

    function display($page,$title,$data=null){
        $data['_user_bg'] = $this->getBgTheme();
        $data['_title']=$title;
        $data['_embed']=$this->ci->load->view($this->path.'/'.$this->theme.'/'.$this->embedded,$data,true);
        $data['_header']=$this->ci->load->view($this->path.'/'.$this->theme.'/'.$this->header,$data,true);
        $data['_sidebar']=$this->ci->load->view($this->path.'/'.$this->theme.'/'.$this->sidebar,$data,true);
        $data['_footer']=$this->ci->load->view($this->path.'/'.$this->theme.'/'.$this->footer,$data,true);
        $data['_head_area']=$this->ci->load->view($this->path.'/'.$this->theme.'/'.$this->head_area,$data,true);
        $this->ci->load->view($page,$data);
    }
    function getBgTheme(){
        if($this->ci->session->userdata('user_bg')){
            return $this->ci->session->userdata('user_bg');
        }else{
            return $this->default_bg;
        }
    }
}