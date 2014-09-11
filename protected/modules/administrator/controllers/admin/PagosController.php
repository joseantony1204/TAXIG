<?php

class PagosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
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
				''.$array[6].'',''.$array[7].'','pagos','graltxt','central','obtenerServicio','obtenerPago','gral',
				'ahorro','tarifa','obtenerCreditos','pagostarifas','agregarservicios','agregarabonos'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionAgregarabonos()
	{
	 
	 $Pagos = new Pagos;
	 $Creditos = new Creditos;	 
	 $Cuotas = new Cuotas;
		
	   if(isset($_POST['Cuotas']))
		{
		 $Cuotas->attributes=$_POST['Cuotas'];
		 $Pagos->PAGO_FECHAREGISTRO = date("Y-m-d");
		 $Pagos->USUA_ID =  Yii::app()->user->id;
		 if($Cuotas->CRED_ID!=''){
		  if($Pagos->save()){
			 $Cuotas->PAGO_ID = $Pagos->PAGO_ID;
			 if($Cuotas->save()){				
				$Creditos->updateEstado($Cuotas->CRED_ID);				
			 }		    
		   }		 
		  }
		}
	}
	
	public function actionAgregarservicios()
	{
		$Servicios = new Servicios;
		/**
		*inicio bloque para crear servicios
		*/
		 if(isset($_POST['Servicios']))
		 {
		 $Servicios->attributes=$_POST['Servicios'];			
		  if($Servicios->save()){
			$Servicios->unsetAttributes();
		  }	
		 }
		
		/**
		*fin de bloque para crear servicios
		*/
	}
	
	public function actionPagostarifas()
	{
		 $Pagos = new Pagos;
		 $Servicios = new Servicios;
		 $Pagosconceptos = new Pagosconceptos;
		 $Pagosservicios = new Pagosservicios;
		 
		 $Pagos->attributes=$_POST['Pagos'];
		 $Servicios->attributes=$_POST['Servicios'];
		 $Pagosconceptos->attributes=$_POST['Pagosconceptos'];
		 $Pagosservicios->attributes=$_POST['Pagosservicios'];
		 
		 $Pagos->PAGO_FECHAREGISTRO = $Servicios->SERVI_FECHAINGRESO;
		 $Servicio = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
		 $Pagos->USUA_ID =  Yii::app()->user->id;
		 
		 if($Pagosservicios->SERV_ID!=''){
		  if($Pagos->save()){
		 
		  $Pagosservicios->PAGO_ID =  $Pagos->PAGO_ID;
		  if($Pagosservicios->save()){
		   $Servicio->ESDS_ID = 2;
		   $Servicio->save();
		   
		   $PACO_VALOR = $_POST["PACO_VALOR"];
		   $PACO_FECHAINGRESO = $Pagos->PAGO_FECHAREGISTRO;
		   
		   foreach ($_POST['PACO_VALOR'] as $concepto=>$valor ){
			  
			  $criteria = new CDbCriteria;
		      $criteria->condition = 'PASE_ID = '.$Pagosservicios->PASE_ID.' AND CONC_ID = '.$concepto;
			  if($Pagosconcepto = Pagosconceptos::model()->find($criteria)){
		       $Pagosconceptos = Pagosconceptos::model()->findByPk($Pagosconcepto->PACO_ID);
			  }else{
					$Pagosconceptos = new Pagosconceptos;
				   }
			   	
               $Conceptos = Conceptos::model()->findByPk($concepto);
			   
			  
			    $Pagosconceptos->CONC_ID = $concepto;
			    $Pagosconceptos->PACO_VALOR = $valor;
			    $Pagosconceptos->PACO_FECHAINGRESO = $Pagos->PAGO_FECHAREGISTRO;
			    $Pagosconceptos->PASE_ID = $Pagosservicios->PASE_ID;
			    $Pagosconceptos->save();
			   
			   if($Conceptos->TICO_ID==1){
				
			    // para la tarfa central incompleta
			   if($Pagosconceptos->CONC_ID==1){
			     if($Pagosconceptos->PACO_VALOR==0){
				  
				  $Servicio->ESDS_ID = 3;
		          $Servicio->save();  
			     }
			   } 
			  
			   // para la hacer un ahorro
			   if($Pagosconceptos->CONC_ID==2){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchConductor($Pagosservicios->PASE_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			   }
			  
			   // para la tarifa del vehiculo
			   if($Pagosconceptos->CONC_ID==3){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchPersona($Pagosservicios->PASE_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			   }
			  }elseif($Conceptos->TICO_ID==2){
			        // para abonos a la cartera			    
					  if($Pagosconceptos->PACO_VALOR>0){
					   $Creditos = new Creditos; 
					   $Creditos->searchCredito($Pagosservicios, $Pagosconceptos);  
					  }				     			   
				   }		  			  		 
			 }			
		    			
		   }
		  }
		 }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$Servicios = new Servicios('searchServices');
		$Servicios->unsetAttributes();
		$Pagos = new Pagos('searchPagos');
		$Pagos->unsetAttributes();
		
		/**
		*Iniciando bloque que ingresa abonos a cartera
		*/
		$Creditos = new Creditos('buscar');
		$Cuotas = new Cuotas;
		$Creditos->unsetAttributes();
			
		
		if((isset($_GET['Creditos'])))
		{			    
			$PERS_IDENTIFICACION = $Creditos->attributes=$_GET['Creditos']['PERS_IDENTIFICACION'];	
			$PERS_NOMBRES = $Creditos->attributes=$_GET['Creditos']['PERS_NOMBRES']; 	
			$PERS_APELLIDOS = $Creditos->attributes=$_GET['Creditos']['PERS_APELLIDOS'];
			if(($PERS_IDENTIFICACION!=NULL) OR ($PERS_NOMBRES!=NULL) OR ($PERS_APELLIDOS!=NULL)){
			 $Creditos->attributes=$_GET['Creditos'];			
		    }else{	
			      $Creditos->PERS_ID = '0';		     
			     }  
		}else{	
			 $Creditos->PERS_ID = '0';		     
			 }
		/*
		* finalizando bloque de abonos a cartera
		*/
		
		$Pagosconceptos = new Pagosconceptos;
		$Pagosservicios = new Pagosservicios;
		
		if((isset($_GET['Servicios'])) or (isset($_GET['Pagos']))){
			$Servicios->attributes=$_GET['Servicios'];
			$Pagos->attributes=$_GET['Pagos'];
		}else{
			 $Servicios->SERVI_FECHAINGRESO = date("Y-m-d");
			 $Pagos->PAGO_FECHAREGISTRO = date("Y-m-d");
			 }			 

        $this->render('create',array(
			'Pagos'=>$Pagos,
			'Servicios'=>$Servicios,
			'Pagosconceptos'=>$Pagosconceptos,
			'Pagosservicios'=>$Pagosservicios,
			'Creditos'=>$Creditos,
			'Cuotas'=>$Cuotas,
		));
	}
	
	public function actionCreates($id)
	{
		$Servicios = Servicios::model()->findByPk($id);
		$Pagos = new Pagos;
		$Pagosconceptos = new Pagosconceptos;
				
		
		$Pagos->PAGO_FECHAREGISTRO = date("Y-m-d").' '.date("H:m:s");
		$Pagos->SERV_ID = $Servicios->SERVI_ID;
		$Pagos->save();
							
		$Tarifas = Tarifas::model()->findByPk($Servicios->TARI_ID);		
		$Pagosconceptos->PAGO_ID = $Pagos->PAGO_ID;
		$Pagosconceptos->PACO_VALOR = $Tarifas->TARI_VALOR;
		$Pagosconceptos->PACO_FECHAINGRESO = $Pagos->PAGO_FECHAREGISTRO;
		$Pagosconceptos->CONC_ID = 1;
		$Pagosconceptos->save();
		
		$Servicios->ESDS_ID = 2;
		$Servicios->save();		
        $this->redirect(array('admin/pagosconceptos/create','id'=>$Pagos->PAGO_ID));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$Servicios = Servicios::model()->findByPk($id);
		$criteria = new CDbCriteria;
		$criteria->condition = 'SERV_ID = '.$Servicios->SERVI_ID;
		$criteria->order = 'PAGO_FECHAREGISTRO DESC';
		$Pago = Pagos::model()->find($criteria);
		$Pagos = Pagos::model()->findByPk($Pago->PAGO_ID);

		$this->redirect(array('admin/pagosconceptos/create','id'=>$Pagos->PAGO_ID));;
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$Pagos = $this->loadModel($id);
			
			$criteria = new CDbCriteria;
		    $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
		    $Pagoservicio = Pagosservicios::model()->find($criteria);
		    $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);
			
			$Servicio = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
		    $Servicio->ESDS_ID = 1;
		    $Servicio->save();
		    $Pagos->delete();
			

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])){
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				$this->refresh();
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pagos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	public function actionAdmin($id=NULL)
	{
		
		$model = new Pagos('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Pagos'])){
			$model->attributes=$_GET['Pagos'];
		}else{
			 $model->PAGO_FECHAREGISTRO = date("Y-m-d");
			 }
			 
		if($id!=NULL){
		$Pagos = Pagos::model()->findByPk($id);
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
		$Pagoservicio = Pagosservicios::model()->find($criteria);
		$Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);		
		
		$Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
		$Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
		$Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
		$model->unsetAttributes();
		$model->VEHI_NUMEROMOVIL = $Vehiculos->VEHI_NUMEROMOVIL;
		}	 
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Pagos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionObtenerServicio($id)
	{
         $resp = Servicios::model()->findAllByAttributes(array('SERVI_ID'=>$id));
	 header("Content-type: application/json");
	 echo CJSON::encode($resp);
	}
	
	public function actionObtenerCreditos($id)
	{
     $resp = Creditos::model()->findAllByAttributes(array('CRED_ID'=>$id));
	 header("Content-type: application/json");
	 echo CJSON::encode($resp);
	}
	
	public function actionObtenerPago($id)
	{
     $resp = Pagos::model()->findAllByAttributes(array('PAGO_ID'=>$id));
	 header("Content-type: application/json");
	 echo CJSON::encode($resp);
	}
	
	public function actionCentral($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
     $Pagoservicio = Pagosservicios::model()->find($criteria);
     $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);
	 $this->render('facturaCentral',array(
										  'Pagos'=>$Pagos,
                                          'Pagosservicios'=>$Pagosservicios,										  
		                                 ));
	}
	
	public function actionGraltxt($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaGeneraltxt',array(
								   'Pagos'=>$Pagos,		
		                          )
				  );
	 exec("C:/wamp/www/TAXIG/F.bat");	
	 //$this->redirect('/TAXIG/administrator/admin/pagos/create');		 
	}
	
	public function actionGral($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
     $Pagoservicio = Pagosservicios::model()->find($criteria);
     $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);
	 $this->render('facturaGeneral',array(
										  'Pagos'=>$Pagos,
                                          'Pagosservicios'=>$Pagosservicios,										  
		                                 ));
	}
	
	public function actionAhorro($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
     $Pagoservicio = Pagosservicios::model()->find($criteria);
     $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);
	 $this->render('facturaAhorro',array(
										  'Pagos'=>$Pagos,
                                          'Pagosservicios'=>$Pagosservicios,										  
		                                 ));
	}
	
	public function actionTarifa($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID;
     $Pagoservicio = Pagosservicios::model()->find($criteria);
     $Pagosservicios = Pagosservicios::model()->findByPk($Pagoservicio->PASE_ID);
	 $this->render('facturaTarifa',array(
										  'Pagos'=>$Pagos,		
										  'Pagosservicios'=>$Pagosservicios,		
		                                 ));
	}
	
	public function actionPagos()
	{
     set_time_limit(0);
	 $connection = Yii::app()->db;
	 $sql = "SELECT ps.PERS_ID, ps.PERS_NOMBRES, ps.PERS_APELLIDOS, p.PAGO_ID, pc.CONC_ID,  pc.PACO_FECHAINGRESO, pc.PACO_VALOR
FROM
tbl_personas ps,tbl_conductores c, 
tbl_conductoresautomovoles ca,tbl_servicios s, tbl_pagos p, TBL_PAGOSSERVICIOS psr, 
tbl_pagosconceptos pc
WHERE
ps.PERS_ID = c.PERS_ID
AND c.COND_ID = ca.COND_ID  AND ca.COAU_ID = s.COAU_ID AND s.SERVI_ID = psr.SERV_ID AND p.PAGO_ID = psr.PAGO_ID 
AND psr.PASE_ID = pc.PASE_ID AND (pc.CONC_ID = 6 OR pc.CONC_ID = 7 OR pc.CONC_ID = 8 
OR pc.CONC_ID = 9)
AND pc.PACO_VALOR !=0
			";
     $rows = $connection->createCommand($sql)->queryAll();
	 $i=1;
	 foreach($rows as $row){
	  $string = "SELECT * FROM TBL_CREDITOS WHERE PERS_ID = ".$row["PERS_ID"];
	  $creditos = $connection->createCommand($string)->queryAll();
	  if(count($creditos)>0){
	   foreach($creditos as $credito=>$valor){
	    echo $i." - TIENE CREDITO > SE ACTUALIZARA ".$row["PERS_ID"]." - ".$row["PERS_NOMBRES"]."<br>";
		$Model = Creditos::model()->findByPk($valor);
		$Cuotas = new Cuotas;
		$Cuotas->CUOT_VALOR = $row["PACO_VALOR"];
        $Cuotas->CUOT_FECHAPAGO = $row["PACO_FECHAINGRESO"];
        $Cuotas->CRED_ID = $Model->CRED_ID;
        $Cuotas->PAGO_ID = $row["PAGO_ID"];
        $Cuotas->CONC_ID = $row["CONC_ID"];
        //$Cuotas->save();		
	   }
	  }else{
	         echo $i." - NO TIENE CREDITO > SE AGREGARA ".$row["PERS_ID"]." - ".$row["PERS_NOMBRES"]."<br>";
		     $Model = new Creditos;
             $Model->CRED_VALOR = 0;
             $Model->CRED_FECHAINICIO = '0000-00-00';
             $Model->CRED_FECHAFINAL = '0000-00-00';
             $Model->CRED_TASAINTERES =0;
             $Model->CRED_PLAZO = 0;
             $Model->ESCR_ID = 2;
             $Model->PERS_ID = $row["PERS_ID"];		   
            // $Model->save();
   			 
			 $Cuotas = new Cuotas;
		     $Cuotas->CUOT_VALOR = $row["PACO_VALOR"];
             $Cuotas->CUOT_FECHAPAGO = $row["PACO_FECHAINGRESO"];
             $Cuotas->CRED_ID = $Model->CRED_ID;
			 $Cuotas->PAGO_ID = $row["PAGO_ID"];
             $Cuotas->CONC_ID = $row["CONC_ID"];
            // $Cuotas->save();
		   }
		   
	 $i++;
	 }
	}
}
