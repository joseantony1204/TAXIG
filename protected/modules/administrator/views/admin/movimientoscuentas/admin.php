<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Cuentas'=>array('admin/cuentas/admin'),
	'Movimientos Cuentas'=>array('admin/movimientoscuentas/admin','id'=>$model->CUEN_ID),
	'Administrar',
);

$Cuentas = Cuentas::model()->findByPk($model->CUEN_ID);

/*
$this->menu=array(
	array('label'=>'List Movimientoscuentas','url'=>array('index')),
	array('label'=>'Create Movimientoscuentas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('movimientoscuentas-grid', {
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
             <td width="57%"><strong><span><em>ADMINISTRACION DE MOVIMIENTOS DE CUENTAS</em></span></strong></td>

<td width="12%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuentas/admin',),$htmlOptions ); 
?>         
		 
</td>

<td width="11%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/movimientoscuentas/admin','id'=>$model->CUEN_ID,),$htmlOptions ); 
?>         
		 </td>

<td width="12%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/movimientoscuentas/create','id'=>$model->CUEN_ID,),$htmlOptions ); 
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
<div align="left"><strong>SALDO ACTUAL : $<?php echo number_format($Cuentas->CUEN_SALDO); ?></strong></div>  
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'movimientoscuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	    array(
		      'name'=>'MOVIMIENTO',
			  'type'=>'html',
			  'filter'=>false, 
			  'value'=>'CHtml::image($data->imagenMovimiento)',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'1')
			 ),
			 
		array('name'=>'MOCU_VALOR', 'value'=>'$data->MOCU_VALOR', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'70'),),	 
		
		array('name'=>'MOCU_FECHAPROCESO', 'value'=>'$data->MOCU_FECHAPROCESO', 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'130'),),
		
		array('name'=>'TIMC_ID', 'value'=>'$data->tIMC->TIMC_NOMBRE', 'filter'=>Movimientoscuentas::getTiposmovimientoscuentas(), 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),        
	    
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),	
	),
	
)); ?>

    </td>
  </tr>
</table>
