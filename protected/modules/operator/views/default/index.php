<?php 
if(!Yii::app()->user->isGuest){  
 
?>

<table width="70%" border="0" align="left">
  <tr>
  <td height="28" align="left">
  <fieldset>
  
<table width="100%" border="0">
   <tr>
    <td height="21" align="center">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <td width="60" align="left">
          <?php
	      $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
	      echo $image = CHtml::image($imageUrl);
	      ?>
          </td>
          <td width="750" align="left"><h3><?php echo "ADMINISTRACÍON Y CONFIGURACÍON DEL SISTEMA"; ?></h3></td>
        </tr>
      </table>
    </fieldset>
    </td>
  </tr>

  <tr>
    <td><hr /></td>
  </tr>
  <tr>
   <td>

  <table width="100%" border="0">
   <tr>
    <td width="23%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_vehi.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Vehiculos y Propietarios');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/admin',),$htmlOptions ); 
    ?></td>
    <td width="14%" align="center">&nbsp;</td>
    <td width="24%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_convei.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignacion de Vehiculos a conductores');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/conductoresautomoviles/admin',),$htmlOptions ); 
    ?></td>
    </tr>
   <tr>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     </tr>
   <tr>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_serv.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Servicios');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_cond.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Conductores');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/conductores/admin',),$htmlOptions ); 
    ?>	 
	 </td>
     </tr>
  </table>

    
    </td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
</table>

</fieldset>
   </td>
  </tr>
</table>
<?php
}else{
?>
</p>
<h3>Su sesiòn ha caducado :( </h3>
<br/>
<h4>Para iniciar sesiòn haz clic en el vinculo que esta en la parte superior derecha de tu pantalla</h4>
<?php
}
?>
