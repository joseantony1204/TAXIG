<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('creditosgrid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<script>
	function obtenerCredito(){
		var idcredito = $.fn.yiiGridView.getSelection('creditosgrid');
		var action='obtenerCreditos/id/'+idcredito;
		$.getJSON(action, function(data) {
			// limpia la lista
			$('#Cuotas_CRED_ID').find("li").each(function(){ $(this).remove(); });
			    
			  $.each(data, function(key, cred) {			  
			  $("#Cuotas_CRED_ID").val(cred.CRED_ID);
                          
                            });
                          
		});		
	}
</script>

<table width="100%" border="1" align="left" class="">
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
        <td width="83%" align="left">
        <strong>ABONOS DE CARTERA </strong></td>
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
      </tr>
    </table>
	
	</td>
 </tr>	
 
  <tr>
    <td width="75%">
	<?php  //echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
    <div class="search-form" style="display:nones" >
    <?php $this->renderPartial('_searchcartera',array('Creditos'=>$Creditos,)); ?>
	</td>
	
	<td rowspan="2" width="25%" >
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cartera-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true,),
	 )
	); ?>
	<table width="100%" border="0">
	  <tr>
	  <td align="center"><strong>INGRESO DE ABONOS A CARTERA</strong></td>  
	  </tr>
      <?php echo $form->errorSummary($Creditos); ?>
      <?php echo $form->errorSummary($Cuotas); ?>
	  
	  <tr>
	  <td>&nbsp;</td>  
	  </tr>
	  
	  <tr>
	  <td><?php echo $form->hiddenField($Cuotas,'CRED_ID',array('class'=>'span1')); ?></td>  
	  </tr>
	  
	  <tr>
	   <td>
	    <?php echo $form->labelEx($Cuotas,'CUOT_FECHAPAGO'); ?>
          <?php
             if($Cuotas->CUOT_FECHAPAGO=='') {
             $Cuotas->CUOT_FECHAPAGO = date("Y-m-d");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Cuotas,
             'attribute'=>'CUOT_FECHAPAGO',
             'value'=>$Cuotas->CUOT_FECHAPAGO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$Cuotas->CUOT_FECHAPAGO,
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
          <?php echo $form->error($Cuotas,'CUOT_FECHAPAGO'); ?>
	   </td>  
	  </tr>
	  
	  <tr>
	  <td><?php echo $form->textFieldRow($Cuotas,'CUOT_VALOR',array('value'=>0, 'class'=>'span2','maxlength'=>20, 'style'=>"text-align: right")); ?></td>  
	  </tr>
	  
	  <tr>
	  <td><?php echo $form->hiddenField($Cuotas,'CONC_ID',array('value'=>6, 'class'=>'span2','maxlength'=>20, 'style'=>"text-align: right")); ?></td>  
	  </tr>
	  
	  <tr>
	  <td>&nbsp;</td>  
	  </tr>
	   
	  <tr>
	  <td align="right">
	    <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'button',
                    'icon'=>'ok white',
                    'type'=>'success',
                    'size'=>'small',
                    'label'=>'GUARDAR ABONO CON CRUCE DE CARTERA',
					'htmlOptions'=>array(
					                     'id'=>'generarAbono',		        
								        ),
                    )); 
		?>
	  </td>  
	  </tr> 
   
    </table>
	<?php $this->endWidget();?>
	</td>
  
  </tr>
  <tr>
    <td width="75%">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'creditosgrid',
	'selectableRows'=>1,
	'selectionChanged'=>'obtenerCredito',
	'dataProvider'=>$Creditos->buscar(),
	'type'=>'striped bordered condensed',
    'filter'=>$Creditos,

	'columns'=>array(
	     array('name'=>'PERS_IDENTIFICACION', 'filter'=>false, 'value'=>'$data->PERS_IDENTIFICACION', 'htmlOptions'=>array('width'=>'80'),),
	     array('name'=>'PERS_NOMBRES', 'filter'=>false, 'value'=>'$data->PERS_NOMBRES', 'htmlOptions'=>array('width'=>'120'),),
	     array('name'=>'PERS_APELLIDOS', 'filter'=>false, 'value'=>'$data->PERS_APELLIDOS', 'htmlOptions'=>array('width'=>'120'),),
		 array('name'=>'CRED_VALOR', 'value'=>'$data->CRED_VALOR', 'filter'=>false,
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'40'), 'type'=>'number',),
		
		array('name'=>'CRED_FECHAINICIO', 'filter'=>false, 'value'=>'$data->CRED_FECHAINICIO','htmlOptions'=>array('style'=>'text-align: center', 'width'=>'80')),
		
		array('name'=>'SALDO', 'value'=>'$data->SALDO', 'filter'=>false,
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'40'), 'type'=>'number',),

	),
)); ?>
	</td>
	
  </tr>
</table>

<?php
Yii::app()->clientScript->registerScript('sendCartera','
$("#generarAbono").click(function(){
		 var url = "agregarabonos";
		 $.ajax({            
            url:url,
			type:"POST",
            data: $("#cartera-form").serialize(),
            beforeSend:function(){
                                             $("#generarAbono").addClass("disabled");
                                             $("#generarAbono").html("<i class=\"icon-edit icon-white\"></i> Espere un momento por favor...");
											 
                                 },
						  			
            success:function(data){
								   $("#cartera-form")[0].reset();			
			                       $("#creditosgrid").yiiGridView("update",{});
								   $("#generarAbono").removeClass("disabled");
								   $("#generarAbono").html("<i class=\"icon-ok icon-white\"></i> GUARDAR ABONO CON CRUCE DE CARTERA");
								   alert("Abono generado correctamente...");								   
								  },			
          });
		 
        });
');
?>
