<script>
	function obtenerSeleccion(){
		var idservicio = $.fn.yiiGridView.getSelection('servicios');
		var action='obtenerServicio/id/'+idservicio;
		$.getJSON(action, function(data) {
			// limpia la lista
			$('#Pagosservicios_SERV_ID').find("li").each(function(){ $(this).remove(); });
			    
			  $.each(data, function(key, serv) {
		          $('#respuesta').append("<li>"+serv.SERVI_ID+", "+serv.TARI_ID+", "+serv.COAU_ID+"</li>");
			  $("#Pagosservicios_SERV_ID").val(serv.SERVI_ID);
			  $("#Servicios_SERVI_FECHAINGRESO").val(serv.SERVI_FECHAINGRESO);
                          
                            });
                          
		}).error(function(jqXHR) { 
			$("#respuesta").html(jqXHR.responseText);
		});		
	}
</script>
<table width="100%" border="1">
  
  <tr>
    <td colspan="2" align="center">
	
	<table width="100%" border="0" align="center">
      <tr>
        <td width="7%" align="left">
        <?php 			 
		$imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
		echo $image = CHtml::image($imageUrl); 
		?>         
	    </td>
        <td width="73%" align="left">
        <strong>RECAUDOS </strong></td>
        <td width="10%" align="center">
		<?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/admin',),$htmlOptions ); 
         ?>
		</td>
        <td width="10%" align="center">
		<?php
		$imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
        $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actualizar esta pagina');
        $image = CHtml::image($imageUrl);
        echo CHtml::link($image, array('admin/pagos/create',),$htmlOptions ); 
        ?>
		</td>
        <td width="10%" align="center">
        <?php        
		$imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
        $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip', 'data-toggle'=>'modal',
        'data-target'=>'#myModal', 'data-title' => 'Agregar un nuevo servicio');
        $image = CHtml::image($imageUrl);
        echo CHtml::link($image, array('admin/pagos/create',),$htmlOptions ); 
        ?> 
        </td>
      </tr>
    </table>
	
	</td>
  </tr>
  
  <tr>
    <td colspan="2">
	 
	 <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'servicios',
	'selectableRows'=>1,
	'selectionChanged'=>'obtenerSeleccion',
	'dataProvider'=>$Servicios->searchServices(),
	'type'=>'striped bordered condensed',
    'filter'=>$Servicios,	
	'afterAjaxUpdate'=>"function(){
                                $.datepicker.setDefaults($.datepicker.regional['es']);
                                $('#date_purchased_search').datepicker({'dateFormat': 'yy-mm-dd'});
                                                        
                                                }", 
	'ajaxUrl' => $this->createUrl('admin/pagos/create'),																				  
	'columns'=>array(
		array( 'class'=>'CCheckBoxColumn',
                        'value'=>'$data->SERVI_ID',
                        'selectableRows'=>1,
                        'id'=>'chk',
                ),
		array('name'=>'VEHI_NUMEROMOVIL', 'value'=>'$data->VEHI_NUMEROMOVIL',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'100')),
		
		array('name'=>'TARI_ID', 'value'=>'$data->tARI->TARI_VALOR', 'filter'=>Servicios::getTarifas(), 
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'80'), 'type'=>'number',),
		
		array(
            'name' => 'SERVI_FECHAINGRESO',
            'value' => '$data->SERVI_FECHAINGRESO',
			'htmlOptions'=>array('width'=>'120'),
            'filter' => 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $Servicios, 
			'attribute' =>'SERVI_FECHAINGRESO', 
			'language' => 'es',
			'htmlOptions' => array('id' => 'date_purchased_search','size' => '10'), 
			'options' => array(
			                   'dateFormat'=>'yy-mm-dd',
							   'buttonImageOnly'=>true, 
							   'changeMonth' => true, 
							   'changeYear' => true,
							   'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
							   'buttonImageOnly'=>true,
							   'buttonText'=>'Fecha Ingreso',
							   'selectOtherMonths'=>true,
							   'showAnim'=>'slide',
							   'showButtonPanel'=>true,
							   'showOn'=>'focus',
							   'showOtherMonths'=>true,
							   )
		    ), true),
        ),
		
		array('name'=>'TARI_HORADEPAGO', 'value'=>'$data->TARI_HORADEPAGO', 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'100'),),
		
		array( 
			  'name'=>'ESDS_ID',
			  'type'=>'html',
			  'filter'=>Servicios::getEstados(),
			  'value'=>'CHtml::image($data->imagenEstado)',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'140',
								   ), 
			  ),		
		
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),
		
	),
	
	)); 
	?>
	 
	</td>
  </tr>
  
  <tr>
    <td colspan="2" align="center"><hr></td>
  </tr>
  
  <tr>
    <td width="50%" align="center"><strong>FACTURACION</strong></td>
    <td width="50%" align="center"><strong>HISTORIAL DE FACTURAS</strong></td>
  </tr>
  
  <tr>
  
    <td width="50%">
	<table border="0" width="100%">
      <tr>
        <td width="90%">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pagos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true,),
	 )
	); ?>
          <?php echo $form->errorSummary($Pagos); ?> 
		  <?php echo $form->hiddenField($Pagosservicios,'SERV_ID',array('class'=>'span2')); ?>
		  <?php echo $form->hiddenField($Pagos,'PAGO_FECHAREGISTRO',array('class'=>'span2')); ?>
          <table width="100%" border="0">
            <tr>
              <td align="left" colspan="2"><?php 
			 $conceptos = $Pagosconceptos->searchConceptos(); 
			?>
             <table border="0" width="100%">
              <tr>
              <td align="center" bgcolor="#F0A71A"><strong>DESCRIPCION</strong></td>
              <td align="left" bgcolor="#F0A71A">&nbsp;</td>
              <td align="center" bgcolor="#F0A71A"><strong>VALOR</strong></td>
			  <td align="left" bgcolor="#F0A71A">&nbsp;</td>
             </tr>
			 <td align="right">F. INGRESO DEL SERV.</td>
              <td align="left">&nbsp;</td>
              <td align="left" bgcolor="#F0F0F0">
			  
			  <?php    	 
			  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			  'model'=>$Servicios,
			  'attribute'=>'SERVI_FECHAINGRESO',
			  'value'=>$Servicios->SERVI_FECHAINGRESO,
			  'language' => 'es',
			  'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
					 
			  'options'=>array(
			  'autoSize'=>true,
			  'defaultDate'=>$Servicios->SERVI_FECHAINGRESO,
			  'dateFormat'=>'yy-mm-dd',
			  'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			  'buttonImageOnly'=>true,
			  'buttonText'=>'Fecha Ingreso',
			  'selectOtherMonths'=>true,
			  'showAnim'=>'slide',
			  'showButtonPanel'=>true,
			  'showOn'=>'button',
			  'showOtherMonths'=>true,
			  'changeMonth' => 'true',
			  'changeYear' => 'true',
			   ),
			   )); 
			  ?>
			  
			  </td>
			 
             <?php
	         if($conceptos){
			 $i=1; 
             foreach($conceptos as $rows){
             echo '<tr>';
             echo '<td width="45%" align="right">';
			 echo $rows['CONC_NOMBRE'];
             echo '</td>';
             echo '<td width="5%">';
			 ?>
            &nbsp;
             <?php
             echo '</td>';
             echo '<td width="40%" bgcolor="#F0F0F0">';
             ?>
             <input name="PACO_VALOR[<?php echo $rows['CONC_ID']?>]" size="2" type="text" id="PACO_VALOR[<?php echo $rows['CONC_ID']?>]" 
             value="<?php echo 0; ?>" 
             <?php if ($rows['PACO_VALOR']!= 0) echo $rows['PACO_VALOR'] ?> onkeyup="sumar(this);" style="text-align: right"/>
             <?php 
             echo '</td>
			      <td width="10%">&nbsp;</td>
			      </tr>';
             ?>
                  <?php 
              $i++;
			  }
			 }
            ?>
			
			   <tr>
                    <td align="left" bgcolor="#F0F0F0" colspan="2"><strong>TOTAL FACTURA</strong></td>   
                    <td width="40%" bgcolor="#F0F0F0" align="left"><div><input type="text" id="total" style="text-align: right" disabled value="0"></div></td>
                    <td>&nbsp;</td>
			   </tr>
			   
			   <tr>
                    <td align="left" width="50%" colspan="2">&nbsp;</td> 
					<td align="right">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'button',
                    'icon'=>'ok white',
                    'type'=>'success',
                    'size'=>'small',
                    'label'=>'GENERAR FACTURA DE PAGO DEL SERVICIO',
					'htmlOptions'=>array(
					                     'id'=>'generarFactura',		        
								        ),
                    )); 
					?>
                    
                    <?php $this->endWidget();?>
				   </td>
               </tr>
              
			  </table>
			 </td>
            </tr>
          </table>
          </td>
      </tr>
    </table></td>

 
    <td><?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pagos-grid',
	//'selectableRows'=>1,
	//'selectionChanged'=>'seleccionRows',
	'dataProvider'=>$Pagos->searchPagos(),
	'type'=>'striped bordered condensed',
    'filter'=>$Pagos,	
	'columns'=>array(
	    
		array('name'=>'PAGO_ID', 'value'=>'$data->PAGO_ID',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80')),
		
		array('name'=>'VEHI_NUMEROMOVIL', 'value'=>'$data->VEHI_NUMEROMOVIL',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'90')),
		
		
		array('name'=>'PACO_VALOR', 'value'=>'$data->PACO_VALOR', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'100')),
		
		array(
            'name' => 'PAGO_FECHAREGISTRO',
            'value' => '$data->PAGO_FECHAREGISTRO',
			'htmlOptions'=>array('width'=>'120'),
            'filter' => 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $Pagos, 
			'attribute' =>'PAGO_FECHAREGISTRO', 
			'language' => 'es',
			'htmlOptions' => array('id' => 'date_purchased_search','size' => '10'), 
			'options' => array(
			                   'dateFormat'=>'yy-mm-dd',
							   'buttonImageOnly'=>true, 
							   'changeMonth' => true, 
							   'changeYear' => true,
							   'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
							   'buttonImageOnly'=>true,
							   'buttonText'=>'Fecha Ingreso',
							   'selectOtherMonths'=>true,
							   'showAnim'=>'slide',
							   'showButtonPanel'=>true,
							   'showOn'=>'focus',
							   'showOtherMonths'=>true,
							   )
		    ), true),
        ),
		
		array(
		 'class'=>'CLinkColumn',
		 'header'=>'...',
		 'urlExpression'=>'"javascript:imprimir($data->PAGO_ID)"',
		 'labelExpression'=>'CHtml::image($data["impresion"])',
		 'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'25',
								   ),
		),
		
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   ), 
              'buttons'=>array( 
				'factura' => array(
			    'label'=>'Imprmir Factura',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/imp.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/pagos/graltxt", 
				 array("id"=>$data[PAGO_ID],))',
				),
				
				
			   ),
			  'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ 
			                                              if(success){														   
                                                           $("#servicios").yiiGridView("update",{});
														   alert("Elemento borrado exitosamente...");														   
														  }
														 }',
			),
	),
)); ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
</table>

