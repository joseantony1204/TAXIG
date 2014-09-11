<?php

class InformesController extends Controller
{
	
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		if(!Yii::app()->user->getIsGuest())
        {
		 $Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
		 $curpage = Yii::app()->getController()->id;
		 $controllers = explode('/',$curpage);
		
		 $modulos = Yii::app()->user->modulosUsuarios;
		 $views = Yii::app()->user->viewsAccesoUsuario($this->module->id,$controllers[0],$controllers[1]);
		 foreach($views as $data){
		  $array[] = $data['USVI_URL'];
		 }
		 //echo "<br><br><br>".$Usuario->USUA_USUARIO;
         //'download','clasesc'
         return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				  'actions'=>array(''.$array[0].'',''.$array[1].'',''.$array[2].'',''.$array[3].'',''.$array[4].'',''.$array[5].'',
				  ''.$array[6].'',''.$array[7].'','search','admin'),
				  'users'=>array($Usuario->USUA_USUARIO),
			),			
			array('deny',  // deny all users
				  'users'=>array('*'),
			),	
		 );
	   }else{
		     return array(			
			  array('deny',  // deny all users
				    'users'=>array('*'),
			  ),	
		     );
			}
	}
		
	public function actionAdmin()
	{
	   $Informespagos = new Informespagos;
	   $Pagos = new Pagos;
	   $Personas = new Personas;
	   
	   $Informes = new Informes;
	   $Servicios = new Servicios;
	   
	   $Creditos = new Creditos;
	   
	   $Informesdocumentos = new Informesdocumentos;
	   $Documentosvehiculos = new Documentosvehiculos;	    
	   $Informescumpleanios = new Informescumpleanios;
	   $Informescreditos = new Informescreditos;
	   
	   if((isset($_POST['yt0'])) & (isset($_POST['Informespagos']))){
        $Informespagos->attributes = $_POST['Informespagos'];
		$Informespagos->ESDS_ID != 1;
		$Informespagos->CONC_ID = $Informespagos->attributes=$_POST['Informespagos']["CONC_ID"];
		$Informespagos->VEHI_NUMEROMOVIL = $Informespagos->attributes=$_POST['Informespagos']["VEHI_NUMEROMOVIL"];	   
	    $pagos = $Pagos->reportePagos($Informespagos);
	    $this->render('reportePagos',array(
		                                 'pagos'=>$pagos,
										 'Informespagos'=>$Informespagos,		
		                                 ));
	   }
	   
	   if((isset($_POST['yt1'])) & (isset($_POST['Informes']))){
        $Informes->attributes = $_POST['Informes'];
		$Informes->ESDS_ID = $Informes->attributes=$_POST['Informes']["ESDS_ID"];
		$Informes->VEHI_NUMEROMOVIL = $Informes->attributes=$_POST['Informes']["VEHI_NUMEROMOVIL"];	   
	    $servicios = $Servicios->reporteServicios($Informes);
	    $this->render('reporteServicios',array(
		                                 'servicios'=>$servicios,
										 'Informes'=>$Informes,		
		                                 ));
	   }
	   
	   if((isset($_POST['yt3'])) & (isset($_POST['Informesdocumentos']))){
        $Informesdocumentos->attributes = $_POST['Informesdocumentos'];
		$Informesdocumentos->TIDO_ID = $Informesdocumentos->attributes=$_POST['Informesdocumentos']["TIDO_ID"];   
	    $documentos = $Documentosvehiculos->reporteDocumentosvehiculos($Informesdocumentos);
	    $this->render('reporteDocumentosvehiculos',array(
		                                 'documentos'=>$documentos,
										 'Informesdocumentos'=>$Informesdocumentos,		
		                                 ));
	   }
	   
	   if((isset($_POST['yt4'])) & (isset($_POST['Informescumpleanios']))){
        $Informescumpleanios->attributes = $_POST['Informescumpleanios'];
		$Informescumpleanios->INFO_MES = $Informescumpleanios->attributes=$_POST['Informescumpleanios']["INFO_MES"];   
	    $cumpleanios = $Personas->reporteCumpleanios($Informescumpleanios);
	    $this->render('reporteCumpleanios',array(
		                                 'cumpleanios'=>$cumpleanios,
										 'Informescumpleanios'=>$Informescumpleanios,		
		                                 ));
	   }  
	   
	  		
		if((isset($_POST['yt2'])) & (isset($_POST['Informescreditos']))){
        $Informescreditos->attributes = $_POST['Informescreditos'];
		$Informescreditos->PERS_ID = $Informescreditos->attributes=$_POST['Informescreditos']["PERS_ID"];   
	    $registros = $Creditos->reporteCreditos($Informescreditos);
	    $this->render('reporteCreditos',array(
		                                 'Registros'=>$registros,
										 'Informescreditos'=>$Informescreditos,		
		                                 ));
	   }  
	   
	  $this->render('admin',array(
								   'Informes'=>$Informes,
								   'Informespagos'=>$Informespagos,
								   'Informesdocumentos'=>$Informesdocumentos,
								   'Informescumpleanios'=>$Informescumpleanios,
								   'Informescreditos'=>$Informescreditos,		
		                          )
		);
	}
	
	public function actionSearch($term)
    {
	$criteria = new CDbCriteria;
	$criteria->select = "t.PERS_ID, t.PERS_IDENTIFICACION, t.PERS_NOMBRES, t.PERS_APELLIDOS";			
	$criteria->condition = "
	    LOWER(t.PERS_IDENTIFICACION) like LOWER(:term) OR
		LOWER(t.PERS_NOMBRES) like LOWER(:term) OR
		LOWER(t.PERS_APELLIDOS) like LOWER(:term)";
	$criteria->join = 'INNER JOIN TBL_CREDITOS c ON t.PERS_ID = c.PERS_ID';
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->order = 't.PERS_NOMBRES ASC';
	$criteria->limit = 10;
	
	$data = Personas::model()->findAll($criteria);
	$arr = array();
	foreach ($data as $item) {
	$arr[] = array(
	'id' => $item->PERS_ID,
	'value' => $item->PERS_NOMBRES." ".$item->PERS_APELLIDOS,
	'label' =>"[".$item->PERS_IDENTIFICACION." - ".$item->PERS_NOMBRES." ".$item->PERS_APELLIDOS."]",
	);
	}
	echo CJSON::encode($arr);
    }	
}
