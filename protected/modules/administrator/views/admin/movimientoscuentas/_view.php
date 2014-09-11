<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOCU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MOCU_ID),array('view','id'=>$data->MOCU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOCU_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->MOCU_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOCU_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->MOCU_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIMC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIMC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_ID); ?>
	<br />


</div>