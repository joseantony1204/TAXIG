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
								 ->setCellValue('C8', 'NUM. MOVIL')
								 ->setCellValue('D8', 'IDENTIDAD')
								 ->setCellValue('E8', 'NOMBRES')								 
								 ->setCellValue('F8', 'APELLIDOS')
								 ->setCellValue('G8', 'MONTO')
								 ->setCellValue('H8', 'FECHA INICIO')
								 ->setCellValue('I8', 'FECHA FINAL')
								 ->setCellValue('J8', 'TASA INTERES')
								 ->setCellValue('K8', 'PLAZO')
								 ->setCellValue('L8', 'ABONADO')
								 ->setCellValue('M8', 'PENDIENTE')
								 ->setCellValue('N8', 'ESTADO');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:N8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalAbonado = 0; $totalAdeudado = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data->PERS_ID;			
 if($Conductores = Conductores::model()->find($criteria)){
	$descripcion = "1";
	$criteria = new CDbCriteria; 
    $criteria->condition = 'COND_ID = '.$Conductores->COND_ID;
	$Conductoresautomoviles = Conductoresautomoviles::model()->find($criteria);
	$Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
	
 }elseif($Vehiculos = Vehiculos::model()->find($criteria)){
	  $descripcion = "2";
	  }else{ 
	        $descripcion = "3";
	       }
	  
 
 if($descripcion==1){
 $valorPagado = $Creditos->valorPagado($data->CRED_ID);
 
 $deuda = $data->CRED_VALOR - $valorPagado;
 
 $totalPrestamos = $totalPrestamos + $data->CRED_VALOR;
 $totalAbonado = $totalAbonado + $valorPagado;
 $totalAdeudado = $totalAdeudado + $deuda;
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'N'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $Vehiculos->VEHI_NUMEROMOVIL);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data->PERS_IDENTIFICACION);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data->PERS_NOMBRES); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data->PERS_APELLIDOS); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data->CRED_VALOR); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data->CRED_FECHAINICIO);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data->CRED_FECHAFINAL); 
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data->CRED_TASAINTERES);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $data->CRED_PLAZO);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $valorPagado);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $deuda);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $data->eSCR->ESCR_NOMBRE); 
 $fxls++;
 $item++;
 } 
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('G10:G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('M10:M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:N'.$fxls); 
  
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $totalPrestamos);
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalAbonado);
   $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAdeudado);
   
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   
   $objPHPExcel->getActiveSheet()->getStyle('F'.$fxls.':G'.$fxls)->applyFromArray($styleArrayB);
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls.':M'.$fxls)->applyFromArray($styleArrayB); 
   
   /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(0);
   $nombre = substr('P. CONDUCTORES',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   
   
   
   
///PROPIETARIOS   


$index = 1; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA PROCESO : '.strtoupper($fechaP))
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'PROIETARIO')
								 ->setCellValue('D8', 'IDENTIDAD')
								 ->setCellValue('E8', 'NOMBRES')								 
								 ->setCellValue('F8', 'APELLIDOS')
								 ->setCellValue('G8', 'MONTO')
								 ->setCellValue('H8', 'FECHA INICIO')
								 ->setCellValue('I8', 'FECHA FINAL')
								 ->setCellValue('J8', 'TASA INTERES')
								 ->setCellValue('K8', 'PLAZO')
								 ->setCellValue('L8', 'ABONADO')
								 ->setCellValue('M8', 'PENDIENTE')
								 ->setCellValue('N8', 'ESTADO');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:N8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalAbonado = 0; $totalAdeudado = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data->PERS_ID;			
 if($Conductores = Conductores::model()->find($criteria)){
	$descripcion = "1";
	$criteria = new CDbCriteria; 
    $criteria->condition = 'COND_ID = '.$Conductores->COND_ID;
	$Conductoresautomoviles = Conductoresautomoviles::model()->find($criteria);
	$Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
	
 }elseif($Vehiculos = Vehiculos::model()->find($criteria)){
	  $descripcion = "2";
	  }else{ 
	        $descripcion = "3";
	       }
	  
 
 if($descripcion==2){
 $valorPagado = $Creditos->valorPagado($data->CRED_ID);
 
 $deuda = $data->CRED_VALOR - $valorPagado;
 
 $totalPrestamos = $totalPrestamos + $data->CRED_VALOR;
 $totalAbonado = $totalAbonado + $valorPagado;
 $totalAdeudado = $totalAdeudado + $deuda;
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'N'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, 'PROPIETARIO');
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data->PERS_IDENTIFICACION);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data->PERS_NOMBRES); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data->PERS_APELLIDOS); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data->CRED_VALOR); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data->CRED_FECHAINICIO);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data->CRED_FECHAFINAL); 
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data->CRED_TASAINTERES);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $data->CRED_PLAZO);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $valorPagado);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $deuda);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $data->eSCR->ESCR_NOMBRE); 

 $fxls++;
 $item++;
}
  
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('G10:G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('M10:M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:N'.$fxls); 
  
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $totalPrestamos);
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalAbonado);
   $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAdeudado);
   
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   
   $objPHPExcel->getActiveSheet()->getStyle('F'.$fxls.':G'.$fxls)->applyFromArray($styleArrayB);
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls.':M'.$fxls)->applyFromArray($styleArrayB); 
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(1);
   $nombre = substr('P. PROPIETARIOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   
   
   
 ///OTROS   


$index = 2; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA PROCESO : '.strtoupper($fechaP))
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'PROIETARIO')
								 ->setCellValue('D8', 'IDENTIDAD')
								 ->setCellValue('E8', 'NOMBRES')								 
								 ->setCellValue('F8', 'APELLIDOS')
								 ->setCellValue('G8', 'MONTO')
								 ->setCellValue('H8', 'FECHA INICIO')
								 ->setCellValue('I8', 'FECHA FINAL')
								 ->setCellValue('J8', 'TASA INTERES')
								 ->setCellValue('K8', 'PLAZO')
								 ->setCellValue('L8', 'ABONADO')
								 ->setCellValue('M8', 'PENDIENTE')
								 ->setCellValue('N8', 'ESTADO');
					
