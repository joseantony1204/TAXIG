<?php

class VehiculosController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].'','download'),
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
		$Personas = new Personas;
		$Vehiculos = new Vehiculos;


		if(isset($_POST['Vehiculos']))
		{
			$Personas->attributes=$_POST['Personas'];
			$Vehiculos->attributes=$_POST['Vehiculos'];
			
			$criteria = new CDbCriteria;
		    $criteria->condition = 'PERS_IDENTIFICACION = '.$Personas->PERS_IDENTIFICACION;
		    $criteria->order = 'PERS_FECHAINGRESO DESC';
			if($Persona = Personas::model()->find($criteria)){
		       $Personas = Personas::model()->findByPk($Persona->PERS_ID);
			}else{
				  $Personas->attributes=$_POST['Personas'];
				 }
			if($Personas->save()){
				$Vehiculos->PERS_ID = $Personas->PERS_ID;
				$Personas->verificarCuenta($Personas->PERS_ID);
				if($Vehiculos->save()){
				 $this->redirect(array('admin'));
				}
			}
		}

		$this->render('create',array(
			'Personas'=>$Personas,
			'Vehiculos'=>$Vehiculos,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	
		$Vehiculos = $this->loadModel($id);
		$Personas = Personas::model()->findByPk($Vehiculos->PERS_ID);

		if(isset($_POST['Vehiculos']))
		{
			$Personas->attributes=$_POST['Personas'];
			$Vehiculos->attributes=$_POST['Vehiculos'];
			
			if($Personas->save()){
				$Vehiculos->PERS_ID = $Personas->PERS_ID;
				if($Vehiculos->save()){
				 $this->redirect(array('admin'));
				}
			}
		}

		$this->render('update',array(
			'Personas'=>$Personas,
			'Vehiculos'=>$Vehiculos,
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
		$dataProvider=new CActiveDataProvider('Vehiculos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vehiculos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vehiculos']))
			$model->attributes=$_GET['Vehiculos'];

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
		$model=Vehiculos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vehiculos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDownload(){
	 $Vehiculos = new Vehiculos;
	 $registros = $Vehiculos->download();
     $this->render('download',array(
	                               'Vehiculos'=>$Vehiculos,
								   'registros'=>$registros,
								   )
				   );
    }
}
