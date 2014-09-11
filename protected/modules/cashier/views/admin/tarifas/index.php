<?php
$this->breadcrumbs=array(
	'Tarifases',
);

$this->menu=array(
	array('label'=>'Create Tarifas','url'=>array('create')),
	array('label'=>'Manage Tarifas','url'=>array('admin')),
);
?>

<h1>Tarifases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