$fxls = 10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:N8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalAbonado = 0; $totalAdeudado = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data->PERS_ID;			
 if($Conductores = Conductores::model()->find($criteria)){
	$descripcion = "1";
	$criteria = new CDbCriteria; 
    $criteria->condition = 'COND_ID = '.$Conductores->COND_ID;
	$Conductoresautomoviles = Conductoresautomoviles::model()->find($criteria);
	$Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
	
 }elseif($Vehiculos = Vehiculos::model()->find($criteria)){
	  $descripcion = "2";
	  }else{ 
	        $descripcion = "3";
	       }
	  
 
 if($descripcion==3){
 $valorPagado = $Creditos->valorPagado($data->CRED_ID);
 
 $deuda = $data->CRED_VALOR - $valorPagado;
 
 $totalPrestamos = $totalPrestamos + $data->CRED_VALOR;
 $totalAbonado = $totalAbonado + $valorPagado;
 $totalAdeudado = $totalAdeudado + $deuda;
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'N'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, 'OTROS');
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data->PERS_IDENTIFICACION);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data->PERS_NOMBRES); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data->PERS_APELLIDOS); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data->CRED_VALOR); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data->CRED_FECHAINICIO);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data->CRED_FECHAFINAL); 
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data->CRED_TASAINTERES);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $data->CRED_PLAZO);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $valorPagado);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $deuda);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $data->eSCR->ESCR_NOMBRE); 

 $fxls++;
 $item++;
}
  
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('G10:G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('M10:M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:N'.$fxls); 
  
  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $totalPrestamos);
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalAbonado);
   $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAdeudado);
   
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   $objPHPExcel->getActiveSheet()->getStyle('M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   
   $objPHPExcel->getActiveSheet()->getStyle('F'.$fxls.':G'.$fxls)->applyFromArray($styleArrayB);
   $objPHPExcel->getActiveSheet()->getStyle('L'.$fxls.':M'.$fxls)->applyFromArray($styleArrayB); 
  
 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(2);
   $nombre = substr('P. OTROS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");  
   
  
   
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