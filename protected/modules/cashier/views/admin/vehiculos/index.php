<?php
$this->breadcrumbs=array(
	'Vehiculoses',
);

$this->menu=array(
	array('label'=>'Create Vehiculos','url'=>array('create')),
	array('label'=>'Manage Vehiculos','url'=>array('admin')),
);
?>

<h1>Vehiculoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
