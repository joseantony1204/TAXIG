<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Pagos'=>array('admin/pagos/admin',),
	'Crear',
);
?>
<table width="100%" border="0" align="left" class="">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td width="60" align="left">
            <?php 			 
			  $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			         </td>
        <td width="864" align="left">
        <strong>ADMINISTRACION DE RECAUDOS [ RECAUDOS  : Nuevo ] </strong></td>
        <td width="86" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/admin',),$htmlOptions ); 
?></td>
        <td width="85" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/create',),$htmlOptions ); 
?></td>
        <td width="84" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/admin.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Administrar Historial de pago');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/admin',),$htmlOptions ); 
?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', 
	array('Pagos'=>$Pagos,'Servicios'=>$Servicios,'Pagosconceptos'=>$Pagosconceptos,)); ?></p></td>
  </tr>
</table>
