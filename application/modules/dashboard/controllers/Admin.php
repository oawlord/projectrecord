<?php defined('BASEPATH') OR exit('No direct script access allowed');
class admin extends Admin_Controller{
    public function __construct() {
        parent::__construct();
    }
    function index(){
    
       // echo"admin";
        //echo"<a href=".base_url("login/admin/logout").">Logout</a>";
        $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
        $this->template->render("v_admin_index");
    }
    public function upload_estimation(){
        
    }
    public function upload_production(){
        
    }
    public function generate_report(){
        
    }
}