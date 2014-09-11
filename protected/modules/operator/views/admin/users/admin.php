<?php
$this->breadcrumbs=array(
    'Usuarios'=>array('admin'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
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
              <td width="5%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="64%"><strong><span><em>ADMINISTRACION DE USUARIOS</em></span></strong></td>
             <td width="10%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?></td>
             <td width="11%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/users/admin',),$htmlOptions ); 
        ?></td>
             <td width="10%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/users/create',),$htmlOptions ); 
?></td>
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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		 array('name'=>'PENA_IDENTIFICACION', 'value'=>'$data->PENA_IDENTIFICACION','htmlOptions'=>array('width'=>'60'),),
	   array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES','htmlOptions'=>array('width'=>'140'),),
	   array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS','htmlOptions'=>array('width'=>'140'),),
	  
	   array('name'=>'USPE_ID', 'value'=>'$data->rel_usuarios_perfiles->USPE_NOMBRE', 'htmlOptions'=>array('width'=>'180'),),
	   array('name'=>'USUA_USUARIO', 'value'=>'$data->USUA_USUARIO','htmlOptions'=>array('width'=>'80'),),
	   array('name'=>'USUA_ULTIMOACCESO', 'value'=>'$data->USUA_ULTIMOACCESO','htmlOptions'=>array('width'=>'120'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("admin/personasnaturales/delete", array("id"=>$data[PENA_ID],"command"=>"delete"))',
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
