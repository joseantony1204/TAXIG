<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vehiculos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Personas); ?>    
	<table width="100%" border="0" align="center">
	  <tr>
	    <td><table width="100%" border="0">
	      <tr>
	        <td>
            <h5>DATOS DE LA PERSONA</h5>
            <fieldset>
            <table width="100%" border="0">
	          <tr>
	            <td>
				<?php echo $form->labelEx($Personas,'TIID_ID'); ?>
                <?php $data = CHtml::listData(Tiposidentificacion::model()->findAll(),'TIID_ID','TIID_NOMBRE') ?>
                <?php echo $form->dropDownList($Personas,'TIID_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?> 
				<?php echo $form->error($Personas,'TIID_ID'); ?></td>
	            <td>&nbsp;</td>
	            <td><?php echo $form->textFieldRow($Personas,'PERS_IDENTIFICACION',array('class'=>'span4')); ?></td>
	            </tr>
	          <tr>
	            <td>&nbsp;</td>
	            <td>&nbsp;</td>
	            <td>&nbsp;</td>
	            </tr>
	          <tr>
	            <td width="33%"><?php echo $form->textFieldRow($Personas,'PERS_LUGAREXPIDENTIDAD',array('class'=>'span4')); ?></td>
	            <td width="35%">&nbsp;</td>
	            <td width="32%">
				<?php echo $form->labelEx($Personas,'SEXO_ID'); ?>
                <?php $data = CHtml::listData(Sexos::model()->findAll(),'SEXO_ID','SEXO_NOMBRE') ?>
                <?php echo $form->dropDownList($Personas,'SEXO_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?> 
				<?php echo $form->error($Personas,'SEXO_ID'); ?> </td>
	          </tr>
              
              <tr>
	            <td>&nbsp;</td>
	            <td>&nbsp;</td>
	            <td>&nbsp;</td>
	          </tr>
              
              <tr>
                <td><?php echo $form->textFieldRow($Personas,'PERS_NOMBRES',array('class'=>'span4')); ?></td>
                <td>&nbsp;</td>
                <td><?php echo $form->textFieldRow($Personas,'PERS_APELLIDOS',array('class'=>'span4')); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><?php echo $form->textFieldRow($Personas,'PERS_SANGRERH',array('class'=>'span4')); ?></td>
                <td>&nbsp;</td>
                <td><?php echo $form->textFieldRow($Personas,'PERS_TELEFONO',array('class'=>'span4')); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><?php echo $form->textFieldRow($Personas,'PERS_DIRECCION',array('class'=>'span4')); ?></td>
                <td>&nbsp;</td>
                <td><?php echo $form->textFieldRow($Personas,'PERS_CIUDAD',array('class'=>'span4')); ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
	            <td>
          <?php echo $form->labelEx($Personas,'PERS_FECHANACIMIENTO'); ?>
          <?php
             if($Personas->PERS_FECHANACIMIENTO=='') {
             $Personas->PERS_FECHANACIMIENTO = date("Y-m-d");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Personas,
             'attribute'=>'PERS_FECHANACIMIENTO',
             'value'=>$Personas->PERS_FECHANACIMIENTO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$Personas->PERS_FECHANACIMIENTO,
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
          <?php echo $form->error($Personas,'PERS_FECHANACIMIENTO'); ?>
                </td>
	            <td>&nbsp;</td>
	            <td><?php echo $form->hiddenField($Personas,'PERS_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"))); ?></td>
	          </tr>
	       </table>
           </fieldset>
           </td>
	        </tr>
	      </table></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    </tr>
	  </table>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Personas->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>