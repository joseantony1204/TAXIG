<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_NOMBRES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_APELLIDOS',array('class'=>'span5','maxlength'=>100)); ?>
    
    <?php echo $form->textFieldRow($model,'VEHI_NUMEROMOVIL',array('class'=>'span5')); ?>
    
	<?php echo $form->textFieldRow($model,'VEHI_PLACA',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
