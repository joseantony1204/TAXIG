<?php

class PagosconceptosController extends Controller
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
	public function actionCreate($id)
	{
		$Pagosconceptos = new Pagosconceptos;				

		if(isset($_POST['Pagosconceptos']))
		{
			$Pagosconceptos->attributes=$_POST['Pagosconceptos'];
			
			
			$CONC_ID = $_POST["CONC_ID"];
			$PACO_VALOR = $_POST["PACO_VALOR"];
			$PACO_FECHAINGRESO = $_POST["PACO_FECHAINGRESO"];
		    $total_campos = count($_POST["CONC_ID"]);
			 
			 for ($i=0; $i<$total_campos; $i++) 
			 {		  		  
			  $criteria = new CDbCriteria;
		      $criteria->condition = 'PAGO_ID = '.$Pagosconceptos->PAGO_ID.' AND CONC_ID = '.$CONC_ID[$i];
			  if($Pagosconcepto = Pagosconceptos::model()->find($criteria)){
		       $Pagosconceptos = Pagosconceptos::model()->findByPk($Pagosconcepto->PACO_ID);
			  }else{
					$Pagosconceptos = new Pagosconceptos;
				   }
				   
			  $Pagosconceptos->CONC_ID = $CONC_ID[$i];
			  $Pagosconceptos->PACO_VALOR = $PACO_VALOR[$i];
			  if($PACO_FECHAINGRESO[$i]=="") $PACO_FECHAINGRESO[$i] = date("Y-m-d").' '.date("h:i:s");
			  $Pagosconceptos->PACO_FECHAINGRESO = $PACO_FECHAINGRESO[$i];
			  $Pagosconceptos->PAGO_ID = $id;
			  $Pagosconceptos->save();
			  
			  if($Pagosconceptos->CONC_ID==2){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchConductor($Pagosconceptos->PAGO_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			  }
			  
			  if($Pagosconceptos->CONC_ID==3){
			     if($Pagosconceptos->PACO_VALOR>0){
				  $Cuentas = new Cuentas; $Movimientoscuentas = new Movimientoscuentas;
				  $cuenta = $Cuentas->searchPersona($Pagosconceptos->PAGO_ID);
				  $Movimientoscuentas->registrarMovimiento($cuenta->CUEN_ID,$Pagosconceptos->PACO_VALOR,1);  
			     }
			  }
			  			  		 
			 }
			$this->redirect(array('admin/pagos/admin','id'=>$Pagosconceptos->PAGO_ID));			
		}
        $Pagosconceptos->PAGO_ID = $id;
		$this->render('create',array(
			'Pagosconceptos'=>$Pagosconceptos,
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

		if(isset($_POST['Pagosconceptos']))
		{
			$model->attributes=$_POST['Pagosconceptos'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->PACO_ID));
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
		$dataProvider=new CActiveDataProvider('Pagosconceptos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pagosconceptos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagosconceptos']))
			$model->attributes=$_GET['Pagosconceptos'];

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
		$model=Pagosconceptos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagosconceptos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
