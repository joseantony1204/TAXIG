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
      <?php echo $form->errorSummary($Informescreditos); ?>
      <table width="100%" border="0">
        <tr>
          <td align="left">
		  <?php 
			 echo $form->labelEx($Informescreditos, 'PERS_ID');
			 $this->widget('EJuiAutoCompleteFkField', array(
				  'model'=>$Informescreditos, 
				  'attribute'=>'PERS_ID',
				  'sourceUrl'=>Yii::app()->createUrl('administrator/admin/informes/search'), 
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
			 echo $form->error($Informescreditos, 'PERS_ID');?>
          
          </td>
          <td width="50%" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td width="50%" align="left">
	  <?php echo $form->labelEx($Informescreditos,'CONT_FECHAINICIO'); ?>
      <?php    
     $Informescreditos->CONT_FECHAINICIO = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informescreditos,
     'attribute'=>'CONT_FECHAINICIO',
     'value'=>$Informescreditos->CONT_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informescreditos->CONT_FECHAINICIO,
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
          <?php echo $form->error($Informescreditos,'CONT_FECHAINICIO'); ?></td>
          <td align="left">
	<?php echo $form->labelEx($Informescreditos,'CONT_FECHAFINAL'); ?>
            <?php    
     $Informescreditos->CONT_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informescreditos,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Informescreditos->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informescreditos->CONT_FECHAFINAL,
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
          <?php echo $form->error($Informescreditos,'CONT_FECHAFINAL'); ?></td>
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
