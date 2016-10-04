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
      $start_date = date('Y-m-d').' 00:00:00';
      $end_date = date('Y-m-d').' 23:59:59';
      $config['base_url'] = 'http://localhost/projectrecord/dashboard/report/daily_report';
      $config['total_rows'] = count($this->m_estimation->all_reports($start_date,$end_date));
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
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;
      $data['records']=$this->m_estimation->reports($config['per_page'],$offset,$start_date,$end_date);
      $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
      $this->template->render("v_report",$data);
    }

    function weekly_report($id=0)
    {
      $start_date = date('Y-m-d',time()+( 0 - date('w'))*24*3600).' 00:00:00';
      $end_date = date('Y-m-d').' 23:59:59';
      $config['base_url'] = 'http://localhost/projectrecord/dashboard/report/weekly_report';
      $config['total_rows'] = count($this->m_estimation->all_reports($start_date,$end_date));
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
      $data['title'] = "This Week Report";
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;
      $data['records']=$this->m_estimation->reports($config['per_page'],$offset,$start_date,$end_date);
      $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
      $this->template->render("v_report",$data);
    }

    function monthly_report($id=0)
    {
      $start_date = date('Y-m-01').' 00:00:00';
      $end_date = date('Y-m-d').' 23:59:59';
      $config['base_url'] = 'http://localhost/projectrecord/dashboard/report/monthly_report';
      $config['total_rows'] = count($this->m_estimation->all_reports($start_date,$end_date));
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
      $data['title'] = "This Month Report";
      $data['download_link'] = "export_monthly";
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;
      $data['records']=$this->m_estimation->reports($config['per_page'],$offset,$start_date,$end_date);
      $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
      $this->template->render("v_report",$data);
    }

    function yearly_report($id=0)
    {
      $start_date = date('Y-01-01').' 00:00:00';
      $end_date = date('Y-m-d').' 23:59:59';
      $config['base_url'] = 'http://localhost/projectrecord/dashboard/report/yearly_report';
      $config['total_rows'] = count($this->m_estimation->all_reports($start_date,$end_date));
      $config['per_page'] = 15;
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
      $data['title'] = "This Year Report";
      $data['start_date'] = $start_date;
      $data['end_date'] = $end_date;
      $data['records']=$this->m_estimation->reports($config['per_page'],$offset,$start_date,$end_date);
      $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
      $this->template->render("v_report",$data);
    }
}
