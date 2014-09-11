<?php
$this->breadcrumbs=array(
	'Pagoses',
);

$this->menu=array(
	array('label'=>'Create Pagos','url'=>array('create')),
	array('label'=>'Manage Pagos','url'=>array('admin')),
);
?>

<h1>Pagoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
