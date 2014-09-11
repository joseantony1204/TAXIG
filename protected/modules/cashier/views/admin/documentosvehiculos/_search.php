<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'DOHI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DOHI_FECHAVENCIMIENTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TIDO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'VEHI_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
