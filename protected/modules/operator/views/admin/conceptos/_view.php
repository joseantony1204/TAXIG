<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CONC_ID),array('view','id'=>$data->CONC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONC_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CONC_NOMBRE); ?>
	<br />


</div>