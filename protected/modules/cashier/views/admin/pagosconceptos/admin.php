<?php
$this->breadcrumbs=array(
	'Pagosconceptos'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Pagosconceptos','url'=>array('index')),
	array('label'=>'Create Pagosconceptos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pagosconceptos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PAGOSCONCEPTOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('pagosconceptos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('pagosconceptos/create',),$htmlOptions ); 
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
	'id'=>'pagosconceptos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'PACO_ID',
		'PACO_FECHAINGRESO',
		'PACO_VALOR',
		'CONC_ID',
		'PAGO_ID',
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
