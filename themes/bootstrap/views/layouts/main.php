<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<html xml:lang="<?php echo Yii::app()->language;?>" lang="<?php echo Yii::app()->language;?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="<?php echo Yii::app()->language;?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body bgcolor="#00CC99">

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse', 
	'fixed'=>'top',    
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(                
            ),
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(		 
             array('label'=>'LOGIN', 'icon'=>'lock - white', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
             array('label'=>''.strtoupper(Yii::app()->user->nombres).'', 'icon'=>'user', 'active'=>true, 
			    'visible'=>!Yii::app()->user->isGuest, 'url'=>'',
				'items'=>array(
				    array('label'=>'ADMINISTRADOR DE URUSARIO','visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Mi Perfil',  
					       'url'=>array('administrator/admin/users/update/id/'.Yii::app()->user->id.''), 
						   'visible'=>!Yii::app()->user->isGuest),
				    array('label'=>'Salir', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                  ),
			  ),
			  
			  array('label'=>'ACERCA DE', 'icon'=>'tags - white', 'url'=>array('/site/page/', 'view'=>'about'),),
		  ),
	  ), 
  ),     
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
 <div class="info"  style="text-align:left">   
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
	   )
    ); ?>
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
	   )
    ); ?>
     <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
	   )
    ); ?>   
    
</div>
        <div id="content">
            <?php echo $content."<br><br>"; ?>
        </div><!-- content -->   
		<div class="clear"></div>
		<div class="clear"></div> 

</div><!-- page -->

<?php /* $this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse',
	'fixed'=>'bottom',
	'brand'=>'',
    'collapse'=>true,
	'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
			array('label'=>'Copyright © '.date("Y").' - '.CHtml::encode(Yii::app()->name).' - Todos Los Derechos Reservados', 'url'=>'')
			 )
			)
		)   
)); */
?> 

<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 10000).slideUp("slow");',
   CClientScript::POS_READY
);
?>
</body>
</html>
