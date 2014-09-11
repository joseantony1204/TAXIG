<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Creditos'=>array('admin/creditos/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Creditos','url'=>array('index')),
	array('label'=>'Create Creditos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('creditos-grid', {
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
             <td width="55%"><strong><span><em>ADMINISTRACION DE CREDITOS</em></span></strong></td>

<td width="10%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?>         
		 
</td>
<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/descargar_excel.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Extracto');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/download',),$htmlOptions); 
?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/create',),$htmlOptions ); 
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
	'id'=>'creditos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->pERS->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'130')),
		array('name'=>'PERS_NOMBRES', 'value'=>'$data->pERS->PERS_NOMBRES','htmlOptions'=>array('width'=>'170')),
		array('name'=>'PERS_APELLIDOS', 'value'=>'$data->pERS->PERS_APELLIDOS','htmlOptions'=>array('width'=>'170')),

		array('name'=>'CRED_VALOR', 'value'=>'$data->CRED_VALOR',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'40'), 'type'=>'number',),
		
		array( 
			  'name'=>'CRED_TASAINTERES',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->CRED_TASAINTERES."&nbsp;%"',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'10',
								   'title' => 'Ver Catedras',
								   'alt' => 'Ver Catedras'
								  ), 
			  ),
			  
		
		array('name'=>'CRED_PLAZO', 'value'=>'$data->CRED_PLAZO','htmlOptions'=>array('width'=>'30')),
		
		array('name'=>'CRED_FECHAINICIO', 'value'=>'$data->CRED_FECHAINICIO','htmlOptions'=>array('width'=>'80')),
		
		array('name'=>'SALDO', 'value'=>'$data->SALDO', 'filter'=>false,
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'40'), 'type'=>'number',),
		
		array( 
			  'name'=>'ESCR_ID',
			  'type'=>'html',
			  'filter'=>Creditos::getEstados(),
			  'value'=>'CHtml::image($data->imagenEstado)',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'60',
								   ), 
			  ),		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{extracto}&nbsp;&nbsp;{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'150',
								   ), 
              'buttons'=>array(       
               'extracto' => array(
			    'label'=>'Descargar Extracto',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/extracto.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/cuotas/download", 
				 array("id"=>$data[CRED_ID],))',
				),
				
				'view' => array(
			    'label'=>'Ver Cuotas',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/cuotas/admin", 
				 array("id"=>$data[CRED_ID],))',
				),
				
			   ),
			  'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),
	),
)); ?>

    </td>
  </tr>
</table>
