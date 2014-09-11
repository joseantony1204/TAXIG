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
 $facturas = $Pagos->facturaGeneral();
 $criteria = new CDbCriteria;
 $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
 $Pagoservicio = Pagosservicios::model()->find($criteria);
 $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);		
 $Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
 $Tarifas = Tarifas::model()->findByPk($Servicios->TARI_ID);
 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
 $Conductores = Conductores::model()->findByPk($Conductoresautomoviles->COND_ID);
 $Personas = Personas::model()->findByPk($Conductores->PERS_ID);
 $Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
 
 $dia = date("d",strtotime($Pagos->PAGO_FECHAREGISTRO));
 $mes = nombreMes(date("m",strtotime($Pagos->PAGO_FECHAREGISTRO)));
 $anio = date("Y",strtotime($Pagos->PAGO_FECHAREGISTRO));  
 $fecha = $dia." DE ".$mes." DE ".$anio; 
 
?>
<html>
<head>
<style type="text/css">
<!--
.tabla2 {
font:90%;
border-collapse: collapse;
}
-->
</style>
</head>
<body onLoad="window.print();">
 <table border="0" width="25%" align="left" class="tabla2">
  
  <tr align="center">
   <td>TAXI GUAJIRA S.A.S</td>
  </tr>
  
  <tr align="center">
   <td>NIT 900.381.888 - 1</td>
  </tr>
  
  <tr align="center">
   <td>TEL 7283000 - 3002601151</td>
  </tr>
  
  <tr align="center">
   <td>CRA 15 #20-31, RCHA, GUAJIRA</td>
  </tr>
  
  <tr align="center">
   <td>taxiguajira@gmail.com</td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>

  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  <tr align="left">
   <td><strong>Recibo No: </strong><?php echo $Pagos->PAGO_ID; ?></td>
  </tr>
  <tr align="left">
   <td><strong>FECHA: </strong><?php echo $fecha; ?></td>
  </tr>
  <tr align="left">
   <td><strong><?php echo $Tarifas->TARI_DESCRIPCION; ?></strong></td>
  </tr>
  <tr align="left">
   <td><strong>NOMBRE: </strong><?php echo $Personas->nombreCompleto; ?></td>
  </tr>
  <tr align="left">
   <td><strong>MOVIL: </strong><?php echo $Vehiculos->VEHI_NUMEROMOVIL; ?></td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  <tr align="left">
   <td>
   
   <table border="1" width="100%" align="left"  cellpadding="0" cellspacing="1" style="border-collapse:collapse;">
    <tr align="center">
     <td><strong>ITEM</strong></td><td><strong>CONCEPTO</strong></td><td><strong>VALOR</strong></td> 
    </tr>
	<?php 
	 $i=1;	$granTotal = 0;
	 foreach($facturas as $rows){
	  $granTotal = $granTotal + $rows["PACO_VALOR"];
	  if($rows['PACO_VALOR']!=0){ 
	    echo '
	    <tr align="center">
         <td>'.$i.'</td><td>'.$rows["CONC_NOMBRE"].'</td><td>$'.number_format($rows['PACO_VALOR']).'</td> 
        </tr>';
       $i++;
	  }
	 }
	 echo' 
    <tr align="center">
     <td><strong>TOTAL</strong></td><td>&nbsp;</td><td><strong>$'.number_format($granTotal).'</strong></td> 
    </tr>';	 
    ?>
   </table>  
   
   </td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  <tr align="center">
   <td>&nbsp;</td>
  </tr>
  
  
  <tr align="center">
   <td>***** COMPROBANTE DE PAGO *****</td>
  </tr>
  
 </table>
</body>
</html>