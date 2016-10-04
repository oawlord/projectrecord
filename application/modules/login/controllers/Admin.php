<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Base_Controller {

    public $data;

    public function __construct() {
        parent ::__construct();
        $this->load->library('auth/ion_auth');
       
    }

    function index() {
        
        if ($this->ion_auth->logged_in() == TRUE) {
            if ($this->ion_auth->is_admin() === TRUE) {
                redirect('dashboard/admin');
            }
        } 
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('pwd', 'Password', 'required');
        if ($this->form_validation->run() == true) {
           
            if ($this->ion_auth->login($this->input->post('email'), $this->input->post('pwd'))) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('dashboard/admin', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login/admin', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
           
        } else {
            //$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            // Get username from session and form
            //$this->data['username'] = $this->input->post('email') ? $this->input->post('email') : get_cookie('identity');
            //$this->data['password'] = $this->input->post('pwd') ? '' : get_cookie('pwd');
        }
        //$this->load->view("v_login_admin", $this->data);
        $this->template->set_layout("templates/layouts/login/layout");
        $this->template->render('v_login');
    }

    public function logout() {
        $this->data['title'] = "Logout";
        // log the user out
        $logout = $this->ion_auth->logout();
        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('login/admin', 'refresh');
    }

}
