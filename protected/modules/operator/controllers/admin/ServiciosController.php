<?php

class ServiciosController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'','download','moviles','cambiarEstado'),
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
		$model=new Servicios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Servicios']))
		{
			$model->attributes=$_POST['Servicios'];
			if($model->save()){
				$this->redirect(array('admin'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Servicios']))
		{
			$model->attributes=$_POST['Servicios'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->SERVI_ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Servicios');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($numero=NULL)
	{
		$model = new Servicios('search');
		$model->unsetAttributes();  // clear any default values
		
		
		
		if(isset($_GET['Servicios'])){
			$model->attributes=$_GET['Servicios'];			
			Yii::app()->user->setState('ServiciosSearchParams', $_GET['Servicios']);
		}else{
			  if($numero!=NULL){
		       $model->VEHI_NUMEROMOVIL = $numero;
		       $model->ESDS_ID = 1 ;
               Yii::app()->user->setState('ServiciosSearchParams', $model->attributes);			   
		      }else{
			         $model->SERVI_FECHAINGRESO = date("Y-m-d");
			         Yii::app()->user->setState('ServiciosSearchParams', $model->attributes);
			       }
			 }
			 
			 
			 
		if(isset($_POST['Servicios']))
		{
			$model->attributes=$_POST['Servicios'];
			if($model->verificarEstado($model)=='false'){			
			 if($model->save()){
				$this->redirect(array('admin'));
			 }
			}else{				  
				  $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($model->COAU_ID);
				  $Conductores = Conductores::model()->findByPk($Conductoresautomoviles->COND_ID);
				  $Personas = Personas::model()->findByPk($Conductores->PERS_ID);
				  $Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
				  $msj = 'Lo sentimos, el conductor <strong>'.$Personas->nombreCompleto.'</strong> tiene uno o varios servicios perdientes.<br>
				          Verifique y vuelva a intentarlo.';
				  Yii::app()->user->setFlash('error','<strong>Oppss!. </strong>'.$msj);				  
				  $this->redirect(array('admin','numero'=>$Vehiculos->VEHI_NUMEROMOVIL));
				 }	
		}	 
			 
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Servicios::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='servicios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionMoviles($term)
    {
	$criteria = new CDbCriteria;
	$criteria->select = "t.COAU_ID, v.VEHI_NUMEROMOVIL, v.VEHI_PLACA";		
	$criteria->join ='
		INNER JOIN TBL_VEHICULOS v ON v.VEHI_ID = t.VEHI_ID AND t.ESCA_ID = 1';	
	$criteria->condition = "
	    LOWER(v.VEHI_NUMEROMOVIL) like LOWER(:term) OR
		LOWER(v.VEHI_PLACA) like LOWER(:term)";
	
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->order = 'v.VEHI_NUMEROMOVIL ASC';
	$criteria->limit = 10;
	
	$data = Conductoresautomoviles::model()->findAll($criteria);
	$arr = array();
	foreach ($data as $item) {
	$arr[] = array(
	'id' => $item->COAU_ID,
	'value' => $item->VEHI_NUMEROMOVIL,
	'label' =>"[".$item->VEHI_NUMEROMOVIL." ".$item->VEHI_PLACA."]",
	);
	}
	echo CJSON::encode($arr);
    }
	
	public function actionCambiarEstado($id, $estado){
	  $Servicios = Servicios::model()->findByPk($id);	
	  if($estado==1){
		$this->redirect(array('admin/pagos/create','id'=>$Servicios->SERVI_ID));
	  }elseif($estado==2){
		  $Servicios->ESDS_ID = 3;
		  $Servicios->save();
		  $Servicios = new Servicios;
		 $this->redirect(array('admin/servicios/admin',));
		 }elseif($estado==3){
		  $Servicios->ESDS_ID = 4;
		  $Servicios->save();
		  $Servicios = new Servicios;
		  $this->redirect(array('admin/servicios/admin',));
		 }elseif($estado==4){
		  $Servicios->ESDS_ID = 2;
		  $Servicios->save();
		  $Servicios = new Servicios;
		  $this->redirect(array('admin/servicios/admin',));
		 }
	}
	
	public function actionDownload(){
      $Servicios = new Servicios('search');
	  $paramsServicios = Yii::app()->user->getState('ServiciosSearchParams');
	  
	  $Servicios->attributes = $paramsServicios;
	  $dataProvider = $Servicios->search();
      $data = $dataProvider->getData();	  
	  $this->render('download',array(
	                               'Servicios'=>$Servicios,
								   'Registros'=>$data,
								   )
				   );
    }
}
