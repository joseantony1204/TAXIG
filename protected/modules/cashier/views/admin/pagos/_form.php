<script type="text/javascript">
function sumar(c){
var subtotal = 0;

campo = c.form;
  if(!/^\d*$/.test(c.value)) return;  
      for (var i = 2; i <=campo.length-3; i++) {
          
		  if (!/^\d+$/.test(campo[i].value)) continue;
			  subtotal += parseInt(campo[i].value);
			  
      }
document.getElementById('total').value = subtotal;
}
	
</script>



<script>
	function obtenerSeleccion(){
		var idservicio = $.fn.yiiGridView.getSelection('servicios');
		var action='obtenerServicio/id/'+idservicio;
		$.getJSON(action, function(data) {
			// limpia la lista
			$('#Pagos_SERV_ID').find("li").each(function(){ $(this).remove(); });
			  
			  $.each(data, function(key, serv) {
		          $('#respuesta').append("<li>"+serv.SERVI_ID+", "+serv.TARI_ID+", "+serv.COAU_ID+"</li>");
			  $("#Pagos_SERV_ID").val(serv.SERVI_ID);
			  $("#Servicios_SERVI_FECHAINGRESO").val(serv.SERVI_FECHAINGRESO);
                          
                            });
                          
		}).error(function(jqXHR) { 
			$("#respuesta").html(jqXHR.responseText);
		});		
	}
</script>

<script>

function seleccionRow(){
		var idpago = $.fn.yiiGridView.getSelection('pagos-grid');
		var action='obtenerPago/id/'+idpago;
		$.getJSON(action, function(data) {
			// limpia la lista
			$('#pagos').find("li").each(function(){ $(this).remove(); });
			  
			  $.each(data, function(key, pago) {
		          $('#pagos').append("<li align='right'><a href='graltxt/id/"+pago.PAGO_ID+"' target='_blank'><img src='/TAXIG/images/txt.png'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='gral/id/"+pago.PAGO_ID+"'><img src='/TAXIG/images/gral.png'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='central/id/"+pago.PAGO_ID+"'><img src='/TAXIG/images/central.png'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href='ahorro/id/"+pago.PAGO_ID+"'><img src='/TAXIG/images/ahorro.png'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href='tarifa/id/"+pago.PAGO_ID+"'><img src='/TAXIG/images/tarifa.png'/></a></li>");
                            });
                          
		}).error(function(jqXHR) { 
			$("#pagos").html(jqXHR.responseText);
		});		
	}
</script>     
<table width="100%" border="1">
  <tr>
    <td colspan="3" bgcolor="#F0F0F0">
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
?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>HISTORIAL DE FACTURAS</strong></td>
    <td width="50%" align="center" bgcolor="#F0F0F0"><strong>FACTURACION</strong></td>
  </tr>
  <tr>
    <td width="17%" align="center"><strong>Descargar reportes</strong></td>
    <td width="33%" align="center"><ul id='pagos'></ul></td>
    <td width="50%" rowspan="2" bgcolor="#F0F0F0"><table border="0" width="100%">
      <tr>
        <td width="90%">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pagos',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true,),
	 )
	); ?>
          <?php echo $form->errorSummary($Pagos); ?> 
		  <?php echo $form->hiddenField($Pagos,'PAGO_FECHAREGISTRO',array('class'=>'span2')); ?>
          <table width="100%" border="0">
            <tr>
              <td align="center" bgcolor="#F0A71A"><strong><?php echo $form->labelEx($Pagos,'SERV_ID'); ?></strong></td>
              <td align="center" bgcolor="#F0A71A"><strong><?php echo $form->labelEx($Servicios,'SERVI_FECHAINGRESO'); ?></strong></td>
            </tr>
            <tr>
              <td width="50%" align="center" bgcolor="#F0A71A"><?php echo $form->textField($Pagos,'SERV_ID',array('class'=>'span2')); ?></td>
              <td width="50%" align="center" bgcolor="#F0A71A">              
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
     )); ?>
              
              </td>
            </tr>
            <tr>
              <td align="left" colspan="2"><?php 
			 $conceptos = $Pagosconceptos->searchConceptos(); 
			?>
                <table border="0" width="100%">
                  <tr>
                    <td align="left"><strong>DESCRIPCION</strong></td>
                    <td align="left">&nbsp;</td>
                    <td align="left"><strong>VALOR</strong></td>
                  </tr>
                  <?php
	     if($conceptos){
			 $i=1; 
             foreach($conceptos as $rows){
             echo '<tr>';
             echo '<td width="35%">';
			 echo $rows['CONC_NOMBRE'];
             echo '</td>';
             echo '<td width="15%">';
			 ?>
            &nbsp;
             <?php
             echo '</td>';
             echo '<td width="50%">';
             ?>
             <input name="PACO_VALOR[<?php echo $rows['CONC_ID']?>]" size="2" type="text" id="PACO_VALOR[<?php echo $rows['CONC_ID']?>]" 
             value="<?php echo 0; ?>" 
             <?php if ($rows['PACO_VALOR']!= 0) echo $rows['PACO_VALOR'] ?> onkeyup="sumar(this);" />
             <?php 
             echo '</td>
			      </tr>';
             ?>
                  <?php 
              $i++;
			  }
			 }
            ?><tr bgcolor="#F0F0F0">
                    <td align="left" width="50%" colspan="2"><strong>TOTAL FACTURA</strong></td>
                    
                    <td width="50%" align="left"><div><input type="text" id="total" disabled value="0"></div></td>
                  </tr>
            
                </table></td>
            </tr>
          </table>
          <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'icon'=>'ok white',
                    'type'=>'success',
                    'size'=>'small',
                    'label'=>$Pagos->isNewRecord ? 'Generar Factura' : 'Actualizar',
                )); ?>
          </div>
          <?php $this->endWidget();?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pagos-grid',
	'selectableRows'=>1,
	'selectionChanged'=>'seleccionRow',
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
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
		     ),
	),
)); ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
