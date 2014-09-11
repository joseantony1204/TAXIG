<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Pagos'=>array('admin/pagos/admin',),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Pagos','url'=>array('index')),
	array('label'=>'Create Pagos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pagos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="57%"><strong><span><em>ADMINISTRACION DE RECAUDOS</em></span></strong></td>
             <td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?></td>
             <td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/admin',),$htmlOptions ); 
        ?></td>
             <td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Registrar Recaudos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/create',),$htmlOptions ); 
        ?></td>

<td width="10%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pago.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Reporte por Dia Seleccionado');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/admin',),$htmlOptions ); 
?></td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="2">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pagos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'afterAjaxUpdate'=>"function(){
                                $.datepicker.setDefaults($.datepicker.regional['es']);
                                $('#date_purchased_search').datepicker({'dateFormat': 'yy-mm-dd'});
                                                        
                                                }", 
	'ajaxUrl' => $this->createUrl('admin/pagos/admin'),
	'columns'=>array(
		array('name'=>'VEHI_NUMEROMOVIL', 'value'=>'$data->VEHI_NUMEROMOVIL',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'90')),
		
		array('name'=>'VEHI_PLACA', 'value'=>'$data->VEHI_PLACA',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'90')),
		
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),
		
		array('name'=>'PACO_VALOR', 'value'=>'$data->PACO_VALOR', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'120')),
		
		array(
            'name' => 'PAGO_FECHAREGISTRO',
            'value' => '$data->PAGO_FECHAREGISTRO',
			'htmlOptions'=>array('width'=>'150'),
            'filter' => 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model, 
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
			  'buttons'=>array(       
               'update' => array(
			    'label'=>'Actualizar',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/pagos/update", 
				 array("id"=>$data[SERV_ID],))',
				),
			   ),			  
			),
	),
)); ?>



    </td>
  </tr>
</table>