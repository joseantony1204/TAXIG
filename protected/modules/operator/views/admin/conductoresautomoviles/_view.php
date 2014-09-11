<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COAU_ID),array('view','id'=>$data->COAU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAU_FECHAASIGNACION')); ?>:</b>
	<?php echo CHtml::encode($data->COAU_FECHAASIGNACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COND_ID')); ?>:</b>
	<?php echo CHtml::encode($data->COND_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VEHI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->VEHI_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESCA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESCA_ID); ?>
	<br />


</div>