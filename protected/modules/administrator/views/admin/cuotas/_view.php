<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUOT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CUOT_ID),array('view','id'=>$data->CUOT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUOT_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->CUOT_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUOT_FECHAPAGO')); ?>:</b>
	<?php echo CHtml::encode($data->CUOT_FECHAPAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRED_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CRED_ID); ?>
	<br />


</div>