<?php 
if(!Yii::app()->user->isGuest){  
 
?>

<table width="80%" border="0" align="left">
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
    <td width="11%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_vehi.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Vehiculos y Propietarios');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/vehiculos/admin',),$htmlOptions ); 
    ?></td>
    <td width="9%" align="center">&nbsp;</td>
    <td width="15%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_cond.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Conductores');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/conductores/admin',),$htmlOptions ); 
    ?></td>
    <td width="8%" align="center">&nbsp;</td>
    <td width="14%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_empr.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Empresas');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/empresas/admin',),$htmlOptions ); 
    ?></td>
    <td width="8%" align="center">&nbsp;</td>
    <td width="15%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_convei.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignacion de Vehiculos a conductores');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/conductoresautomoviles/admin',),$htmlOptions ); 
    ?></td>
    <td width="9%" align="center">&nbsp;</td>
    <td width="11%" align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_tar.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Tarifas de la Cental');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/tarifas/admin',),$htmlOptions ); 
    ?></td>   
   </tr>
   <tr>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
   </tr>
   <tr>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_doc.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Tipos de documentos de Vehiculos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/tiposdocumentos/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_serv.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Servicios');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/servicios/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pag.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Pagos de Servicios');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/pagos/create',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_conc.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Conceptos de pagos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/conceptos/admin',),$htmlOptions ); 
    ?></td>
   </tr>
   <tr>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
     <td align="center">&nbsp;</td>
   </tr>
   <tr>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/personas/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_cuen.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Cuentas de Ahorro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/cuentas/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_creditos.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creditos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/creditos/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_rep.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Generador de Reportes');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/informes/admin',),$htmlOptions ); 
    ?></td>
     <td align="center">&nbsp;</td>
     <td align="center"><?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/icon_users.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Usuarios del Sistema');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('admin/users/admin',),$htmlOptions ); 
    ?></td>
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
