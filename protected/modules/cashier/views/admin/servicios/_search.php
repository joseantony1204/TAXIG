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
    
    <?php echo $form->labelEx($model,'TARI_ID'); ?>
    <?php $data = CHtml::listData(Tarifas::model()->findAll(),'TARI_ID','TARI_VALOR','TARI_DESCRIPCION') ?>
    <?php echo $form->dropDownList($model,'TARI_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
	<?php echo $form->error($model,'TARI_ID'); ?>	

	<?php echo $form->labelEx($model,'ESDS_ID'); ?>
    <?php $data = CHtml::listData(Estadosdeservicios::model()->findAll(),'ESDS_ID','ESDS_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'ESDS_ID',$data, array('class'=>'span3',)); ?> 
	<?php echo $form->error($model,'ESDS_ID'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
