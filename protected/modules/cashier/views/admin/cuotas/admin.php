<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Creditos'=>array('admin/creditos/admin'),
	'Cuotas'=>array('admin/cuotas/admin', 'id'=>$model->CRED_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Cuotas','url'=>array('index')),
	array('label'=>'Create Cuotas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cuotas-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="80%" border="0" align="left">
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
             <td width="55%"><strong><span><em>ADMINISTRACION DE CUOTAS</em></span></strong></td>

<td width="10%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/admin',),$htmlOptions ); 
?>         
		 
</td>
<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/descargar_excel.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Extracto');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuotas/download','id'=>$model->CRED_ID),$htmlOptions); 
?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuotas/admin','id'=>$model->CRED_ID),$htmlOptions); 
?>         
		 </td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuotas/create','id'=>$model->CRED_ID),$htmlOptions ); 
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
	'id'=>'cuotas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(

	array('name'=>'CUOT_ID', 'value'=>'$data->CUOT_ID','htmlOptions'=>array('width'=>'20')),
	
	array('name'=>'CUOT_VALOR', 'value'=>'$data->CUOT_VALOR',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'200'), 'type'=>'number',),
	
	array('name'=>'CUOT_FECHAPAGO', 'value'=>'$data->CUOT_FECHAPAGO',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'240'),),	
	       
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
