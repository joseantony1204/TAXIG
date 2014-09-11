<?php
Yii::app()->homeUrl = array('/administrator/');
$this->breadcrumbs=array(
	'Modulo Gerencial'=>array('/administrator/'),
	'Pagos'=>array('admin/pagos/admin',),
	'Facruracion Genaral y Abonos a Cartera',
);
?>

<table width="100%" border="0" align="left" class="">
 
  <tr>
    <td>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'FACTURACIÓN GENERAL', 'content'=> $this->renderPartial("_form",array(
		                                                                                 "Pagos"=>$Pagos,
		                                                                                 "Servicios"=>$Servicios,
		                                                                                 "Pagosconceptos"=>$Pagosconceptos,
		                                                                                 "Pagosservicios"=>$Pagosservicios,
																						),
																		   true
																		  ), 
																		  'active'=>true
			 ),
	    array('label'=>'ABONOS DE CARTERA', 'content'=> $this->renderPartial("searchcartera",array(
		                                                                                 "Creditos"=>$Creditos,
		                                                                                 "Cuotas"=>$Cuotas,
																						),
																		   true
																		  ), 
			 ),
        
    ),
)); ?>
	</td>
  </tr>
</table>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',      
    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>INGRESAR NUEVO SERVICIO</h4>
        </div>
         
        <div class="modal-body">
          <?php
            $this->renderPartial('_formm', array('model'=>$Servicios)); 
		  ?>
         	
        </div>
        
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar ventana',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>


    <?php $this->endWidget(); ?>


<script type="text/javascript">
function sumar(c){
var subtotal = 0;

campo = c.form;
  if(!/^\d*$/.test(c.value)) return;  
      for (var i = 2; i <=campo.length-3; i++) {
          
		  if (!/^\d+$/.test(campo[i].value)) continue;
			  subtotal += parseInt(campo[i].value);
			  
      }
document.getElementById('total').value = subtotal;
}
	
</script>