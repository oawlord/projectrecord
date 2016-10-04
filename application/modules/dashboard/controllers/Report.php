<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("m_estimation");
        $this->load->library('pagination');
    }
    function index()
    {
    }
    function daily_report($id=0)
    {
      $config['base_url'] = 'http://localhost/projectrecord/dashboard/report/daily_report';
      $config['total_rows'] = count($this->m_estimation->all_daily_reports());
      $config['per_page'] = 10;
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = 'First';
      $config['last_link'] = 'Last';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '&laquo';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '&raquo';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $offset = $id;//($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

      $data['links'] = $this->pagination->create_links();
      $data['title'] = "Daily Report";
      $data['records']=$this->m_estimation->daily_reports($config['per_page'],$offset);
      $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
      $this->template->render("v_report",$data);
    }
}
