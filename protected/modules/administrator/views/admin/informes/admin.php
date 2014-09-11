<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Informes'=>array('admin/informes/admin',),
	'Generador de informes',
);
 ?>
<table width="100%" border="1" align="center" class="">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td width="3%" align="center">
        <?php 			 
		$imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
		echo $image = CHtml::image($imageUrl); 
	    ?> 
        </td>
        <td width="75%" align="left">
          <strong>GENERADOR DE INFORMES </strong></td>
        <td width="10%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/administrator',),$htmlOptions ); 
?></td>
        <td width="12%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/informes/admin',),$htmlOptions ); 
        ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
          'Pagos de Conceptos' => array('content' => $this->renderPartial("_form2",array("Informespagos"=>$Informespagos),true)),
		  'Estados de Servicios' => array('content' => $this->renderPartial("_form1", array("Informes"=>$Informes),true)),
		  'Creditos y Cartera' => array('content' => $this->renderPartial("_form5",array("Informescreditos"=>$Informescreditos),true)),
		  'Estado de Documentos' => array('content' => $this->renderPartial("_form3",array("Informesdocumentos"=>$Informesdocumentos),true)),
		  'Cumpleaños' => array('content' => $this->renderPartial("_form4",array("Informescumpleanios"=>$Informescumpleanios),true)),
                    ),
	'options'=>array('collapsible'=>true,),
	)); ?>

    </td>
  </tr>
</table>
