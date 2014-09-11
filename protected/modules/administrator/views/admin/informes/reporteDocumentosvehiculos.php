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
					->setTitle("REPORTE DOCUMENTOS")
					->setSubject("REPORTE")
					->setDescription("REPORTE")
					->setKeywords("REPORTE, DOCUMENTOS")
					->setCategory("VENCIMIENTO");
					

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

 
 $diaF = date("d",strtotime($Informesdocumentos->CONT_FECHAFINAL));
 $mesF = nombreMes(date("m",strtotime($Informesdocumentos->CONT_FECHAFINAL)));
 $anioF = date("Y",strtotime($Informesdocumentos->CONT_FECHAFINAL));  
 $fechaF = $diaF." DE ".$mesF." DE ".$anioF;
 
$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA E.U')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE VENCIMIENTOS DE DOCUMENTOS')
								 ->setCellValue('B6', 'FECHA DE VENCIMIENTOS HASTA : '.strtoupper($fechaF))
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'NUM. MOVIL')								 
								 ->setCellValue('D8', 'IDENTIDAD')
								 ->setCellValue('E8', 'NOMBRES')
								 ->setCellValue('F8', 'APELLIDOS')
								 ->setCellValue('G8', 'TIPO DE DOCUMENTO')
								 ->setCellValue('H8', 'FECHA VENCIMIENTO');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:H8')->applyFromArray($styleArrayB);
 
foreach($documentos as $data){
	
 $dia = date("d",strtotime($data['DOHI_FECHAVENCIMIENTO']));
 $mes = nombreMes(date("m",strtotime($data['DOHI_FECHAVENCIMIENTO'])));
 $anio = date("Y",strtotime($data['DOHI_FECHAVENCIMIENTO']));  
 $fecha = $dia." DE ".$mes." DE ".$anio; 
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'H'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data['VEHI_NUMEROMOVIL']);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data['PERS_IDENTIFICACION']); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data['PERS_NOMBRES']); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data['PERS_APELLIDOS']);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data['TIDO_NOMBRE']); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, strtoupper($fecha));
 

 $fxls++;
 $item++; 
}
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('D10:D'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:H'.$fxls);  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('000');
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $nombre = substr('REPORTE_DOCUMENTOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_DOCUMENTOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_DOCUMENTOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>