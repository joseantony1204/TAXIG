<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PACO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PACO_ID),array('view','id'=>$data->PACO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PACO_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PACO_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PACO_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->PACO_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PAGO_ID); ?>
	<br />


</div>