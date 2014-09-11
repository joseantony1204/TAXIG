<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'conductoresautomoviles-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($model); ?></p>
	<table width="100%" border="0">
	  <tr>
	    <td width="40%">
			<?php 
			 echo $form->labelEx($model, 'COND_ID');
			 $this->widget('EJuiAutoCompleteFkField', array(
				  'model'=>$model, 
				  'attribute'=>'COND_ID',
				  'sourceUrl'=>Yii::app()->createUrl('administrator/admin/conductoresautomoviles/conductor'), 
				  'showFKField'=>false,
				  'FKFieldSize'=>30, 
				  'relName'=>'cOND',
				  'displayAttr'=>'cOND->pERS->nombreCompleto',
				  'autoCompleteLength'=>60,
				  'htmlOptions' => array('style' => 'width:80%; float:left;'),
				  'options'=>array(
					  'minLength'=>1,
					  'size'=>'200', 
				  ),
			 ));
			 echo $form->error($model, 'COND_ID');  
		  ?>
         </td>
	    <td width="20%">&nbsp;</td>
	    <td width="40%">
        <?php 
			 echo $form->labelEx($model, 'VEHI_ID');
			 $this->widget('EJuiAutoCompleteFkField', array(
				  'model'=>$model, 
				  'attribute'=>'VEHI_ID',
				  'sourceUrl'=>Yii::app()->createUrl('administrator/admin/conductoresautomoviles/vehiculos'), 
				  'showFKField'=>false,
				  'FKFieldSize'=>50, 
				  'relName'=>'vEHI',
				  'displayAttr'=>'vEHI->VEHI_NUMEROMOVIL',
				  'autoCompleteLength'=>60,
				  'htmlOptions' => array('style' => 'width:80%; float:left;'),
				  'options'=>array(
					  'minLength'=>1, 
				  ),
			 ));
			 echo $form->error($model, 'VEHI_ID');  
		  ?>
        </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		  <?php echo $form->labelEx($model,'COAU_FECHAASIGNACION'); ?>
          <?php
             if($model->COAU_FECHAASIGNACION=='') {
             $model->COAU_FECHAASIGNACION = date("Y-m-d");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'COAU_FECHAASIGNACION',
             'value'=>$model->COAU_FECHAASIGNACION,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$model->COAU_FECHAASIGNACION,
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
          <?php echo $form->error($model,'COAU_FECHAASIGNACION'); ?>
          </td>
	    <td>&nbsp;</td>
	    <td>
		  <?php echo $form->labelEx($model,'ESCA_ID'); ?>
          <?php $data = CHtml::listData(Estadoconductoresautomovil::model()->findAll(),'ESCA_ID','ESCA_NOMBRE') ?>
          <?php echo $form->dropDownList($model,'ESCA_ID',$data, array('class'=>'span2',)); ?> 
		  <?php echo $form->error($model,'ESCA_ID'); ?>
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




