<?php
$this->breadcrumbs=array(
	'Documentosvehiculoses',
);

$this->menu=array(
	array('label'=>'Create Documentosvehiculos','url'=>array('create')),
	array('label'=>'Manage Documentosvehiculos','url'=>array('admin')),
);
?>

<h1>Documentosvehiculoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
