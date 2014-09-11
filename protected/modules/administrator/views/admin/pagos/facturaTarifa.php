<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'Letter', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
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
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';      
  $titulo = "FACTURA_No: ";
  $palabrasClaves='REPORTE, FACTURAS, MOVIL';
  $Sujeto='REPORTE';
  $NombreDocumento=$titulo;
  $NombreDocumento = $NombreDocumento.$Pagos->PAGO_ID;
  
 // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  //$PDF_HEADER_LOGO = 'tcpdf_logoo.jpg';
  //$pdf->SetHeaderData($PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
 // Información referente al PDF
  $pdf->SetCreator($autor);
  $pdf->SetAuthor($autor);
  $pdf->SetTitle($titulo);
  $pdf->SetSubject($Sujeto);
  $pdf->SetKeywords($palabrasClaves);
  
    // Fuente de la cabecera y el pie de página
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
  // Márgenes
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->setPrintFooter(true);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   //***** AÑADIR PAGINA *****//

  $pdf->AddPage();
  ///***** CREANDO ARCHIVO *****///
 $facturas = $Pagos->facturaGeneral(3);		
 $Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID); 
 
 $Tarifas = Tarifas::model()->findByPk($Servicios->TARI_ID);
 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
 $Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID); 
 $Personas = Personas::model()->findByPk($Vehiculos->PERS_ID);
 
 $dia = date("d",strtotime($Pagos->PAGO_FECHAREGISTRO));
 $mes = nombreMes(date("m",strtotime($Pagos->PAGO_FECHAREGISTRO)));
 $anio = date("Y",strtotime($Pagos->PAGO_FECHAREGISTRO));  
 $fecha = $dia." DE ".$mes." DE ".$anio;
  
 $html ='
 <table width="100%" border="0">
  <tr>
   <td width="80%">
<table width="100%" border="0" align="left">';
 $html .='
       <tr>
        <td colspan="3" align="center" width="100%">&nbsp;</td>
       </tr>
	   <tr>
        <td align="center" width="20%"><img src="/TAXIG/images/logo1.png" /></td>
		<td align="center" width="50%"><img src="/TAXIG/images/logo2.png" />
		 <font><br>NIT: 900.381.888 – 1<br>TEL: 728 3000 - 3002601151<br><strong>Carrera 15 No 20 - 31, Riohacha, La Guajira</strong>
		 <br><strong>Email taxiguajirasatelital@gmail.com</strong></font>
		</td>
		<td align="center" width="30%">
		  <table width="100%" border="1" align="left">
		   <tr>
            <td align="center"><br><strong><font>RECIBO DE CAJA</font><br><font color="red"  size="9">'.$Pagos->PAGO_ID.'</font></strong></td>
           </tr>
		  </table>
		 </td>
       </tr>
	   <tr>
        <td colspan="3" align="center" width="100%">	
		<table width="100%" border="1" align="left">
		   <tr>
            <td align="center"><strong>FECHA</strong></td>
			<td align="center">'.$fecha.'</td>
			<td align="center"><strong>CIUDAD</strong></td>
			<td align="center">Riohacha</td>
			<td align="center"><strong>TURNO</strong></td>
			<td align="center">'.$Tarifas->TARI_DESCRIPCION.'</td>
           </tr>
		   
		   <tr>
            <td align="center"><strong>NOMBRE</strong></td>
			<td colspan="3" align="center">'.$Personas->nombreCompleto.'</td>
			<td align="center"><strong>MOVIL No:</strong></td>
			<td align="center">'.$Vehiculos->VEHI_NUMEROMOVIL.'</td>
           </tr>
		   <tr>
            <td colspan="6" align="center"><table width="100%" border="1" align="center">
			 <tr bgcolor="#E4E4E4">
			  <td align="center" width="10%"><strong>ITEM</strong></td>
			  <td align="center" width="60%"><strong>CONCEPTO</strong></td>
			  <td align="center" width="30%"><strong>VALOR</strong></td>
		    </tr>'; 
			$pdf->SetFont('times', 'k', '10', true);
            $i=1;	$granTotal = 0;   	   
             foreach($facturas as $rows){  
			 $granTotal = $granTotal + $rows["PACO_VALOR"];
			 $html .='
			   <tr>
				<td align="center">'.$i.'</td>
				<td align="left">'.$rows["CONC_NOMBRE"].'</td>
				<td align="right">$'.number_format($rows["PACO_VALOR"]).'</td>
			   </tr>			
			   '; 
			$i++;     
		  }
		  $html .='
			   <tr>
				<td colspan="2" align="left"><strong>TOTAL</strong></td>
				<td align="right"><strong>$'.number_format($granTotal).'</strong></td>
			   </tr>';
				   
			   
		   $html .='</table>
			
			</td>
           </tr>
		   
		   <tr>
            <td colspan="3" align="justify">OBSERVACIONES:<br><br><br>Este recibo corresponde a la tarifa dejada en central
			 por el conductor a al propietario del vehiculo.</td>
			<td colspan="3" align="left">RECIBI:<br><br><br></td>
           </tr>
		  </table>
		
		</td>
       </tr>';
	   
 $html .='</table>
	    </td>
		<td width="20%">&nbsp;</td>
	  </tr>
	  <tr>
		<td width="80%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
	  </tr>
     </table>
     ';
 
 $pdf->writeHTML($html, true, 0, true, 0);
 $pdf->Output("$NombreDocumento.pdf", 'D'); 
  
    
 Yii::app()->end();
  
?>