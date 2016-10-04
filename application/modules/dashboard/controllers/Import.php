<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class import extends Admin_Controller {
    public $data;
    public $validation;
    function __construct() {
        parent::__construct();
        $this->load->model("m_estimation");
    }

    function index() {

        $this->form_validation->set_rules('project_name', 'Project Name ', 'required');
        $this->form_validation->set_rules('project_group', 'Project group ', 'required');
        //$this->form_validation->
        //set_rules('estimation_file', 'Project Estimation File', 'callback_file_check');

        if ($this->input->post()) {

            if ($this->form_validation->run() == true) {
		
                $this->read_file_contents();
            } else {
                
            }
        }
        $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
        $this->template->render("v_import");
        //var_dump($this->input->post());
    }

    function read_file_contents() {

        if ((!empty($_FILES) && (!empty($_FILES["estimation_file"])))) {
            $this->load->library('excel');
            $inputFileTmpName = $_FILES["estimation_file"]["tmp_name"];
            try {
                $excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileTmpName);
                $objPHPExcel = $excelReader->load($inputFileTmpName);
            } catch (Exception $e) {
                die($e->getMessage());
            }

            $objWorksheet = $objPHPExcel->getSheet(0); //make worksheet obj
            $highestRow = $objWorksheet->getHighestRow(); //get highest row
            $highestColumn = $objWorksheet->getHighestColumn(); //get highest col
            
            $rowcount = 1; //count no of rows
            $data_array = array();
            foreach ($objWorksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                //$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
                // even if it is not set.
                // By default, only cells
                // that are set will be
                // iterated.
                $colcount = 1;
                $level = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel();
                $cell_array = array();
                $meta_data = array();
                foreach ($cellIterator as $cell) {
                    if ($colcount == 1) {
                        $cell_array['task'] =( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else if ($colcount == 2) {
                        $cell_array['start'] = ( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else if ($colcount == 3) {
                        $cell_array['finish'] = ( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else if ($colcount == 4) {
                        $cell_array['planned_hours'] = ( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else if ($colcount == 5) {
                        $cell_array['sales_hours'] = ( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else if ($colcount == 6) {
                        $cell_array['estimated_hours'] = ( ( $cell->getFormattedValue()) ? $cell->getFormattedValue():null);
                    } else {
                        
                    }
                    if ($colcount == 1) {
                        $meta_data['color_code'] = $objWorksheet->getStyle($cell->getCoordinate())->getFill()->getStartColor()->getRGB();
                        $meta_data['bold'] = $objWorksheet->getStyle($cell->getCoordinate())->getFont()->getBold();
                        $meta_data['outline'] = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel() + 1;
			$cell_array['metadata']= serialize($meta_data);
                    }

                    $colcount++;
                }
                if ($rowcount != 1) {//store from 2nd row
                    $data_array[$rowcount]['data'] = $cell_array;
                   // $data_array[$rowcount]['data'] = serialize($meta_data);
                }
                $rowcount++;
            }
            //insert project
            $project_name = $this->input->post("project_name");
            $team_id = $this->input->post("project_group");
            $transaction_status = $this->m_estimation->insert_estiamtion($data_array, $project_name, $team_id);
                  }
    }



    // function check(){
    //     $project_name="This is project";
    //     $transaction_status=$this->m_estimation->insert_estiamtion($data_array=0,$project_name,$team_id=1);
    //     if($transaction_status==1062){
    //         echo"Project already exists";
    //     }
    // }
}
