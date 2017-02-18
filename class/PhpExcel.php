<?php

class PhpExcel{
    public function __construct() {
     /*µ¼ÈëphpExcelºËÐÄÀà    ×¢Òâ £ºÄãµÄÂ·¾¶¸úÎÒ²»Ò»Ñù¾Í²»ÄÜÖ±½Ó¸´ÖÆ*/
        include_once('../lib/PHPExcel/PHPExcel.php');
    }
    /**
    * ¶ÁÈ¡excel $filename Â·¾¶ÎÄ¼þÃû $encode ·µ»ØÊý¾ÝµÄ±àÂë Ä¬ÈÏÎªutf8
    *ÒÔÏÂ»ù±¾¶¼²»ÒªÐÞ¸Ä
    */	
    public function read($filename,$encode='utf-8'){
            /* 
    		$objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($filename);
            $objWorksheet = $objPHPExcel->getActiveSheet();
    		$highestRow = $objWorksheet->getHighestRow(); 
    ¡¡¡¡¡¡ 	$highestColumn = $objWorksheet->getHighestColumn(); 
    		//$highestColumn=4;
    ¡¡¡¡    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
     ¡¡¡¡   $excelData = array(); 
     ¡¡¡¡¡¡	for ($row = 1; $row <= $highestRow; $row++) { 
        ¡¡¡¡  for ($col = 0; $col < $highestColumnIndex; $col++) { 
                     $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
               } 
             } 
            return $excelData; 
    		*/
    		$objPHPExcel = PHPExcel_IOFactory::load($filename);
    		$sheetCount = $objPHPExcel->getSheetCount();
    		for($i=0;$i<$sheetCount;$i++){
    			$data = $objPHPExcel-getSheet($i);
    		}
    		return $data;
        }   
	
}