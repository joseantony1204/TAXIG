<?php
$this->breadcrumbs=array(
    'Usuarios'=>array('admin'),
	'Actualizar',
);
?> 
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
            <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			         </td>
        <td width="528" align="left">
          <strong style="border-bottom-style:groove">USUARIOS : Editar </strong></td>
        <td width="99" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/users/admin',),$htmlOptions ); 
?></td>
        <td width="115" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/users/update','id'=>$Users->USUA_ID),$htmlOptions ); 
        ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array(
	'Personasnaturales'=>$Personasnaturales,
    'Usuarios'=>$Usuarios,
	'Users'=>$Users
	)); ?></p></td>
  </tr>
</table>
