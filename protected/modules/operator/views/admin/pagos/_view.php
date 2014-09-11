<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PAGO_ID),array('view','id'=>$data->PAGO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGO_FECHAREGISTRO')); ?>:</b>
	<?php echo CHtml::encode($data->PAGO_FECHAREGISTRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SERV_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SERV_ID); ?>
	<br />


</div>