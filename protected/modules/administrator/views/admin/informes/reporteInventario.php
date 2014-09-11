<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'Letter', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';      
  $titulo = "REPORTE INVENTARIO DE PRODUCTOS";;
  $palabrasClaves='REPORTE, VENECIA, MOTEL';
  $Sujeto='REPORTE';
  $NombreDocumento=$titulo;
  
  
 // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $PDF_HEADER_LOGO = 'tcpdf_logoo.jpg';
  $pdf->SetHeaderData($PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
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
  $pdf->SetFont('times', 'k', '9', true);
  $pdf->AddPage();
  ///***** CREANDO ARCHIVO *****///
  
  $html ='<table width="100%" border="1" align="center">';
  $html .='
       <tr>
        <td colspan="10" align="center"><strong>REPORTE DE PRODUCTOS EN INVENTARIO</strong></td>
       </tr>
	   <tr>
        <td colspan="10" align="left">&nbsp;</td>
       </tr>
	   <tr bgcolor="#E4E4E4">
		<td align="center" width="7%"><strong>ITEM</strong></td>
		<td align="center" width="50%"><strong>NOMBRE DEL PRODUCTO</strong></td>
		<td align="center" width="13%"><strong>CANTIDAD</strong></td>
		<td align="center" width="15%"><strong>DESPACHADOS</strong></td>
		<td align="center" width="15%"><strong>INVENTARIO</strong></td>
	   </tr>			
	   '; 
  
  $i=1;	  	   
  foreach($productos as $rows){  
	 $html .='
	   <tr>
		<td align="center">'.$i.'</td>
		<td align="left">'.$rows["PROD_NOMBRE"].'</td>
		<td align="center">'.$rows["PROD_CANTIDAD"].'</td>
		<td align="center">'.$rows["FAPR_CANTIDAD"].'</td>
		<td align="center">'.$rows["INVENTARIO"].'</td>
	   </tr>			
	   '; 
	$i++;     
  }
  $pdf->SetFont('times', 'k', '9', true);   
  $html .='</table>'; 
 
 $pdf->writeHTML($html, true, 0, true, 0);
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
  
?>