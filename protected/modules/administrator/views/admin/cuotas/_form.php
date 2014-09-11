<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cuotas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'CUOT_VALOR',array('class'=>'span3','maxlength'=>20)); ?>

    <?php echo $form->labelEx($model,'CUOT_FECHAPAGO'); ?>
          <?php
             if($model->CUOT_FECHAPAGO=='') {
             $model->CUOT_FECHAPAGO = date("Y-m-d");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CUOT_FECHAPAGO',
             'value'=>$model->CUOT_FECHAPAGO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$model->CUOT_FECHAPAGO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Ingreso',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
          <?php echo $form->error($model,'CUOT_FECHAPAGO'); ?>
		  
	<?php echo $form->labelEx($model,'CONC_ID'); ?>
    <?php $data = CHtml::listData(Conceptos::model()->findAll(),'CONC_ID','CONC_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'CONC_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
	<?php echo $form->error($model,'CONC_ID'); ?>
	
	<?php echo $form->hiddenField($model,'CRED_ID',array('class'=>'span5')); ?>

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




