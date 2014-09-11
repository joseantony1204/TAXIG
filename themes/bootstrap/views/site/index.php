<?php 
if(!Yii::app()->user->isGuest){

 $Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
 $criteria = new CDbCriteria;
 $criteria->condition = "USUA_ID = ".$Usuario->USUA_ID;
 $Usuarioperfilusuario = Usuarioperfilusuario::model()->find($criteria);
 $Usuarioperfilusuario = Usuarioperfilusuario::model()->findByPk($Usuarioperfilusuario->USPU_ID);
 if($Usuarioperfilusuario->USPE_ID ==1){
  header("location:/TAXIG/administrator/"); 
 }elseif($Usuarioperfilusuario->USPE_ID ==2){
  header("location:/TAXIG/cashier/");
 }elseif($Usuarioperfilusuario->USPE_ID ==3){
  header("location:/TAXIG/operator/");
 }
?>
<h2><p>FELICIDADES !!! Haz iniciado sesión satisfactoriamente...</p></h2>
<h2><?php echo CHtml::encode(Yii::app()->name); ?> </h2>
<?php
}else{
?>
<h1>BIENVENIDO A</h1>
<h2><?php echo CHtml::encode(Yii::app()->name); ?> </h2>
<br/>
<h4>Para iniciar sesión haz clic en el vinculo que esta en la parte superior derecha de tu pantalla</h4>
<h3></h3>


<?php
}
?>

<?php 			 
	$imageUrl = Yii::app()->request->baseUrl . '/images/q.png';
	echo $image = CHtml::image($imageUrl); 
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<?php 			 
	$imageUrl = Yii::app()->request->baseUrl . '/images/t2.jpg';
	//echo $image = CHtml::image($imageUrl); 
?>
