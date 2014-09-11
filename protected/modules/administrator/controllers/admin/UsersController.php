<?php

class UsersController extends Controller
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
				''.$array[6].'',''.$array[7].'',''.$array[8].'',''.$array[9].''),
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
		$Personasnaturales = new Personasnaturales;
		$Usuarios = new Usuarios;
		$Users = new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if((isset($_POST['Personasnaturales'])) & (isset($_POST['Usuarios'])) & (isset($_POST['Users'])))
		{
			$Personasnaturales->attributes=$_POST['Personasnaturales'];
			$Usuarios->attributes=$_POST['Usuarios'];
			$Users->attributes=$_POST['Users'];
			
			if($Personasnaturales->save()){
				$Persona = $Personasnaturales->loadLastData($Personasnaturales->PENA_IDENTIFICACION,$Personasnaturales->PENA_FECHAINGRESO);
				$Usuarios->PENA_ID = $Persona->PENA_ID;
				$newSession = $Usuarios->generateSalt();
			    $Usuarios->USUA_CLAVE = $Usuarios->hashPassword($Usuarios->USUA_CLAVE, $newSession);
			    $Usuarios->USUA_SESSION = $newSession;
				if($Usuarios->save()){
				 $Users->USUA_ID = $Usuarios->USUA_ID;
				 if($Users->save()){
				  $this->redirect(array('admin'));
				 }
				}				
			}
		}

		$this->render('create',array(
			'Personasnaturales'=>$Personasnaturales,
			'Usuarios'=>$Usuarios,
			'Users'=>$Users,
		));
	}

	public function actionUpdate($id)
	{
		$Users = $this->loadModel($id);
        $Usuarios = Usuarios::model()->findByPk($Users->USUA_ID);
		$Personasnaturales = Personasnaturales::model()->findByPk($Usuarios->PENA_ID);
		//echo '<br><br><br>'.$Personasnaturales->PENA_ID;
		$oldPass = $Usuarios->USUA_CLAVE;
		$oldSession = $Usuarios->USUA_SESSION;		
		$Usuarios->USUA_CLAVE ="";	
		
		if((isset($_POST['Personasnaturales'])) & (isset($_POST['Usuarios'])) & (isset($_POST['Users'])))
		{
			$Personasnaturales->attributes = $_POST['Personasnaturales'];
			$Usuarios->attributes = $_POST['Usuarios'];
			$Users->attributes = $_POST['Users'];
			$pass = $Usuarios->attributes = $_POST["Usuarios"]["USUA_CLAVE"];
			
			if($pass!=""){
			 $newSession = $Usuarios->generateSalt();	
			 $Usuarios->USUA_CLAVE = $Usuarios->hashPassword($pass, $newSession);
			 $Usuarios->USUA_SESSION = $newSession;
			}else{
				 $Usuarios->USUA_CLAVE = $oldPass;
				 $Usuarios->USUA_SESSION = $oldSession;
				 }
			
			if($Personasnaturales->save()){
				if($Usuarios->save()){
				 if($Users->save()){
				  $this->redirect(array('admin'));
				 }
				}				
			}
		}

		$this->render('update',array(
			'Personasnaturales'=>$Personasnaturales,
			'Usuarios'=>$Usuarios,
			'Users'=>$Users,
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

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
		$model=Users::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
