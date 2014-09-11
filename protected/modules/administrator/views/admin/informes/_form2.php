<table border="0" width="70%">
  <tr>
    <td width="90%">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'objetos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
      <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
      <?php echo $form->errorSummary($Informespagos); ?>
      <table width="100%" border="0">
        <tr>
          <td align="left"><?php echo $form->labelEx($Informespagos,'CONC_ID'); ?>
            <?php $data = CHtml::listData(Conceptos::model()->findAll(),'CONC_ID','CONC_NOMBRE') ?>
          <?php echo $form->dropDownList($Informespagos,'CONC_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
		  <?php echo $form->error($Informespagos,'CONC_ID'); ?></td>
          <td width="50%" align="left"><?php echo $form->textFieldRow($Informespagos,'VEHI_NUMEROMOVIL',array('class'=>'span2')); ?></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td width="50%" align="left">
	  <?php echo $form->labelEx($Informespagos,'CONT_FECHAINICIO'); ?>
      <?php    
     $Informespagos->CONT_FECHAINICIO = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informespagos,
     'attribute'=>'CONT_FECHAINICIO',
     'value'=>$Informespagos->CONT_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informespagos->CONT_FECHAINICIO,
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
          <?php echo $form->error($Informespagos,'CONT_FECHAINICIO'); ?></td>
          <td align="left"><?php echo $form->labelEx($Informespagos,'CONT_FECHAFINAL'); ?>
            <?php    
     $Informespagos->CONT_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informespagos,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Informespagos->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informespagos->CONT_FECHAFINAL,
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
          <?php echo $form->error($Informespagos,'CONT_FECHAFINAL'); ?></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><br />            <div class="form-actionss">
              <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
			'size'=>'small',
            'label'=>'Generar y Descargar Reporte',
			'icon'=>'download white',
        )); ?>
          </div></td>
        </tr>
      </table>
      <?php $this->endWidget(); ?></td>
  </tr>
</table>
