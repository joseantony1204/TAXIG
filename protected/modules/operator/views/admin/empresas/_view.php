<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EMPR_ID),array('view','id'=>$data->EMPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPR_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->EMPR_NOMBRE); ?>
	<br />


</div>