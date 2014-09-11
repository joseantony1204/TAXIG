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
      <table width="100%" border="0">
        <tr>
          <td width="48%" align="left">
		  <?php echo $form->labelEx($Informes,'ESDS_ID'); ?>
          <?php $data = CHtml::listData(Estadosdeservicios::model()->findAll(),'ESDS_ID','ESDS_NOMBRE') ?>
          <?php echo $form->dropDownList($Informes,'ESDS_ID',$data, array('class'=>'span3','prompt'=>'Elige...',)); ?> 
		  <?php echo $form->error($Informes,'ESDS_ID'); ?></td>
          <td width="52%" align="left" valign="bottom">
		  <?php echo $form->textFieldRow($Informes,'VEHI_NUMEROMOVIL',array('class'=>'span2')); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left"><?php echo $form->labelEx($Informes,'CONT_FECHAINICIO'); ?>
            <?php    
     $Informes->CONT_FECHAINICIO = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informes,
     'attribute'=>'CONT_FECHAINICIO',
     'value'=>$Informes->CONT_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informes->CONT_FECHAINICIO,
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
          <?php echo $form->error($Informes,'CONT_FECHAINICIO'); ?></td>
          <td align="left" valign="bottom">
	   <?php echo $form->labelEx($Informes,'CONT_FECHAFINAL'); ?>
      <?php    
     $Informes->CONT_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informes,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Informes->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informes->CONT_FECHAFINAL,
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
          <?php echo $form->error($Informes,'CONT_FECHAFINAL'); ?></td>
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
