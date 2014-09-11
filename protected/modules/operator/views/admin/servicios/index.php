<?php
$this->breadcrumbs=array(
	'Servicioses',
);

$this->menu=array(
	array('label'=>'Create Servicios','url'=>array('create')),
	array('label'=>'Manage Servicios','url'=>array('admin')),
);
?>

<h1>Servicioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
