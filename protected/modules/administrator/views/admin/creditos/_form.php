<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'creditos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($model); ?>
	  
	  </p>
	<table width="100%" border="0">
	  <tr>
	    <td><?php 
			 echo $form->labelEx($model, 'PERS_ID');
			 $this->widget('EJuiAutoCompleteFkField', array(
				  'model'=>$model, 
				  'attribute'=>'PERS_ID',
				  'sourceUrl'=>Yii::app()->createUrl('administrator/admin/creditos/search'), 
				  'showFKField'=>false,
				  'FKFieldSize'=>50, 
				  'relName'=>'pERS',
				  'displayAttr'=>'pERS->PERS_ID',
				  'autoCompleteLength'=>60,
				  'htmlOptions' => array('style' => 'width:85%; float:left;'),
				  'options'=>array(
					  'minLength'=>1, 
				  ),
			 ));
			 echo $form->error($model, 'PERS_ID');?></td>
	    <td>&nbsp;</td>
	    <td width="45%"><?php echo $form->textFieldRow($model,'CRED_VALOR',array('class'=>'span2','maxlength'=>20)); ?></td>
	    </tr>
	  <tr>
	    <td width="45%">&nbsp;</td>
	    <td width="10%">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($model,'CRED_TASAINTERES',array('class'=>'span2','value'=>'0',)); ?>%</td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textFieldRow($model,'CRED_PLAZO',array('class'=>'span2','maxlength'=>10)); ?> : valor en meses</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		<?php echo $form->labelEx($model,'CRED_FECHAINICIO'); ?>
          <?php
             if($model->CRED_FECHAINICIO=='') {
             $model->CRED_FECHAINICIO = date("Y-m-d");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CRED_FECHAINICIO',
             'value'=>$model->CRED_FECHAINICIO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$model->CRED_FECHAINICIO,
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
          <?php echo $form->error($model,'CRED_FECHAINICIO'); ?>
        
        </td>
	    
        <td><?php echo $form->hiddenField($model,'ESCR_ID',array('value'=>'2')); ?></td>
	    <td>
		<?php echo $form->labelEx($model,'CRED_FECHAFINAL'); ?>
          <?php	
		     if($model->CRED_FECHAFINAL=='') {
             $model->CRED_FECHAFINAL = "0000-00-00";
             }		 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CRED_FECHAFINAL',
             'value'=>$model->CRED_FECHAFINAL,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$model->CRED_FECHAFINAL,
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
          <?php echo $form->error($model,'CRED_FECHAFINAL'); ?>
        
        </td>
	    </tr>
	  </table>
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




