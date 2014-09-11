<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PERS_NOMBRES',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PERS_APELLIDOS',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'VEHI_NUMEROMOVIL',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'COAU_FECHAASIGNACION',array('class'=>'span4')); ?>
    
	<?php echo $form->labelEx($model,'ESCA_ID'); ?>
	<?php $data = CHtml::listData(Estadoconductoresautomovil::model()->findAll(),'ESCA_ID','ESCA_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'ESCA_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?>
    <?php echo $form->error($model,'ESCA_ID'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
