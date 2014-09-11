<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Servicios'=>array('admin/servicios/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Servicios','url'=>array('index')),
	array('label'=>'Create Servicios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('servicios-grid', {
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
              <td width="8%" height=""  align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="55%"><strong><span><em>ADMINISTRACION DE SERVICIOS</em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?>         
		 
</td>
<td width="10%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/admin',),$htmlOptions ); 
?></td>

<td width="9%" align="center">
         <?php        
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip', 'data-toggle'=>'modal',
            'data-target'=>'#myModal', 'data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/create',),$htmlOptions ); 
         ?> 
        </td>

<td width="9%" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pago.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Reporte en Pantalla');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/download',),$htmlOptions ); 
        ?>         
		 </td>
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
	'id'=>'servicios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,										  
	'afterAjaxUpdate'=>"function(){
                                $.datepicker.setDefaults($.datepicker.regional['es']);
                                $('#date_purchased_search').datepicker({'dateFormat': 'yy-mm-dd'});
                                                        
                                                }", 
	'ajaxUrl' => $this->createUrl('admin/servicios/admin'),											
																					  
	'columns'=>array(
		array('name'=>'VEHI_NUMEROMOVIL', 'value'=>'$data->VEHI_NUMEROMOVIL',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'90')),
		
		array('name'=>'TARI_ID', 'value'=>'$data->tARI->TARI_VALOR', 'filter'=>Servicios::getTarifas(), 
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'80'), 'type'=>'number',),
		
		array(
            'name' => 'SERVI_FECHAINGRESO',
            'value' => '$data->SERVI_FECHAINGRESO',
			'htmlOptions'=>array('width'=>'120'),
            'filter' => 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model, 
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
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),
		
		array( 
			  'name'=>'ESDS_ID',
			  'type'=>'html',
			  'filter'=>Servicios::getEstados(),
			  'value'=>'CHtml::image($data->imagenEstado)',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'150',
								   ), 
			  ),
		
		
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),	
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
	
)); 
?>

    </td>
  </tr>
</table>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',      
    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>INGRESAR NUEVO SERVICIO</h4>
        </div>
         
        <div class="modal-body">
          <?php
            $this->renderPartial('_formm', array('model'=>$model)); 
		  ?>
         	
        </div>
        
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar ventana',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>


    <?php $this->endWidget(); ?>


