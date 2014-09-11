<table border="0" width="70%">
  <tr>
    <td width="90%">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'objetos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
      <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
      <table width="100%" border="0">
        <tr>
          <td align="left">
            <?php echo $form->labelEx($Informescumpleanios,'INFO_MES'); 
		  $data = array('01'=>'ENERO','02'=>'FEBRERO','03'=>'MARZO','04'=>'ABRIL','05'=>'MAYO','06'=>'JUNIO',
		                '07'=>'JULIO','08'=>'AGOSTO','09'=>'SEPTIEMBRE','10'=>'OCTUBRE','11'=>'NOVIEMBRE','12'=>'DICIEMBRE');
		  ?>
            <?php echo $form->dropDownList($Informescumpleanios,'INFO_MES',$data,array('class'=>'span3')); ?>
            <?php echo $form->error($Informescumpleanios,'INFO_MES'); ?>
            
          </td>
        </tr>
        <tr>
          <td align="left"><br />            <div class="form-actionss">
              <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
			'size'=>'small',
            'label'=>'Generar y Descargar Reporte',
			'icon'=>'download white',
        )); ?>
          </div></td>
        </tr>
      </table>
      <?php $this->endWidget(); ?></td>
  </tr>
</table>
