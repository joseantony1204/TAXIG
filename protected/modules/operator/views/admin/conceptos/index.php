<?php
$this->breadcrumbs=array(
	'Conceptoses',
);

$this->menu=array(
	array('label'=>'Create Conceptos','url'=>array('create')),
	array('label'=>'Manage Conceptos','url'=>array('admin')),
);
?>

<h1>Conceptoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
