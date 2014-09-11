<?php

class ConductoresautomovilesController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'','conductor','vehiculos'),
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
		$model=new Conductoresautomoviles;

		if(isset($_POST['Conductoresautomoviles']))
		{
			$model->attributes=$_POST['Conductoresautomoviles'];
			
			$criteria = new CDbCriteria;
		    $criteria->condition = 'ESCA_ID = 1 AND VEHI_ID = '.$model->VEHI_ID;			
			if($Conductorautomovil = Conductoresautomoviles::model()->find($criteria)){
		    $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Conductorautomovil->COAU_ID);
			$Conductoresautomoviles->ESCA_ID = 2;
			$Conductoresautomoviles->save();
			}
			
			$criteria = new CDbCriteria;
		    $criteria->condition = 'ESCA_ID = 1 AND COND_ID = '.$model->COND_ID;			
			if($Conductorautomovil = Conductoresautomoviles::model()->find($criteria)){
		    $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Conductorautomovil->COAU_ID);
			$Conductoresautomoviles->ESCA_ID = 2;
			$Conductoresautomoviles->save();
			}
			if($model->save()){
				$this->redirect(array('admin'));
		    }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Conductoresautomoviles']))
		{
			$model->attributes=$_POST['Conductoresautomoviles'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->COAU_ID));
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
		$dataProvider=new CActiveDataProvider('Conductoresautomoviles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Conductoresautomoviles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conductoresautomoviles']))
			$model->attributes=$_GET['Conductoresautomoviles'];

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
		$model=Conductoresautomoviles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='conductoresautomoviles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionConductor($term)
    {
	$criteria = new CDbCriteria;
	$criteria->select = "t.COND_ID, p.PERS_ID, p.PERS_IDENTIFICACION, p.PERS_NOMBRES, p.PERS_APELLIDOS ";
	$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';
		
	$criteria->condition = "
	     LOWER(p.PERS_IDENTIFICACION) like LOWER(:term) OR 
	     LOWER(p.PERS_NOMBRES) like LOWER(:term) OR 
		 LOWER(p.PERS_APELLIDOS) like LOWER(:term)";
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->limit = 10;
	$data = Conductores::model()->findAll($criteria);
	$arr = array();
	foreach ($data as $item) {
	$arr[] = array(
	'id' => $item->COND_ID,
	'value' => $item->pERS->nombreCompleto,
	'label' =>"[".$item->PERS_IDENTIFICACION." ".$item->PERS_NOMBRES." ".$item->PERS_APELLIDOS."]",
	);
	}
	echo CJSON::encode($arr);
    }
	
	public function actionVehiculos($term)
    {
	$criteria = new CDbCriteria;
	$criteria->select = "t.VEHI_ID, t.VEHI_NUMEROMOVIL, t.VEHI_PLACA";		
	$criteria->condition = "
	    LOWER(t.VEHI_NUMEROMOVIL) like LOWER(:term) OR
		LOWER(t.VEHI_PLACA) like LOWER(:term)";
	
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->limit = 10;
	$data = Vehiculos::model()->findAll($criteria);
	$arr = array();
	foreach ($data as $item) {
	$arr[] = array(
	'id' => $item->VEHI_ID,
	'value' => $item->VEHI_NUMEROMOVIL,
	'label' =>"[".$item->VEHI_NUMEROMOVIL." ".$item->VEHI_PLACA."]",
	);
	}
	echo CJSON::encode($arr);
    }
}
