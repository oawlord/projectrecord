<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class readxls extends Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->model('m_estimation');
    }

    function test(){
        $this->estimation->insert_estiamtion();
    }
    function index() {
        
        $rand= rand(  100 ,  1000 );
        $project_name="This is project".$rand; 
        $inputFileTmpName = $_SERVER['DOCUMENT_ROOT'] . "projectrecord/assets/Sample Project estimation.xlsx";
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
        foreach ($objWorksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set.
            // By default, only cells
            // that are set will be
            // iterated.
            $colcount = 1;
            $level = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel();
            $cell_array = array();
            $meta_data = array();
            foreach ($cellIterator as $cell) {

                $cell_array[] = $cell->getFormattedValue();
                if ($colcount == 1) {
                    $meta_data['color_code'] = $objWorksheet->getStyle($cell->getCoordinate())->getFill()->getStartColor()->getRGB();
                    $meta_data['bold'] = $objWorksheet->getStyle($cell->getCoordinate())->getFont()->getBold();
                    $meta_data['outline'] = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel() + 1;
                }
            }
            //var_dump($cell_array, $meta_data);
            $this->m_estimation->insert_estiamtion($project_name,$cell_array,$meta_data);
            
            $rowcount++;
        }
    }

    function demo() {
        $inputFileTmpName = $_SERVER['DOCUMENT_ROOT'] . "projectrecord/assets/Sample Project estimation.xlsx";
        try {
            $excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileTmpName);
            $objPHPExcel = $excelReader->load($inputFileTmpName);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $objWorksheet = $objPHPExcel->getSheet(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $arrayData[$worksheet->getTitle()] = $worksheet->toArray();
        }

        //        var_dump($arrayData);
        //        die();
        //         $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        //         var_dump($sheetData);
        //         die();
        //$color = $worksheet->getStyle(0, 2);
        //var_dump($color);
        //die();
        //  Loop through each row of the worksheet in turn
        //for ($row = 1; $row <= $highestRow; $row++) {
        //    //var_dump($row);
        //    //  Read a row of data into an array
        //    // rangeToArray($pRange = 'A1', $nullValue = null, $calculateFormulas = true, $formatData = true, $returnCellRef = false);
        //    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE);
        //    $level = $objPHPExcel->getActiveSheet()->getRowDimension($row)->getOutlineLevel();
        //    $color = $objPHPExcel->getActiveSheet()->getStyle($row)->getFill()->getStartColor()->getARGB();
        //    //$collapsed= $sheet->getRowDimension($row)->getCollapsed();
        //    //var_dump($collapsed);
        //    //var_dump($level);
        //    var_dump($rowData);
        //}
        echo'<style>table, th, td {border: 1px solid black;}</style>';
        echo '<table>' . "\n";
        $rowcount = 1;

        foreach ($objWorksheet->getRowIterator() as $row) {
            echo '<tr>' . "\n";
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set.
            // By default, only cells
            // that are set will be
            // iterated.
            $level = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel();
            echo '<td>' . $level . '</td>';
            $colcount = 1;

            $metadata = array();
            $cell_values;
            $color = $objWorksheet->getStyle($rowcount)->getFill()->getStartColor()->getARGB();
            //var_dump($color);
            foreach ($cellIterator as $cell) {
                $value = $cell->getFormattedValue();

                $outline = $objWorksheet->getRowDimension($rowcount)->getOutlineLevel();
                $comment = $objWorksheet->getComment($cell->getCoordinate())->getText();

                $colorCode = $objWorksheet->getStyle($cell->getCoordinate())->getFill()->getStartColor()->getRGB();

                //$color = $objWorksheet->getStyle($rowcount)->getFill()->getStartColor()->getARGB();
                //$color="00";

                if (!$colorCode || $colorCode != "000000") {
                    echo '<td bgcolor=' . $colorCode . '<br>';
                } else {
                    echo"<td >";
                    if ($value != '') {
                        echo $value . '<br>';
                    }
                }
                //echo 'Cell Color:' . $color . '<br>';
                if ($comment != '') {
                    echo 'Cell Comment' . $comment . '<br>';
                }
                echo '</td>' . "\n";
                $colcount++;
            }
            $rowcount++;
        }
    }

    function ashtml() {
        echo"Excel as html";
        $inputFileTmpName = $_SERVER['DOCUMENT_ROOT'] . "projectrecord/assets/Sample Project estimation.xlsx";
        try {
            $excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileTmpName);
            $objPHPExcel = $excelReader->load($inputFileTmpName);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
        //var_dump($objWriter);
        //$objWriter->setSheetIndex($i);  //To output a specific sheet
        $objWriter->save('php://output');
        //$objWriter->save('example.html');
    }

    //    function asr(){
    //        try {
    //            $excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileTmpName);
    //            $objPHPExcel = $excelReader->load($inputFileTmpName);
    //        } catch (Exception $e) {
    //            die($e->getMessage());
    //        }
    //        
    //    }
}
