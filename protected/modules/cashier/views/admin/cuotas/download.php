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

 
 $nombre = $Cuotas->cRED->pERS->getNombreCompleto();
  
 $diaP = date("d",strtotime($Cuotas->cRED->CRED_FECHAINICIO));
 $mesP = nombreMes(date("m",strtotime($Cuotas->cRED->CRED_FECHAINICIO)));
 $anioP = date("Y",strtotime($Cuotas->cRED->CRED_FECHAINICIO)); 
 $fechaP = $diaP." DE ".$mesP." DE ".$anioP;
 
$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'EXTRACTO ABONO DE CUOTAS DE UN CREDITO')
								 
								 ->setCellValue('B5', 'NOMBRE : '.strtoupper($nombre))
								 ->setCellValue('B6', 'FECHA PRESTAMO : '.strtoupper($fechaP))
								 ->setCellValue('B7', 'MONTO PRESTAMO : '.number_format($Cuotas->cRED->CRED_VALOR))
								  
								 ->setCellValue('B9', 'ITEM')
								 ->setCellValue('C9', 'MONTO PAGADO')
								 ->setCellValue('D9', 'FECHA PAGO')								 
								 ->setCellValue('E9', 'SALDO PENDIENTE');
					
$fxls = 11;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B7')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B9:E9')->applyFromArray($styleArrayB);

$valorCredito = $Cuotas->cRED->CRED_VALOR; $totalPago = 0;
foreach($Registros as $data){
	
 $dia = date("d",strtotime($data->CUOT_FECHAPAGO));
 $mes = nombreMes(date("m",strtotime($data->CUOT_FECHAPAGO)));
 $anio = date("Y",strtotime($data->CUOT_FECHAPAGO));  
 $fecha = $dia." DE ".$mes." DE ".$anio; 
 

 $valorCredito = $valorCredito - $data->CUOT_VALOR;
 $totalPago = $totalPago + $data->CUOT_VALOR;
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'E'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data->CUOT_VALOR);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $fecha); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $valorCredito); 
 

 $fxls++;
 $item++; 
}
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  
  $objPHPExcel->getActiveSheet()->getStyle('C11:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('E11:E'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B9:E'.$fxls); 
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, "TOTAL");
   $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $totalPago);
   $objPHPExcel->getActiveSheet()->getStyle('C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':C'.$fxls)->applyFromArray($styleArrayB); 
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $nombre = substr('EXTRACTO_CREDITO',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('EXTRACTO_CREDITO.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="EXTRACTO_CREDITO.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>