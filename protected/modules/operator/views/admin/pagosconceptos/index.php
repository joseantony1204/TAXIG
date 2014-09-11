<?php
$this->breadcrumbs=array(
	'Pagosconceptoses',
);

$this->menu=array(
	array('label'=>'Create Pagosconceptos','url'=>array('create')),
	array('label'=>'Manage Pagosconceptos','url'=>array('admin')),
);
?>

<h1>Pagosconceptoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
