<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pagosconceptos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Pagosconceptos); ?>
    
    <?php $conceptos = $Pagosconceptos->searchConceptos($Pagosconceptos->PAGO_ID); ?>
    <table border="0" width="100%">
    <?php 
	 foreach($conceptos as $rows){
	 echo '<tr>';
	 echo '<td width="10%">';
	 ?>	 
	 <input name="CONC_ID[]" type="checkbox" id="CONC_ID[]" value="<?php echo $rows['CONC_ID']?>" 
	 <?php if ($rows['PACO_ID']!= "") echo 'checked="checked"' ?> />
	
	 <?php
     echo '</td>';
	 echo '<td width="30%">';
	 echo $rows['CONC_NOMBRE']; 
	 echo '</td>';
	 echo '<td width="10%">';
	 ?> 
    <input name="PACO_VALOR[]" size="2" type="text" id="PACO_VALOR[]" value="<?php echo $rows['PACO_VALOR']?>" />
     <?php 
	 echo '</td>';
	 
	 echo '<td width="10%">';
	 ?> 
    <input name="PACO_FECHAINGRESO[]" size="2" type="date" id="PACO_FECHAINGRESO[]" value="<?php echo $rows['PACO_FECHAINGRESO']?>" />
     <?php 
	 echo '</td>';
	 echo '<td width="40%" align="left"> Ej: 2013-12-12'; 
	 echo '</td>';
	 echo '</tr>';
	 }
	?>
    </table>

	<?php echo $form->hiddenField($Pagosconceptos,'PAGO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Pagosconceptos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




