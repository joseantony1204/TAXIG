<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'conceptos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'CONC_NOMBRE',array('class'=>'span5','maxlength'=>100)); ?>
	
	<?php echo $form->labelEx($model,'TICO_ID'); ?>
    <?php $data = CHtml::listData(Tiposconceptos::model()->findAll(),'TICO_ID','TICO_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'TICO_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
	<?php echo $form->error($model,'TICO_ID'); ?>

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




