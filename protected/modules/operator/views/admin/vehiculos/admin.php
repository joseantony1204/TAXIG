<?php
Yii::app()->homeUrl = array('/operator/');
$this->breadcrumbs=array(
	'Modulo Operador'=>array('/operator/'),
	'Vehiculos'=>array('admin/vehiculos/admin'),
	'Administrar',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vehiculos-grid', {
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
              <td width="8%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="56%"><strong><span><em>ADMINISTRACION DE VEHICULOS Y PROPIETARIOS</em></span></strong></td>
             <td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/operator',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/admin',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/create',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/descargar_excel.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Listado');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/download',),$htmlOptions ); 
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
	'id'=>'vehiculos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'VEHI_NUMEROMOVIL',
		'VEHI_PLACA',		
		'VEHI_MARCA',
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'130')),
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),	
		
		array('name'=>'EMPR_ID', 'value'=>'$data->eMPR->EMPR_NOMBRE', 'filter'=>Vehiculos::getEmpresas(), 
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'160'),),	
		
		/*
		'VEHI_CLASE',
		'VEHI_LINEACILINDRAJE',
		'VEHI_NUMLICENCIA',
		'VEHI_FECHAEXPEDICION',
		'VEHI_COLOR',
		'VEHI_SERVICIO',
		'VEHI_CARROCERIATIPO',
		'VEHI_PUERTAS',
		'VEHI_NUMMOTOR',
		'VEHI_NUMSERIE',
		'VEHI_NUMCHASIS',
		'PERS_ID',
		*/
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
			  'htmlOptions'=>array('width'=>'70'),
			  'buttons'=>array(       
               'view' => array(
			    'label'=>'Ver Documentos',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/documentosvehiculos/admin", 
				 array("id"=>$data[VEHI_ID],))',
				),
			   ),			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
