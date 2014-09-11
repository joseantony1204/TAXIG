<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Creditos'=>array('admin/creditos/admin'),
	'Crear',
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
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ 
		CREDITOS  : Nuevo ] </strong></td>
		
		<td width="80" align="center">
         <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/admin',),$htmlOptions ); 
         ?> 	         
        </td>
		
        <td width="80" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/create',),$htmlOptions ); 
?>       </td>

         <td width="80" align="center">
         <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip', 'data-toggle'=>'modal',
            'data-target'=>'#myModal', 'data-title' => 'Agregar Nueva Persona a la Base de Datos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/admin',),$htmlOptions ); 
?>            
        </td>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></p></td>
  </tr>
</table>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',      
    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>INGRESAR NUEVA PERSONA</h4>
        </div>
         
        <div class="modal-body">
          <?php
            $this->renderPartial('_form3', array('Personas'=>$Personas)); 
		  ?>
         	
        </div>
        
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar ventana',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>


    <?php $this->endWidget(); ?>


