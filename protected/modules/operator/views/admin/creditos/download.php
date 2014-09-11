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

 $diaP = date("d");
 $mesP = nombreMes(date("m"));
 $anioP = date("Y");  
 $fechaP = $diaP." DE ".$mesP." DE ".$anioP;
 
$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA PROCESO : '.strtoupper($fechaP))
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'IDENTIDAD')
								 ->setCellValue('D8', 'NOMBRES')								 
								 ->setCellValue('E8', 'APELLIDOS')
								 ->setCellValue('F8', 'MONTO')
								 ->setCellValue('G8', 'FECHA INICIO')
								 ->setCellValue('H8', 'FECHA FINAL')
								 ->setCellValue('I8', 'TASA INTERES')
								 ->setCellValue('J8', 'PLAZO')
								 ->setCellValue('K8', 'ABONADO')
								 ->setCellValue('L8', 'PENDIENTE')
								 ->setCellValue('M8', 'ESTADO');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:M8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalAbonado = 0; $totalAdeudado = 0;

foreach($Registros as $data){
	
 $valorPagado = $Creditos->valorPagado($data->CRED_ID);
 
 $deuda = $data->CRED_VALOR - $valorPagado;
 
 $totalPrestamos = $totalPrestamos + $data->CRED_VALOR;
 $totalAbonado = $totalAbonado + $valorPagado;
 $totalAdeudado = $totalAdeudado + $deuda;
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'M'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data->PERS_IDENTIFICACION);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data->PERS_NOMBRES); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data->PERS_APELLIDOS); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data->CRED_VALOR); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data->CRED_FECHAINICIO);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data->CRED_FECHAFINAL); 
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data->CRED_TASAINTERES);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data->CRED_PLAZO);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $valorPagado);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $deuda);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data->eSCR->ESCR_NOMBRE); 
 

 $fxls++;
 $item++; 
}
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('F10:F'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('K10:K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:M'.$fxls); 
  
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $totalPrestamos);
   $objPHPExcel->getActiveSheet()->getStyle('F'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $totalAbonado);
   $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalAdeudado);
   
   $objPHPExcel->getActiveSheet()->getStyle('K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   
   $objPHPExcel->getActiveSheet()->getStyle('E'.$fxls.':F'.$fxls)->applyFromArray($styleArrayB);
   $objPHPExcel->getActiveSheet()->getStyle('K'.$fxls.':L'.$fxls)->applyFromArray($styleArrayB); 
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $nombre = substr('REPORTE_PRESTAMOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_PRESTAMOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_PRESTAMOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>