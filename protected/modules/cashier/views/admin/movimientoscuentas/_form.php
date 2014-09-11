<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'movimientoscuentas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'MOCU_FECHAPROCESO',array('value'=>date("Y-m-d").' '.date("H:m:s"))); ?>

	<?php echo $form->textFieldRow($model,'MOCU_VALOR',array('class'=>'span3')); ?>
    
    <?php echo $form->labelEx($model,'TIMC_ID'); ?>
    <?php $data = CHtml::listData(Tiposmovimientoscuentas::model()->findAll(),'TIMC_ID','TIMC_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'TIMC_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
	<?php echo $form->error($model,'TIMC_ID'); ?>

	<?php echo $form->hiddenField($model,'CUEN_ID',array('class'=>'span5')); ?>

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




