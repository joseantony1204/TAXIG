<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIDO_ID),array('view','id'=>$data->TIDO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_NOMBRE); ?>
	<br />


</div>