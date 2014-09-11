<?php

class ConductoresController extends Controller
{
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
		$Conductores = new Conductores;
		$Conductoresautomoviles = new Conductoresautomoviles;


		if(isset($_POST['Conductores']))
		{
			$Personas->attributes=$_POST['Personas'];
			$Conductores->attributes=$_POST['Conductores'];
			$Conductoresautomoviles->attributes=$_POST['Conductoresautomoviles'];
			
			$criteria = new CDbCriteria;
		    $criteria->condition = 'PERS_IDENTIFICACION = '.$Personas->PERS_IDENTIFICACION;
		    $criteria->order = 'PERS_FECHAINGRESO DESC';
			if($Persona = Personas::model()->find($criteria)){
		       $Personas = Personas::model()->findByPk($Persona->PERS_ID);
			}else{
				  $Personas->attributes=$_POST['Personas'];
				 }
			if($Personas->save()){
				$Conductores->PERS_ID = $Personas->PERS_ID;
				$Personas->verificarCuenta($Personas->PERS_ID);
				if($Conductores->save()){
				 
				 $Conductoresautomoviles->COND_ID = $Conductores->COND_ID;
				 $criteria = new CDbCriteria;
				 $criteria->condition = 'ESCA_ID = 1 AND VEHI_ID = '.$Conductoresautomoviles->VEHI_ID;			
				 if($Conductorautomovil = Conductoresautomoviles::model()->find($criteria)){
				  $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Conductorautomovil->COAU_ID);
				  $Conductoresautomoviles->ESCA_ID = 2;
				  $Conductoresautomoviles->save();
			     }
				 
				 $criteria = new CDbCriteria;
				 $criteria->condition = 'ESCA_ID = 1 AND COND_ID = '.$Conductoresautomoviles->COND_ID;			
				 if($Conductorautomovil = Conductoresautomoviles::model()->find($criteria)){
				  $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Conductorautomovil->COAU_ID);
				  $Conductoresautomoviles->ESCA_ID = 2;
				  $Conductoresautomoviles->save();
				 }	
				 if($Conductoresautomoviles->save()){
				  $this->redirect(array('admin'));
		         }
				}
			}
		}

		$this->render('create',array(
			'Personas'=>$Personas,
			'Conductores'=>$Conductores,
			'Conductoresautomoviles'=>$Conductoresautomoviles,
		));
	}


	public function actionUpdate($id)
	{
	
		$Conductores = $this->loadModel($id);
		$Personas = Personas::model()->findByPk($Conductores->PERS_ID);

		if(isset($_POST['Conductores']))
		{
			$Personas->attributes=$_POST['Personas'];
			$Conductores->attributes=$_POST['Conductores'];
			
			if($Personas->save()){
				$Conductores->PERS_ID = $Personas->PERS_ID;
				if($Conductores->save()){
				 $this->redirect(array('admin'));
				}
			}
		}

		$this->render('update',array(
			'Personas'=>$Personas,
			'Conductores'=>$Conductores,
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
		$dataProvider=new CActiveDataProvider('Conductores');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Conductores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conductores']))
			$model->attributes=$_GET['Conductores'];

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
		$model=Conductores::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='conductores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDownload(){
	 $Conductores = new Conductores;
	 $registros = $Conductores->download();
     $this->render('download',array(
	                               'Conductores'=>$Conductores,
								   'registros'=>$registros,
								   )
				   );
    }
}
