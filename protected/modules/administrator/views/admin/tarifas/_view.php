<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TARI_ID),array('view','id'=>$data->TARI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->TARI_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->TARI_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_VALORBASEMES')); ?>:</b>
	<?php echo CHtml::encode($data->TARI_VALORBASEMES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TARI_HORADEPAGO')); ?>:</b>
	<?php echo CHtml::encode($data->TARI_HORADEPAGO); ?>
	<br />


</div>