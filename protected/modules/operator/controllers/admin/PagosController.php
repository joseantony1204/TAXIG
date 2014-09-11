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
				''.$array[6].'',''.$array[7].'',''.$array[8].'','graltxt','central','obtenerServicio','obtenerPago','gral','ahorro','tarifa'),
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
		
		$Pagosconceptos = new Pagosconceptos;
		
		if((isset($_GET['Servicios'])) or (isset($_GET['Pagos']))){
			$Servicios->attributes=$_GET['Servicios'];
			$Pagos->attributes=$_GET['Pagos'];
		}else{
			 $Servicios->SERVI_FECHAINGRESO = date("Y-m-d");
			 }
			 
		if(isset($_POST['Pagos']))
		{
		 $Pagos->attributes=$_POST['Pagos'];
		 $Servicios->attributes=$_POST['Servicios'];
		 $Pagosconceptos->attributes=$_POST['Pagosconceptos'];
		 $Pagos->PAGO_FECHAREGISTRO = $Servicios->SERVI_FECHAINGRESO;
		 $Servicio = Servicios::model()->findByPk($Pagos->SERV_ID);
		 $Pagos->USUA_ID =  Yii::app()->user->id;
		 if($Pagos->save()){
		   $Servicio->ESDS_ID = 2;
		   $Servicio->save();
		   
		   $PACO_VALOR = $_POST["PACO_VALOR"];
		   $PACO_FECHAINGRESO = $Pagos->PAGO_FECHAREGISTRO;
		   
		   foreach ($_POST['PACO_VALOR'] as $concepto=>$valor ){
			  
			  $criteria = new CDbCriteria;
		      $criteria->condition = 'PAGO_ID = '.$Pagos->PAGO_ID.' AND CONC_ID = '.$concepto;
			  if($Pagosconcepto = Pagosconceptos::model()->find($criteria)){
		       $Pagosconceptos = Pagosconceptos::model()->findByPk($Pagosconcepto->PACO_ID);
			  }else{
					$Pagosconceptos = new Pagosconceptos;
				   }
				   
			  $Pagosconceptos->CONC_ID = $concepto;
			  $Pagosconceptos->PACO_VALOR = $valor;
			   $Pagosconceptos->PACO_FECHAINGRESO = date("Y-m-d").' '.date("h:i:s");
			   $Pagosconceptos->PAGO_ID = $Pagos->PAGO_ID;
			   $Pagosconceptos->save();
			   
			   /* para la tarfa cntral incompleta*/
			  if($Pagosconceptos->CONC_ID==1){
			     if($Pagosconceptos->PACO_VALOR==0){
				  
				  $Servicio->ESDS_ID = 3;
		          $Servicio->save();  
			     }
			  } 
			  
			  /* para la hacer un ahorro*/
			  if($Pagosconceptos->CONC_ID==2){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchConductor($Pagos->PAGO_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			  }
			  
			  /* para la tarfa del vehiculo*/
			  if($Pagosconceptos->CONC_ID==3){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchPersona($Pagos->PAGO_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			  }
			  
			  /* para la tarfa del vehiculo*/
			  if($Pagosconceptos->CONC_ID==6){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Creditos = new Creditos; 
				  $Creditos->searchCredito($Pagos->PAGO_ID,$Pagosconceptos->PACO_VALOR);  
			     }
			  }
			  			  		 
			 }
			$Pagos->unsetAttributes();		 
		 }
		}	 
	
        $this->render('create',array(
			'Pagos'=>$Pagos,
			'Servicios'=>$Servicios,
			'Pagosconceptos'=>$Pagosconceptos,
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
			$Servicio = Servicios::model()->findByPk($Pagos->SERV_ID);
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
		$Servicios = Servicios::model()->findByPk($Pagos->SERV_ID);
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
	
	public function actionObtenerPago($id)
	{
     $resp = Pagos::model()->findAllByAttributes(array('PAGO_ID'=>$id));
	 header("Content-type: application/json");
	 echo CJSON::encode($resp);
	}
	
	public function actionCentral($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaCentral',array(
										  'Pagos'=>$Pagos,		
		                                 ));
	}
	
	public function actionGraltxt($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaGeneraltxt',array(
										  'Pagos'=>$Pagos,		
		                                 ));
										 
    $this->redirect('/TAXIG/exec.php');									 
	}
	
	public function actionGral($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaGeneral',array(
										  'Pagos'=>$Pagos,		
		                                 ));
	}
	
	public function actionAhorro($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaAhorro',array(
										  'Pagos'=>$Pagos,		
		                                 ));
	}
	
	public function actionTarifa($id)
	{
     $Pagos = Pagos::model()->findByPk($id);
	 $this->render('facturaTarifa',array(
										  'Pagos'=>$Pagos,		
		                                 ));
	}
}
