<?php
$this->breadcrumbs=array(
	'Conductoresautomoviles',
);

$this->menu=array(
	array('label'=>'Create Conductoresautomoviles','url'=>array('create')),
	array('label'=>'Manage Conductoresautomoviles','url'=>array('admin')),
);
?>

<h1>Conductoresautomoviles</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
