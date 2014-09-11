<?php
$this->breadcrumbs=array(
	'Creditoses',
);

$this->menu=array(
	array('label'=>'Create Creditos','url'=>array('create')),
	array('label'=>'Manage Creditos','url'=>array('admin')),
);
?>

<h1>Creditoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
