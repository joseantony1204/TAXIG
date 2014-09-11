<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
					->setCreator("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setLastModifiedBy("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setTitle("REPORTE ")
					->setSubject("REPORTE")
					->setDescription("REPORTE")
					->setKeywords("REPORTE, ")
					->setCategory("PQR");
					

$styleArray = array(
  'font' => array(
    'bold' => true,
    ),
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    ),
  'borders' => array(
    'top' => array(
     'style' => PHPExcel_Style_Border::BORDER_THIN,
      ),
    ),
  'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
       'rotation' => 90,
        'startcolor' => array(
          'argb' => 'FFA0A0A0',
           ),
        'endcolor' => array(
         'argb' => 'FFFFFFFF',
         ),
      ),
 );

$styleArrayB = array(
  'borders' => array(
   'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THICK,
   'color' => array('argb' => '000000'),
   ),
  ),
);

$styleArrayBInt = array(
  'borders' => array(
   'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_DASHED,
   'color' => array('argb' => '000000'),
   ),
  ),
);

$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'CAMARA DE COMERCIO DE LA GUAJIRA')
								 ->setCellValue('B2', 'SISTEMA DE PQRS')
								 ->setCellValue('B3', 'RELACION PQR EN UN RANGO DE FECHA ')
								 ->setCellValue('B6', 'FECHA : ')
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'NUM. RADICADO')
								 ->setCellValue('D8', 'IDENTIFICACION') 
								 ->setCellValue('E8', 'NOMBRE COMPLETO')
								 ->setCellValue('F8', 'AFILIADO')
								 ->setCellValue('G8', 'TIPO DE MANIFESTACION')
								 ->setCellValue('H8', 'SERVICIO')
								 ->setCellValue('I8', 'CONTENIDO DE MANIFESTACION')
								 ->setCellValue('J8', 'SUGERENCIAS')
								 ->setCellValue('K8', 'FECHA DE INGRESO') 
								 ->setCellValue('L8', 'RESPUESTA')
								 ->setCellValue('M8', 'FECHA DE RESPUESTA');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:M8')->applyFromArray($styleArrayB);

foreach($peticiones as $data){
 
 $criteria = new CDbCriteria;
 $criteria->condition = 'PEQR_ID = '.$data["PEQR_ID"];
 $Respuestaspqr = Respuestaspqr::model()->find($criteria);
 $Respuestaspqr = Respuestaspqr::model()->findByPk($Respuestaspqr->RPQR_ID);
 
 if($data["PERS_AFILIADO"]==0){ $a= "NO"; }else{ $a="SI";}
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'M'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["PEQR_ID"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PERS_NOMBRECOMPLETO"]);       
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $a);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["TIMA_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data["TIDR_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["PEQR_CONTENIDO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data["PEQR_SUGERENCIAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $data["PEQR_FECHAREGISTRO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $Respuestaspqr->RPQR_DESCRIPCION);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $Respuestaspqr->RPQR_FECHAINGRESO);
 
 $fxls++;
 $item++; 
}


  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
  
/*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $dependencia = substr('REPORTE_GENERAL_DE_PQRS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_GENERAL_DE_PQRS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_GENERAL_DE_PQRS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();


?>