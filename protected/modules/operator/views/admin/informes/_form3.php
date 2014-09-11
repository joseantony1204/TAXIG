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
      <?php //echo $form->errorSummary($Informesdocumentos); ?>
      <table width="100%" border="0">
        <tr>
          <td width="50%" align="left">
		  <?php echo $form->labelEx($Informesdocumentos,'TIDO_ID'); ?>
          <?php $data = CHtml::listData(Tiposdocumentos::model()->findAll(),'TIDO_ID','TIDO_NOMBRE') ?>
          <?php echo $form->dropDownList($Informesdocumentos,'TIDO_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
		  <?php echo $form->error($Informesdocumentos,'TIDO_ID'); ?></td>
          <td width="50%" align="left">
          
	 <?php echo $form->labelEx($Informesdocumentos,'CONT_FECHAFINAL'); ?>
     <?php    
     $Informesdocumentos->CONT_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informesdocumentos,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Informesdocumentos->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informesdocumentos->CONT_FECHAFINAL,
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
          <?php echo $form->error($Informesdocumentos,'CONT_FECHAFINAL'); ?></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
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
