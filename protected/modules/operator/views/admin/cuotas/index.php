<?php
$this->breadcrumbs=array(
	'Cuotases',
);

$this->menu=array(
	array('label'=>'Create Cuotas','url'=>array('create')),
	array('label'=>'Manage Cuotas','url'=>array('admin')),
);
?>

<h1>Cuotases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
