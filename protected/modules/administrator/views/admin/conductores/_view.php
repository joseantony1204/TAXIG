<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COND_ID),array('view','id'=>$data->COND_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_NUMLICENCIA')); ?>:</b>
	<?php echo CHtml::encode($data->COND_NUMLICENCIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_FECHAEXPEDICION')); ?>:</b>
	<?php echo CHtml::encode($data->COND_FECHAEXPEDICION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_FECHAVENCIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->COND_FECHAVENCIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_CATEGORIA')); ?>:</b>
	<?php echo CHtml::encode($data->COND_CATEGORIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />


</div>