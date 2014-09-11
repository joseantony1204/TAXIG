<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'servicios-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($model); ?></p>
	<table width="90%" border="0">
	  <tr>
	    <td>
		<?php 
			 echo $form->labelEx($model, 'COAU_ID');
			 $this->widget('EJuiAutoCompleteFkField', array(
				  'model'=>$model, 
				  'attribute'=>'COAU_ID',
				  'sourceUrl'=>Yii::app()->createUrl('administrator/admin/servicios/moviles'), 
				  'showFKField'=>false,
				  'FKFieldSize'=>50, 
				  'relName'=>'cOAU',
				  'displayAttr'=>'cOAU->vEHI->VEHI_NUMEROMOVIL',
				  'autoCompleteLength'=>60,
				  'htmlOptions' => array('style' => 'width:90%; float:left;'),
				  'options'=>array(
					  'minLength'=>1, 
				  ),
			 ));
			 echo $form->error($model, 'COAU_ID');?>
         </td>
	    <td>&nbsp;</td>
	    <td width="43%">		
		<?php echo $form->labelEx($model,'ESDS_ID'); ?>
        <?php $data = CHtml::listData(Estadosdeservicios::model()->findAll(),'ESDS_ID','ESDS_NOMBRE') ?>
        <?php echo $form->dropDownList($model,'ESDS_ID',$data, array('class'=>'span3',)); ?> 
		<?php echo $form->error($model,'ESDS_ID'); ?></td>
	    </tr>
	  <tr>
	    <td width="37%">&nbsp;</td>
	    <td width="20%">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		  <?php echo $form->labelEx($model,'TARI_ID'); ?>
          <?php $data = CHtml::listData(Tarifas::model()->findAll(),'TARI_ID','TARI_VALOR','TARI_DESCRIPCION') ?>
          <?php echo $form->dropDownList($model,'TARI_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
		  <?php echo $form->error($model,'TARI_ID'); ?></td>
	    <td>&nbsp;</td>
	    <td>
		  <?php echo $form->labelEx($model,'SERVI_FECHAINGRESO'); ?>
          <?php
             if($model->SERVI_FECHAINGRESO=='') {
             $model->SERVI_FECHAINGRESO = date("Y-m-d").' '.date("H:m:s");
             }else{
			 $model->SERVI_FECHAINGRESO = date("Y-m-d").' '.date("H:m:s");
			 }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'SERVI_FECHAINGRESO',
             'value'=>$model->SERVI_FECHAINGRESO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$model->SERVI_FECHAINGRESO,
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
          <?php echo $form->error($model,'SERVI_FECHAINGRESO'); ?></td>
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




