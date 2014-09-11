<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Cuentas'=>array('admin/cuentas/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Cuentas','url'=>array('index')),
	array('label'=>'Create Cuentas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cuentas-grid', {
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
             <td width="70%"><strong><span><em>ADMINISTRACION DE CUENTAS</em></span></strong></td>

<td width="12%" align="center">
  <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?>         
  
</td>

<td width="12%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuentas/admin',),$htmlOptions ); 
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
	'id'=>'cuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),
		
		array('name'=>'CUEN_SALDO', 'value'=>'$data->CUEN_SALDO', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'70')),
		
		array('name'=>'CUEN_FECHAAPERTURA', 'value'=>'$data->CUEN_FECHAAPERTURA', 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'130'),),
		
		array('name'=>'ESDC_ID', 'value'=>'$data->eSDC->ESDC_NOMBRE', 'filter'=>Cuentas::getEstados(), 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{ver}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
			  'buttons'=>array(       
               'ver' => array(
			    'label'=>'Ver Movimientos',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/movimientoscuentas/admin", 
				 array("id"=>$data[CUEN_ID],))',
				),
			   ),			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
