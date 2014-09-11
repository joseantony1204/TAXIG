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



 $diaI = date("d",strtotime($Informescreditos->CONT_FECHAINICIO));
 $mesI = nombreMes(date("m",strtotime($Informescreditos->CONT_FECHAINICIO)));
 $anioI = date("Y",strtotime($Informescreditos->CONT_FECHAINICIO));  
 $fechaI = $diaI." DE ".$mesI." DE ".$anioI;
 
 $diaF = date("d",strtotime($Informescreditos->CONT_FECHAFINAL));
 $mesF = nombreMes(date("m",strtotime($Informescreditos->CONT_FECHAFINAL)));
 $anioF = date("Y",strtotime($Informescreditos->CONT_FECHAFINAL));  
 $fechaF = $diaF." DE ".$mesF." DE ".$anioF;
 
 
 /*mes anterior*/
 $fechaMesAnterior = date('Y-m-d', strtotime($Informescreditos->CONT_FECHAINICIO.' - 1 month'));
 $diaA =  date("d",strtotime($fechaMesAnterior));
 $mesA = nombreMes(date("m",strtotime($fechaMesAnterior)));
 $anioA = date("Y",strtotime($fechaMesAnterior));  
 $mesSaldoAnterior = strtoupper($mesA." DE ".$anioA);
 
 /*mes actual*/
 $fechaMesActual = date('Y-m-d', strtotime($Informescreditos->CONT_FECHAINICIO));
 $diaAc =  date("d",strtotime($fechaMesActual));
 $mesAc = nombreMes(date("m",strtotime($fechaMesActual)));
 $anioAc = date("Y",strtotime($fechaMesActual));  
 $mesSaldoActual = strtoupper($mesAc." DE ".$anioAc);
 
$index = 0; 
$objPHPExcel->createSheet();

$objPHPExcel->setActiveSheetIndex($index)->mergeCells('I8:K8');
$objPHPExcel->setActiveSheetIndex($index)->mergeCells('L8:N8');

$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA DE REPORTE DESDE : '.strtoupper($fechaI).' HASTA : '.strtoupper($fechaF))
								  
								 ->setCellValue('A9', 'ITEM')
								 ->setCellValue('B9', 'NUM. MOVIL')
								 ->setCellValue('C9', 'IDENTIDAD')
								 ->setCellValue('D9', 'NOMBRES')								 
								 ->setCellValue('E9', 'APELLIDOS')
								 ->setCellValue('F9', 'FECHA INICIO')
								 ->setCellValue('G9', 'FECHA FINAL')
								 
								 
								 ->setCellValue('H9', $mesSaldoAnterior)
								 ->setCellValue('I9', 'PRESTAMOS')
								 ->setCellValue('J9', 'ABONOS')
								 ->setCellValue('K9', 'NUEVO SALDO')
								 //->setCellValue('L9', 'PRESTAMO GRAL')
								 //->setCellValue('M9', 'ABONO GRAL')
								// ->setCellValue('N9', 'SALDO GRAL')
								 
								 ->setCellValue('H8', 'SALDO ANTERIOR')
								 ->setCellValue('I8', 'EXTRACTO DEL PERIODO');
								 //->setCellValue('K8', 'DETALLE GENERAL DEL CREDITO');
					
$fxls = 11;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A9:K9')->applyFromArray($styleArrayB);

