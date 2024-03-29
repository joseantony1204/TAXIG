<?php

class CreditosController extends Controller
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
				''.$array[6].'',''.$array[7].'','download','search'),
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
		$model=new Creditos;
		$Personas = new Personas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creditos']))
		{
			$model->attributes=$_POST['Creditos'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->CRED_ID));
		}
		
		if(isset($_POST['Personas']))
		{
			$Personas->attributes=$_POST['Personas'];
			if($Personas->save()){
				$this->redirect(array('create'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'Personas'=>$Personas,
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
		$Personas = Personas::model()->findByPk($model->PERS_ID);
		$model->PERS_NOMBRECOMPLETO = $Personas->nombreCompleto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creditos']))
		{
			$model->attributes=$_POST['Creditos'];
			if($model->save())
				$this->redirect(array('admin',));
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
		$dataProvider=new CActiveDataProvider('Creditos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Creditos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Creditos']))
			$model->attributes=$_GET['Creditos'];

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
		$model=Creditos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='creditos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSearch($term)
    {
	$criteria = new CDbCriteria;
	$criteria->select = "t.PERS_ID, t.PERS_IDENTIFICACION, t.PERS_NOMBRES, t.PERS_APELLIDOS";			
	$criteria->condition = "
	    LOWER(t.PERS_IDENTIFICACION) like LOWER(:term) OR
		LOWER(t.PERS_NOMBRES) like LOWER(:term) OR
		LOWER(t.PERS_APELLIDOS) like LOWER(:term)";
	
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
	
	public function actionDownload(){
	  $Creditos = new Creditos('search');
	  $dataProvider = $Creditos->search();
      $data = $dataProvider->getData();	  
	  $this->render('download',array(
	                               'Creditos'=>$Creditos,
								   'Registros'=>$data,
								   )
				   );
    }
}
