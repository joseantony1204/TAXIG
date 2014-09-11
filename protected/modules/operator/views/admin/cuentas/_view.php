<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CUEN_ID),array('view','id'=>$data->CUEN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_FECHAAPERTURA')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_FECHAAPERTURA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_SALDO')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_SALDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESDC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESDC_ID); ?>
	<br />


</div>