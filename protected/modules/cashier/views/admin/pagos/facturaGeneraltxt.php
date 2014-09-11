<?php

function NombreMes($m)
  {
   switch ($m){
    case 1: return "ENE";
    case 2: return "FEB";
    case 3: return "MAR";
    case 4: return "ABR";
    case 5: return "MAY";
    case 6: return "JUN";
    case 7: return "JUL";
    case 8: return "AGO";
    case 9: return "SEP";
    case 10: return "OCT";
    case 11: return "NOV";
    case 12: return "DIC";
   }
  }
  
$file=("Factura");
$modo="w";
$arc = new Archivo($file.".txt",$modo);

$NombreDocumento = $NombreDocumento.$Pagos->PAGO_ID;
  
 $facturas = $Pagos->facturaGeneral();
 $Servicios = Servicios::model()->findByPk($Pagos->SERV_ID);
 $Tarifas = Tarifas::model()->findByPk($Servicios->TARI_ID);
 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
 $Conductores = Conductores::model()->findByPk($Conductoresautomoviles->COND_ID);
 $Personas = Personas::model()->findByPk($Conductores->PERS_ID);
 $Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
 
 $dia = date("d",strtotime($Pagos->PAGO_FECHAREGISTRO));
 $mes = nombreMes(date("m",strtotime($Pagos->PAGO_FECHAREGISTRO)));
 $anio = date("Y",strtotime($Pagos->PAGO_FECHAREGISTRO));  
 $fecha = $dia." DE ".$mes." DE ".$anio;


$encabezado=$arc->centro("TAXI GUAJIRA S.A.S",32).$arc->enter().
$arc->centro("NIT 900.381.888 - 1 ",32).$arc->enter().
$arc->centro("TEL 7283000 - 3002601151",32).$arc->enter().
$arc->centro("CRA 15 #20-31, RCHA, GUAJIRA",32).$arc->enter().
$arc->centro("taxiguajirasatelital@gmail.com",32).$arc->enter();

$descripciones =
$arc->enter().$arc->izquierda("Recibo No: ".$Pagos->PAGO_ID,32).
$arc->enter().$arc->izquierda("FECHA: ".$fecha,32).
$arc->enter().$arc->izquierda($Tarifas->TARI_DESCRIPCION,32).
$arc->enter().$arc->izquierda("NOMBRE: ".$Personas->nombreCompleto,32).
$arc->enter().$arc->izquierda("MOVIL: ".$Vehiculos->VEHI_NUMEROMOVIL,32);

$c1 = 8; $c2 = 16; $c3 = 8;
$totales  = 0;
$primeraLinea=
$arc->enter().$arc->lineaH($c1).$arc->lineaH($c2).$arc->lineaH($c3).$arc->enter();

$segundaLinea=
$arc->centro("ITEM",$c1).$arc->centro("CONCEPTO",$c2).$arc->centro("VALOR",$c3);

$arc->escribir($encabezado);
$arc->escribir($descripciones);
$arc->escribir($primeraLinea.$segundaLinea);
$arc->escribir($primeraLinea);

 
 $i=1;	$granTotal = 0;

 foreach($facturas as $rows){
  $granTotal = $granTotal + $rows["PACO_VALOR"];
  if($rows['PACO_VALOR']!=0){ 
   $registro=$arc->enter().$arc->centro($i,$c1).$arc->izquierda($rows["CONC_NOMBRE"],$c2).
   $arc->derecha('$'.number_format($rows['PACO_VALOR']),$c3);
   $arc->escribir($registro);
   $i++;
  }
 }
$arc->escribir($arc->enter().$arc->enter().$arc->enter());
$arc->escribir($arc->lineaH(32).$arc->enter());
$arc->escribir($arc->espacio(9).'TOTALES'.$arc->espacio(9).'$'.number_format($granTotal));

$arc->escribir($arc->enter().$arc->enter().'***** COMPROBANTE DE PAGO *****');
$arc->cerrar();
//exec("C:/wamp/www/TAXIG/F.bat", $output);
//print_r($output);

//$arc->descargarArchivo($file);
?>