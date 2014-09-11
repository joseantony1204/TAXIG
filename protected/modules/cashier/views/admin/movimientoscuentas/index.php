<?php
$this->breadcrumbs=array(
	'Movimientoscuentases',
);

$this->menu=array(
	array('label'=>'Create Movimientoscuentas','url'=>array('create')),
	array('label'=>'Manage Movimientoscuentas','url'=>array('admin')),
);
?>

<h1>Movimientoscuentases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
