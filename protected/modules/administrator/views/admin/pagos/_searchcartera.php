<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'GET',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); 

?>
        <table width="100%" border="0" align="center">
            <tr>
             <td width="33%" align="center"><?php echo $form->textFieldRow($Creditos,'PERS_IDENTIFICACION',array('class'=>'span2', 'placeholder'=>'IDENTIFICACION')); ?></td>
             <td width="33%"align="center"><?php echo $form->textFieldRow($Creditos,'PERS_NOMBRES',array('class'=>'span2', 'placeholder'=>'NOMBRES')); ?></td>
             <td width="33%"align="center"><?php echo $form->textFieldRow($Creditos,'PERS_APELLIDOS',array('class'=>'span2', 'placeholder'=>'APELLIDOS')); ?></td>
           </tr>
		   <tr>
             <td width="100%" align="left" colspan="3">&nbsp;</td>
           </tr><tr>
             <td width="100%" align="lefth" colspan="3">
<div class="form-actionss">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>			 
			 </td>
           </tr>
        </table>
	

<?php $this->endWidget(); ?>