<script>
 function imprimir(id){
     $.ajax({
            data:{id:id},
            url:'graltxt',					
          });
}
</script>

<?php
Yii::app()->clientScript->registerScript('sendFactura','
$("#generarFactura").click(function(){
		 var url = "pagostarifas";
		 $.ajax({            
            url:url,
			type:"POST",
            data: $("#pagos-form").serialize(),
            beforeSend:function(){
                                             $("#generarFactura").addClass("disabled");
                                             $("#generarFactura").html("<i class=\"icon-edit icon-white\"></i> Espere un momento por favor...");
											 
                                 },
						  			
            success:function(data){
								   $("#pagos-form")[0].reset();								   
								   $("#pagos-grid").yiiGridView("update",{});
			                       $("#servicios").yiiGridView("update",{});
								   $("#generarFactura").removeClass("disabled");
								   $("#generarFactura").html("<i class=\"icon-ok icon-white\"></i> GENERAR FACTURA DE PAGO DEL SERVICIO");
								   alert("Factura generada correctamente, ahora puede imprimirla");								   
								  },			
          });
		 
        });
');
?>

<?php
Yii::app()->clientScript->registerScript('sendService','
$("#generarServicio").click(function(){
		 var url = "agregarservicios";
		 $.ajax({            
            url:url,
			type:"POST",
            data: $("#servicios-form").serialize(),
			success:function(data){
			 $("#servicios").yiiGridView("update",{});
			 $("#servicios-form")[0].reset();
			 $("#myModal").modal("hide");
			},
         });
			
        });
');
?>