<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USPU_ID),array('view','id'=>$data->USPU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USUA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USPE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPU_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->USPU_FECHAINGRESO); ?>
	<br />


</div>