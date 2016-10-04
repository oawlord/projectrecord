<?php

class Base_Controller extends MX_Controller {

    public $autoload = array(
        'helper' => array('url', 'form', 'html'),
        'libraries' => array('form_validation', 'Template')
    );

    function __construct() {
        parent::__construct();
    }

}

class Admin_Controller extends Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('auth/ion_auth');
        if ($this->ion_auth->logged_in() == TRUE) {
            if ($this->ion_auth->is_admin() === FALSE) {
                redirect('dashboard/admin');
            }
        } else {
            redirect('login/admin');
        }
    }

}

class Front_Controller extends Base_Controller {

    function __construct() {
        parent::__construct();
    }

}
