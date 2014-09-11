<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SERVI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SERVI_ID),array('view','id'=>$data->SERVI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SERVI_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->SERVI_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TARI_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->COAU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESDS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESDS_ID); ?>
	<br />


</div>