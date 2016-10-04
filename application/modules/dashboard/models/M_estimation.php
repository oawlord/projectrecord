<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_estimation extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert_estiamtion($data_array = 0, $project_name, $team_id = 1) {

        $this->db->trans_start();
        $project_data = array(
            'team_id' => $team_id,
            'project_name' => $project_name,
            'project_description' => ""
        );


        $project_result = $this->db->insert("projects", $project_data);
        if ($project_result) {
            $project_id = $this->db->insert_id();
        }
        if (!$project_result) {
            $error_162 = $this->db->error()['code'];
        }

        if (isset($project_id) AND ( !empty($project_id))) {
            $data_index = 2;
            foreach ($data_array as $data) {
                /* if (isset($data['data']['tasks']) && !empty($data['data']['tasks'])) {
                  $task = $data['data']['tasks'];
                  } else {
                  $task = null;
                  }
                  if (isset($data['data']['start']) && !empty($data['data']['start'])) {
                  $start = $data['data']['start'];
                  } else {
                  $start = null;
                  }
                  if (isset($data['data']['finish']) && !empty($data['data']['finish'])) {
                  $finish = $data['data']['finish'];
                  } else {
                  $finish = null;
                  }
                  if (isset($data['data']['planned_hours']) && !empty($data['data']['planned_hours'])) {
                  $planned_hours = $data['data']['planned_hours'];
                  } else {
                  $planned_hours = null;
                  }
                  if (isset($data['data']['sales_hours']) && !empty($data['data']['sales_hours'])) {
                  $sales_hours = $data['data']['sales_hours'];
                  } else {
                  $sales_hours = null;
                  }
                  if (isset($data['data']['estimated_hours']) && !empty($data['data']['estimated_hours'])) {
                  $estimated_hours = $data['data']['estimated_hours'];
                  } else {
                  $estimated_hours = null;
                  }
                  if (isset($data['metadata']) && !empty($data['metadata'])) {
                  $metadata = $data['metadata'];
                  } else {
                  $metadata = null;
                  }

                  $args = array(
                  'project_id' => $project_id,
                  'task' => $task,
                  'start' => $start,
                  'finish' => $finish,
                  'planned_hours' => $planned_hours,
                  'sales_hours' => $sales_hours,
                  'estimated_hours' => $estimated_hours,
                  'metadata' => $metadata
                  ); */
//                $args=$data[$data_index];
//                 echo"Data in db will be";
                $args = array("project_id" => $project_id) + $data['data'];

                $this->db->insert("project_estimation_tasks", $args);
            }
        }

        //insert contents from here

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            if (isset($error_162) && !empty($error_162)) {
                var_dump($error_162);
            }

            die("trx failed");
            return false;
        }
    }

    //for exporting the project
    function return_projects() {
        $this->load->database();
        $query = $this->db->select("project_name,project_id")->get("projects");
        if($query->result()){
            return $query->result();
        }
    }
    //for daily report
    function all_reports($start_date, $end_date) {
        $this->load->database();
        try{
          $date= Date('Y-m-d');
          $result = $this->db->query("SELECT p.project_name, p.project_date, sum(pet.estimated_hours) as total_estimated_hours FROM `project_estimation_tasks` as pet join projects as p on pet.project_id = p.project_id where p.project_date between '$start_date' and '$end_date' group by project_name");
          // $result = $this->db->query("SELECT p.project_name, p.project_date, pet.estimated_hours as total_estimated_hours FROM project_estimation_tasks as pet join projects as p on pet.project_id = p.project_id");
          $result = $result->result();
          return $result;
        }
        catch(Exception $e)
        {
          return $e;
        }
    }
    function reports($limit, $offset, $start_date, $end_date) {
        $this->load->database();
        $date= Date('Y-m-d');
        try{
          $result = $this->db->query("SELECT p.project_name, p.project_date, sum(pet.estimated_hours) as total_estimated_hours FROM `project_estimation_tasks` as pet join projects as p on pet.project_id = p.project_id where p.project_date between '$start_date' and '$end_date' group by project_name limit $limit offset $offset ");
          // $result = $this->db->query("SELECT p.project_name, p.project_date, pet.estimated_hours as total_estimated_hours FROM project_estimation_tasks as pet join projects as p on pet.project_id = p.project_id limit $limit offset $offset");
          $result = $result->result();
          return $result;
        }
        catch(Exception $e)
        {
          return $e;
        }
    }
}
