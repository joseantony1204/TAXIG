<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'documentosvehiculos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php $items = $model->searchItems($model->VEHI_ID); ?>
    <table border="0" width="80%">
    <?php 
	 foreach($items as $rows){
	 echo '<tr>';
	 echo '<td width="10%">';
	 ?>	 
     <input name="TIDO_ID[<?php echo $rows['TIDO_ID']?>]" type="checkbox" 
     id="TIDO_ID[<?php echo $rows['TIDO_ID']?>]" value="<?php echo $rows['TIDO_ID']?>" 
	 <?php if ($rows['DOHI_ID']!= "") echo 'checked="checked"' ?> />
	
	 <?php
     echo '</td>';
	 echo '<td width="55%">';
	 echo $rows['TIDO_NOMBRE']; 
	 echo '</td>';
	 echo '<td width="10%">';
	 ?> 
     <input name="DOHI_FECHAVENCIMIENTO[<?php echo $rows['TIDO_ID']?>]" size="5" type="date" 
     id="DOHI_FECHAVENCIMIENTO[<?php echo $rows['TIDO_ID']?>]" value="<?php echo $rows['DOHI_FECHAVENCIMIENTO']?>" />
     <?php 
	 echo '</td>';
	 echo '<td width="30%" align="left"> Ej: 2013-12-12'; 
	 echo '</td>';
	 echo '</tr>';
	 }
	?>
    </table>
	
	<?php echo $form->hiddenField($model,'VEHI_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




