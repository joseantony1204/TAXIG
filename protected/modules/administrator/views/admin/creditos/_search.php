<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CRED_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CRED_VALOR',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'CRED_FECHAINICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CRED_FECHAFINAL',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CRED_TASAINTERES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CRED_PLAZO',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'ESCR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
