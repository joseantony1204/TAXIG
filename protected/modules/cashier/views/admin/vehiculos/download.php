<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

 function NombreMes($m)
 {
   switch ($m){
    case 1: return "Enero";
    case 2: return "Febrero";
    case 3: return "Marzo";
    case 4: return "Abril";
    case 5: return "Mayo";
    case 6: return "Junio";
    case 7: return "Julio";
    case 8: return "Agosto";
    case 9: return "Septiembre";
    case 10: return "Octubre";
    case 11: return "Noviembre";
    case 12: return "Diciembre";
   }
  }

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
					->setCreator("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setLastModifiedBy("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setTitle("REPORTE SERVICIOS")
					->setSubject("REPORTE")
					->setDescription("REPORTE")
					->setKeywords("REPORTE, SERVICIOS")
					->setCategory("SERVICIOS");
					

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
  'font' => array(
    'bold' => true,
    ),
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

$mesC = nombreMes($Informescumpleanios->INFO_MES);

$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PROPIETARIOS DE VEHICULOS')
								 
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'IDENTIDAD')
								 ->setCellValue('D8', 'NOMBRES')								 
								 ->setCellValue('E8', 'APELLIDOS')
								 ->setCellValue('F8', 'RH')
								 ->setCellValue('G8', 'TELEFONO')
								 ->setCellValue('H8', 'MARCA')
								 ->setCellValue('I8', 'PLACA')
								 ->setCellValue('J8', 'NUM. MOVIL')
								 ->setCellValue('K8', 'EMPRESA');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:K8')->applyFromArray($styleArrayB);
 
foreach($registros as $data){
	
 $Empresas = Empresas::model()->findByPk($data['EMPR_ID']);
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'K'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data['PERS_IDENTIFICACION']);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data['PERS_NOMBRES']); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data['PERS_APELLIDOS']); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data['PERS_SANGRERH']); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data['PERS_TELEFONO']); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data['VEHI_MARCA']);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data['VEHI_PLACA']);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data['VEHI_NUMEROMOVIL']);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $Empresas->EMPR_NOMBRE);
 

 $fxls++;
 $item++; 
}
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('H10:H'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:K'.$fxls);  
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $nombre = substr('REPORTE_PROPIESTARIOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $nombreArch = strtoupper("PROPIETARIOS");
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save($nombreArch.'.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="'.$nombreArch.'.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>