<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("m_estimation");
    }

    function index() {
        $project_array = $this->m_estimation->return_projects();
        $data['project_list'] = $project_array;

        $this->form_validation->set_rules('project_values', 'Select Project ', 'required');
        if ($this->input->post()) {
            if ($this->form_validation->run() == true) {
                $values = $this->input->post("project_values");
                $project = explode('|', $values);
                $this->export_excel($project);
            }
        }
        $this->template->set_layout("templates/layouts/admin_layout/admin_layout");
        $this->template->render("v_export", $data);
    }

    function export_excel($project) {
        if ($project) {
            $this->load->library('excel');
            $name = $project[1];
            $excel_data_object = $this->m_estimation->export_estimation($name);
            $objPHPExcel = new PHPExcel();
            //        $objPHPExcel->getProperties()->setCreator("Shobin Lamichhane");
            //        $objPHPExcel->getProperties()->setTitle($name);
            //        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
            //        $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
            //        $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
            //        $objPHPExcel->getProperties()->setCategory("Test result file");
            //demo
            //$objPHPExcel->setActiveSheetIndex(0);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            //set colors
            //iterate through excel data
            $rowcount = 1;
            if ($excel_data_object) {

                foreach ($excel_data_object as $row) {

                    $metadata = unserialize($row->metadata);
                    if ($rowcount == 1) {
                        $objWorksheet->setCellValue('A1', "Tasks");
                        $objWorksheet->setCellValue('B1', "Start ");
                        $objWorksheet->setCellValue('C1', "Finish");
                        $objWorksheet->setCellValue('D1', "Planned Hours");
                        $objWorksheet->setCellValue('E1', "Sales Hours");
                        $objWorksheet->setCellValue('F1', "Estimated Hours");
                        $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
                        $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize("12");
                    } else {
                        $objWorksheet->setCellValue('A' . $rowcount, $row->task);
                        $objWorksheet->setCellValue('B' . $rowcount, $row->start);
                        $objWorksheet->setCellValue('C' . $rowcount, $row->finish);
                        $objWorksheet->setCellValue('D' . $rowcount, $row->planned_hours);
                        $objWorksheet->setCellValue('E' . $rowcount, $row->sales_hours);
                        $objWorksheet->setCellValue('F' . $rowcount, $row->estimated_hours);
                    }
                    if (isset($metadata['bold']) && !empty($metadata['bold'])) {
                        $objPHPExcel->getActiveSheet()->getStyle("A" . $rowcount . ":F" . $rowcount)->getFont()->setBold(true);
                    }
                    //set cell intent
                    $objWorksheet->getStyle('A' . $rowcount)->getAlignment()->setIndent($metadata['outline']);


                    if ($rowcount != 1) {
                        if ($metadata['color_code'] != '000000') {
                            $objWorksheet->getStyle('A' . $rowcount . ':F' . $rowcount)->getFill()
                                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                    ->getStartColor()
                                    ->setARGB($metadata['color_code']);
                        }
                        $objWorksheet->getRowDimension($rowcount)->setOutlineLevel($metadata['outline']);
                    }

                    $rowcount++;
                }
                //black boarder
                $objWorksheet->getStyle("A1:F" . $rowcount)->applyFromArray(
                        array(
                            'font' => array('name' => 'Arial',
                                'size' => 10
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array('rgb' => '000000')
                                )
                            )
                        )
                );
                //set cell width
                $objWorksheet->getColumnDimension('A')->setWidth(50);
                $objWorksheet->getColumnDimension('B')->setWidth(15);
                $objWorksheet->getColumnDimension('C')->setWidth(15);
                $objWorksheet->getColumnDimension('D')->setWidth(15);
                $objWorksheet->getColumnDimension('E')->setWidth(15);
                $objWorksheet->getColumnDimension('F')->setWidth(15);

                //cell intend
            } else {
                echo "nothing to export";
                die();
            }

            //headers for saving
            ob_end_clean();
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        }
    }

    function export_report()
    {
      $start_date = $this->input->get("start_date");
      $end_date = $this->input->get("end_date");
      $name=$start_date.'to'.$end_date;
      $this->load->library('excel');
      $excel_data_object = $this->m_estimation->all_reports($start_date,$end_date);
      $objPHPExcel = new PHPExcel();
      $objWorksheet = $objPHPExcel->getActiveSheet();
      $rowcount = 1;
      if ($excel_data_object) {
          foreach ($excel_data_object as $row) {
              // $metadata = unserialize($row->metadata);
              if ($rowcount == 1) {
                  $objWorksheet->setCellValue('A1', "S.No");
                  $objWorksheet->setCellValue('B1', "Project Name ");
                  $objWorksheet->setCellValue('C1', "Project Date");
                  $objWorksheet->setCellValue('D1', "Total Estimated Hours");
                  $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
                  $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize("12");
                  $rowcount++;
              }
              $objWorksheet->setCellValue('A' . $rowcount, $rowcount-1);
              $objWorksheet->setCellValue('B' . $rowcount, $row->project_name);
              $objWorksheet->setCellValue('C' . $rowcount, $row->project_date);
              $objWorksheet->setCellValue('D' . $rowcount, $row->total_estimated_hours);
              if (isset($metadata['bold']) && !empty($metadata['bold'])) {
                  $objPHPExcel->getActiveSheet()->getStyle("A" . $rowcount . ":D" . $rowcount)->getFont()->setBold(true);
              }
              if ($rowcount != 1) {
                  $objWorksheet->getStyle('A' . $rowcount . ':D' . $rowcount)->getFill()
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('ffffff');
              }
              $rowcount++;
          }
          //black boarder
          $objWorksheet->getStyle("A1:D" . $rowcount)->applyFromArray(
                  array(
                      'font' => array('name' => 'Arial',
                          'size' => 10
                      ),
                      'borders' => array(
                          'allborders' => array(
                              'style' => PHPExcel_Style_Border::BORDER_THIN,
                              'color' => array('rgb' => '000000')
                          )
                      )
                  )
          );
          //set cell width
          $objWorksheet->getColumnDimension('A')->setWidth(5);
          $objWorksheet->getColumnDimension('B')->setWidth(50);
          $objWorksheet->getColumnDimension('C')->setWidth(30);
          $objWorksheet->getColumnDimension('D')->setWidth(30);
          //cell intend
      } else {
          echo "nothing to export";
          die();
      }

      //headers for saving
      ob_end_clean();
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output');
      exit;
    }
}

?>
