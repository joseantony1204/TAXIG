<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Vehiculos'=>array('admin/vehiculos/admin'),
	'Documentos Vehiculos'=>array('admin/documentosvehiculos/admin','id'=>$model->VEHI_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Documentosvehiculos','url'=>array('index')),
	array('label'=>'Create Documentosvehiculos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documentosvehiculos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="90%" border="0" align="left">
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DOCUMENTOSVEHICULOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/admin',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/documentosvehiculos/admin','id'=>$model->VEHI_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/documentosvehiculos/create','id'=>$model->VEHI_ID),$htmlOptions ); 
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
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'documentosvehiculos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(		
		array('name'=>'TIDO_ID', 'value'=>'$data->tIDO->TIDO_NOMBRE','htmlOptions'=>array('width'=>'300')),
		array('name'=>'DOHI_FECHAVENCIMIENTO', 'value'=>'$data->DOHI_FECHAVENCIMIENTO','htmlOptions'=>array('width'=>'100')),
		
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}'			  
			),
						
	),
)); ?>

    </td>
  </tr>
</table>
