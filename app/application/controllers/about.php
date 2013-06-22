<?php
/**
 * sinhs.
 * about - credits :: controller
 * User: mochammad c. chuluq
 * Date: 08/06/13
 * Time: 10:54
 * Chraven Systems dev. labs.
 */
class About extends Member_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->template->display('about','Tentang SINHS');
    }
}