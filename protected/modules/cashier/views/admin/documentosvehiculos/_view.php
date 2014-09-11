<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOHI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DOHI_ID),array('view','id'=>$data->DOHI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOHI_FECHAVENCIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->DOHI_FECHAVENCIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VEHI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->VEHI_ID); ?>
	<br />


</div>