$objPHPExcel->getActiveSheet()->getStyle('H8:K8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalSaldoAnterior = 0; $totalAbonoPeriodo = 0; $totalSaldoActual = 0;
$totalAbonoPrestamo = 0; $totalDeudaPrestamo = 0; $totalPrestamoMes = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data["PERS_ID"];			
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
$saldoAnterior = ($data["PRESTAMOANTERIOR"] - $data["ABONOPASADO"]);
$nuevoSaldo = ($saldoAnterior + $data["PRESTAMOMES"])-$data["ABONOMES"];
$deudaPrestamo = ($data["PRESTAMOS"])-$data["ABONOTOTAL"];


 
 $totalSaldoAnterior = $totalSaldoAnterior + $saldoAnterior;
 $totalPrestamoMes = $totalPrestamoMes + $data["PRESTAMOMES"];
 $totalAbonoPeriodo = $totalAbonoPeriodo + $data["ABONOMES"];
 $totalSaldoActual = $totalSaldoActual + $nuevoSaldo;
 $totalPrestamos = $totalPrestamos + $data["PRESTAMOS"];
 $totalAbonoPrestamo = $totalAbonoPrestamo + $data["ABONOTOTAL"];
 $totalDeudaPrestamo = $totalDeudaPrestamo + $deudaPrestamo;
  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$fxls.':'.'K'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('A'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $Vehiculos->VEHI_NUMEROMOVIL);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_NOMBRES"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PERS_APELLIDOS"]); 
 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["CRED_FECHAINICIO"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["CRED_FECHAFINAL"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $saldoAnterior);  
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["PRESTAMOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data["ABONOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $nuevoSaldo); 
 
 //$objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $data["PRESTAMOS"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data["ABONOTOTAL"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $deudaPrestamo);
 

 $fxls++;
 $item++;  
 }
}
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
  
  $objPHPExcel->getActiveSheet()->getStyle('C11:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('H11:N'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B9:K'.$fxls); 

  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $totalSaldoAnterior);
   $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $totalPrestamoMes);   
   $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $totalAbonoPeriodo);
   $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $totalSaldoActual);
   //$objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalPrestamos);
  // $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAbonoPrestamo);
  // $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $totalDeudaPrestamo);
   
   $objPHPExcel->getActiveSheet()->getStyle('H'.$fxls.':K'.$fxls)->getNumberFormat()->setFormatCode('#,##0'); 
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls.':K'.$fxls)->applyFromArray($styleArrayB);

 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(0);
   $nombre = substr('EXTRACTO CONDUCTORES',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   
   
////PROPIETARIOS 
$index = 1; 
$objPHPExcel->createSheet();

$objPHPExcel->setActiveSheetIndex($index)->mergeCells('I8:K8');
$objPHPExcel->setActiveSheetIndex($index)->mergeCells('L8:N8');

$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA DE REPORTE DESDE : '.strtoupper($fechaI).' HASTA : '.strtoupper($fechaF))
								  
								 ->setCellValue('B9', 'ITEM')
								 ->setCellValue('C9', 'IDENTIDAD')
								 ->setCellValue('D9', 'NOMBRES')								 
								 ->setCellValue('E9', 'APELLIDOS')
								 ->setCellValue('F9', 'FECHA INICIO')
								 ->setCellValue('G9', 'FECHA FINAL')
								 
								 
								 ->setCellValue('H9', $mesSaldoAnterior)
								 ->setCellValue('I9', 'PRESTAMOS')
								 ->setCellValue('J9', 'ABONOS')
								 ->setCellValue('K9', 'NUEVO SALDO')
								 //->setCellValue('L9', 'PRESTAMO GRAL')
								 //->setCellValue('M9', 'ABONO GRAL')
								// ->setCellValue('N9', 'SALDO GRAL')
								 
								 ->setCellValue('H8', 'SALDO ANTERIOR')
								 ->setCellValue('I8', 'EXTRACTO DEL PERIODO');
								// ->setCellValue('K8', 'DETALLE GENERAL DEL CREDITO');
					
$fxls = 11;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B9:K9')->applyFromArray($styleArrayB);

$objPHPExcel->getActiveSheet()->getStyle('H8:K8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalSaldoAnterior = 0; $totalAbonoPeriodo = 0; $totalSaldoActual = 0;
$totalAbonoPrestamo = 0; $totalDeudaPrestamo = 0; $totalPrestamoMes = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data["PERS_ID"];			
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
$saldoAnterior = ($data["PRESTAMOANTERIOR"] - $data["ABONOPASADO"]);
$nuevoSaldo = ($saldoAnterior + $data["PRESTAMOMES"])-$data["ABONOMES"];
$deudaPrestamo = ($data["PRESTAMOS"])-$data["ABONOTOTAL"];


 
 $totalSaldoAnterior = $totalSaldoAnterior + $saldoAnterior;
 $totalPrestamoMes = $totalPrestamoMes + $data["PRESTAMOMES"];
 $totalAbonoPeriodo = $totalAbonoPeriodo + $data["ABONOMES"];
 $totalSaldoActual = $totalSaldoActual + $nuevoSaldo;
 $totalPrestamos = $totalPrestamos + $data["PRESTAMOS"];
 $totalAbonoPrestamo = $totalAbonoPrestamo + $data["ABONOTOTAL"];
 $totalDeudaPrestamo = $totalDeudaPrestamo + $deudaPrestamo;
  
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'K'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_NOMBRES"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PERS_APELLIDOS"]); 
 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["CRED_FECHAINICIO"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["CRED_FECHAFINAL"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $saldoAnterior);  
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["PRESTAMOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data["ABONOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $nuevoSaldo); 
 
 //$objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $data["PRESTAMOS"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data["ABONOTOTAL"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $deudaPrestamo);
 

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
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
  
  $objPHPExcel->getActiveSheet()->getStyle('C11:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('H11:K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B9:K'.$fxls); 

  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $totalSaldoAnterior);
   $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $totalPrestamoMes);   
   $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $totalAbonoPeriodo);
   $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $totalSaldoActual);
   //$objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalPrestamos);
   //$objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAbonoPrestamo);
   //$objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $totalDeudaPrestamo);
   
   $objPHPExcel->getActiveSheet()->getStyle('H'.$fxls.':K'.$fxls)->getNumberFormat()->setFormatCode('#,##0'); 
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls.':K'.$fxls)->applyFromArray($styleArrayB);

 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(1);
   $nombre = substr('EXTRACTO PROPIETARIOS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
   
   
////OTROS 
$index = 2; 
$objPHPExcel->createSheet();

$objPHPExcel->setActiveSheetIndex($index)->mergeCells('I8:K8');
$objPHPExcel->setActiveSheetIndex($index)->mergeCells('L8:N8');

$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'TAXI GUAJIRA S.A.S')
								 ->setCellValue('B2', 'SECCION GERENCIAL')
								 ->setCellValue('B3', 'RELACION DE PRESTAMOS')
								 ->setCellValue('B6', 'FECHA DE REPORTE DESDE : '.strtoupper($fechaI).' HASTA : '.strtoupper($fechaF))
								  
								 ->setCellValue('B9', 'ITEM')
								 ->setCellValue('C9', 'IDENTIDAD')
								 ->setCellValue('D9', 'NOMBRES')								 
								 ->setCellValue('E9', 'APELLIDOS')
								 ->setCellValue('F9', 'FECHA INICIO')
								 ->setCellValue('G9', 'FECHA FINAL')
								 
								 
								 ->setCellValue('H9', $mesSaldoAnterior)
								 ->setCellValue('I9', 'PRESTAMOS')
								 ->setCellValue('J9', 'ABONOS')
								 ->setCellValue('K9', 'NUEVO SALDO')
								 //->setCellValue('L9', 'PRESTAMO GRAL')
								// ->setCellValue('M9', 'ABONO GRAL')
								// ->setCellValue('N9', 'SALDO GRAL')
								 
								 ->setCellValue('H8', 'SALDO ANTERIOR')
								 ->setCellValue('I8', 'EXTRACTO DEL PERIODO');
								// ->setCellValue('K8', 'DETALLE GENERAL DEL CREDITO');
					
