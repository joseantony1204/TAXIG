<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CRED_ID),array('view','id'=>$data->CRED_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_FECHAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_FECHAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_FECHAFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_FECHAFINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_TASAINTERES')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_TASAINTERES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_PLAZO')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_PLAZO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESCR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESCR_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	*/ ?>

</div>