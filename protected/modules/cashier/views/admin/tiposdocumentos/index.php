<?php
$this->breadcrumbs=array(
	'Tiposdocumentoses',
);

$this->menu=array(
	array('label'=>'Create Tiposdocumentos','url'=>array('create')),
	array('label'=>'Manage Tiposdocumentos','url'=>array('admin')),
);
?>

<h1>Tiposdocumentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
