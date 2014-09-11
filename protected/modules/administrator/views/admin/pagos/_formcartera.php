<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pagos-grid',
	//'selectableRows'=>1,
	//'selectionChanged'=>'seleccionRows',
	'dataProvider'=>$Pagos->searchPagos(),
	'type'=>'striped bordered condensed',
    'filter'=>$Pagos,	
	'columns'=>array(
	    
		array('name'=>'PAGO_ID', 'value'=>'$data->PAGO_ID',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80')),
		
		array('name'=>'VEHI_NUMEROMOVIL', 'value'=>'$data->VEHI_NUMEROMOVIL',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'90')),
		
		
		array('name'=>'PACO_VALOR', 'value'=>'$data->PACO_VALOR', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'100')),
		
		array(
            'name' => 'PAGO_FECHAREGISTRO',
            'value' => '$data->PAGO_FECHAREGISTRO',
			'htmlOptions'=>array('width'=>'120'),
            'filter' => 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $Pagos, 
			'attribute' =>'PAGO_FECHAREGISTRO', 
			'language' => 'es',
			'htmlOptions' => array('id' => 'date_purchased_search','size' => '10'), 
			'options' => array(
			                   'dateFormat'=>'yy-mm-dd',
							   'buttonImageOnly'=>true, 
							   'changeMonth' => true, 
							   'changeYear' => true,
							   'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
							   'buttonImageOnly'=>true,
							   'buttonText'=>'Fecha Ingreso',
							   'selectOtherMonths'=>true,
							   'showAnim'=>'slide',
							   'showButtonPanel'=>true,
							   'showOn'=>'focus',
							   'showOtherMonths'=>true,
							   )
		    ), true),
        ),
		
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{factura}&nbsp;&nbsp;{delete}',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'50',
								   ), 
              'buttons'=>array( 
				'factura' => array(
			    'label'=>'Imprmir Factura',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/imp.png',
			    'url'=>'Yii::app()->controller->createUrl("admin/pagos/graltxt", 
				 array("id"=>$data[PAGO_ID],))',
				 //'options'=>array("target"=>"_blank"),
				),
				
				
			   ),
			  'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),
	),
)); ?>