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
					->setKeywords("REPORTE, PAGOS")
					->setCategory("PAGOS");
					

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
  'font' => array('bold' => true,),
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


 $diaI = date("d",strtotime($Informespagos->CONT_FECHAINICIO));
 $mesI = nombreMes(date("m",strtotime($Informespagos->CONT_FECHAINICIO)));
 $anioI = date("Y",strtotime($Informespagos->CONT_FECHAINICIO));  
 $fechaI = $diaI." DE ".$mesI." DE ".$anioI;
 
 $diaF = date("d",strtotime($Informespagos->CONT_FECHAFINAL));
 $mesF = nombreMes(date("m",strtotime($Informespagos->CONT_FECHAFINAL)));
 $anioF = date("Y",strtotime($Informespagos->CONT_FECHAFINAL));  
 $fechaF = $diaF." DE ".$mesF." DE ".$anioF;
 
 
$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA E.U')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PAGOS DE CONCEPTOS')
								 ->setCellValue('B6', 'FECHA DE PAGO DESDE : '.strtoupper($fechaI).' HASTA : '.strtoupper($fechaF))
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'NUM. MOVIL')								 
								 ->setCellValue('D8', 'IDENTIDAD')
								 ->setCellValue('E8', 'NOMBRES')
								 ->setCellValue('F8', 'APELLIDOS')
								 ->setCellValue('G8', 'FECHA DE PAGO')
								 ->setCellValue('H8', 'CONCEPTO')
								 ->setCellValue('I8', 'VALOR PAGADO')
								 ->setCellValue('J8', 'USUARIO');
					
$fxls = 10;
$item = 1;
$totalPago = 0;
$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:J8')->applyFromArray($styleArrayB);
 
foreach($pagos as $data){
	
 $dia = date("d",strtotime($data['PAGO_FECHAREGISTRO']));
 $mes = nombreMes(date("m",strtotime($data['PAGO_FECHAREGISTRO'])));
 $anio = date("Y",strtotime($data['PAGO_FECHAREGISTRO']));  
 $fecha = $dia." DE ".$mes." DE ".$anio;
 
 $totalPago = $totalPago + $data['PACO_VALOR']; 
 
 $Usuario = Usuarios::model()->findByPk($data['USUA_ID']);
 $Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'J'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data['VEHI_NUMEROMOVIL']); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data['PERS_IDENTIFICACION']); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data['PERS_NOMBRES']); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data['PERS_APELLIDOS']); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, strtoupper($fecha)); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data['CONC_NOMBRE']);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data['PACO_VALOR']);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $Personasnaturales->PENA_NOMBRES); 
 

 $fxls++;
 $item++; 
}
  
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->getStyle('D10:D'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('I10:I'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:J'.$fxls);  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('000');
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, "TOTAL");
   $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $totalPago);
   $objPHPExcel->getActiveSheet()->getStyle('I'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('H'.$fxls.':J'.$fxls)->applyFromArray($styleArrayB);
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $nombre = substr('REPORTE_PAGOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_PAGOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_PAGOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>