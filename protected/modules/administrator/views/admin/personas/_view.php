<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PERS_ID),array('view','id'=>$data->PERS_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_NOMBRES')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_NOMBRES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_APELLIDOS')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_APELLIDOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_IDENTIFICACION')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_IDENTIFICACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_SANGRERH')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_SANGRERH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_LUGAREXPIDENTIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_LUGAREXPIDENTIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_FECHANACIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_FECHANACIMIENTO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_DIRECCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEXO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEXO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIID_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIID_ID); ?>
	<br />

	*/ ?>

</div>