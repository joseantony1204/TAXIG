<?php
$this->breadcrumbs=array(
	'Conductores',
);

$this->menu=array(
	array('label'=>'Create Conductores','url'=>array('create')),
	array('label'=>'Manage Conductores','url'=>array('admin')),
);
?>

<h1>Conductores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
