<?php
$this->breadcrumbs=array(
	'Personases',
);

$this->menu=array(
	array('label'=>'Create Personas','url'=>array('create')),
	array('label'=>'Manage Personas','url'=>array('admin')),
);
?>

<h1>Personases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
