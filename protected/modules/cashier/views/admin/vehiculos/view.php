<?php
$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->VEHI_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ VEHICULOS : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('vehiculos/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('vehiculos/view','id'=>$model->VEHI_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('vehiculos/update','id'=>$model->VEHI_ID),$htmlOptions ); 
?>         
		 </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'VEHI_ID',
		'VEHI_NUMEROMOVIL',
		'VEHI_NUMLICENCIA',
		'VEHI_FECHAEXPEDICION',
		'VEHI_PLACA',
		'VEHI_MARCA',
		'VEHI_LINEACILINDRAJE',
		'VEHI_MODELO',
		'VEHI_CLASE',
		'VEHI_COLOR',
		'VEHI_SERVICIO',
		'VEHI_CARROCERIATIPO',
		'VEHI_PUERTAS',
		'VEHI_NUMMOTOR',
		'VEHI_NUMSERIE',
		'VEHI_NUMCHASIS',
		'PERS_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