$fxls = 11;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B9:K9')->applyFromArray($styleArrayB);

$objPHPExcel->getActiveSheet()->getStyle('H8:K8')->applyFromArray($styleArrayB);

$totalPrestamos = 0; $totalSaldoAnterior = 0; $totalAbonoPeriodo = 0; $totalSaldoActual = 0;
$totalAbonoPrestamo = 0; $totalDeudaPrestamo = 0; $totalPrestamoMes = 0;

foreach($Registros as $data){
 
 $criteria = new CDbCriteria; 
 $criteria->condition = 'PERS_ID = '.$data["PERS_ID"];			
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
$saldoAnterior = ($data["PRESTAMOANTERIOR"] - $data["ABONOPASADO"]);
$nuevoSaldo = ($saldoAnterior + $data["PRESTAMOMES"])-$data["ABONOMES"];
$deudaPrestamo = ($data["PRESTAMOS"])-$data["ABONOTOTAL"];


 
 $totalSaldoAnterior = $totalSaldoAnterior + $saldoAnterior;
 $totalPrestamoMes = $totalPrestamoMes + $data["PRESTAMOMES"];
 $totalAbonoPeriodo = $totalAbonoPeriodo + $data["ABONOMES"];
 $totalSaldoActual = $totalSaldoActual + $nuevoSaldo;
 $totalPrestamos = $totalPrestamos + $data["PRESTAMOS"];
 $totalAbonoPrestamo = $totalAbonoPrestamo + $data["ABONOTOTAL"];
 $totalDeudaPrestamo = $totalDeudaPrestamo + $deudaPrestamo;
  
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'K'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_NOMBRES"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PERS_APELLIDOS"]); 
 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["CRED_FECHAINICIO"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["CRED_FECHAFINAL"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $saldoAnterior);  
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["PRESTAMOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data["ABONOMES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $nuevoSaldo); 
 
 //$objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $data["PRESTAMOS"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data["ABONOTOTAL"]);
 //$objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $deudaPrestamo);
 

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
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
  
  $objPHPExcel->getActiveSheet()->getStyle('C11:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('H11:K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B9:K'.$fxls); 

  
  /* totales */
   $fxls = $fxls + 1;
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, "TOTALES");
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $totalSaldoAnterior);
   $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $totalPrestamoMes);   
   $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $totalAbonoPeriodo);
   $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $totalSaldoActual);
  // $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $totalPrestamos);
  // $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $totalAbonoPrestamo);
 //  $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $totalDeudaPrestamo);
   
   $objPHPExcel->getActiveSheet()->getStyle('H'.$fxls.':K'.$fxls)->getNumberFormat()->setFormatCode('#,##0'); 
   $objPHPExcel->getActiveSheet()->getStyle('G'.$fxls.':K'.$fxls)->applyFromArray($styleArrayB);

 
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex(2);
   $nombre = substr('EXTRACTO OTROS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$nombre");
 
   
   
   
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('EXTRACTO_PRESTAMOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="EXTRACTO_PRESTAMOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>