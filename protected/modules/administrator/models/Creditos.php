<?php

/**
 * This is the model class for table "TBL_CREDITOS".
 *
 * The followings are the available columns in table 'TBL_CREDITOS':
 * @property integer $CRED_ID
 * @property string $CRED_VALOR
 * @property string $CRED_FECHAINICIO
 * @property string $CRED_FECHAFINAL
 * @property double $CRED_TASAINTERES
 * @property string $CRED_PLAZO
 * @property integer $ESCR_ID
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 * @property TblEstadoscreditos $eSCR
 */
class Creditos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Creditos the static model class
	 */
	public $PERS_NOMBRES, $PERS_APELLIDOS, $PERS_IDENTIFICACION, $SALDO;
	public $PERS_NOMBRECOMPLETO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CREDITOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CRED_VALOR, CRED_FECHAINICIO, CRED_FECHAFINAL, ESCR_ID, PERS_ID', 'required'),
			array('ESCR_ID, PERS_ID, CRED_VALOR, CRED_PLAZO', 'numerical', 'integerOnly'=>true),
			array('CRED_TASAINTERES', 'numerical'),
			array('CRED_VALOR', 'length', 'max'=>20),
			array('CRED_PLAZO', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CRED_ID, CRED_VALOR, CRED_FECHAINICIO, CRED_FECHAFINAL, CRED_TASAINTERES, CRED_PLAZO, ESCR_ID, PERS_ID,
			PERS_NOMBRES, PERS_APELLIDOS,PERS_IDENTIFICACION, SALDO', 'safe', 'on'=>'search'),
			
			array('CRED_ID, CRED_VALOR, CRED_FECHAINICIO, CRED_FECHAFINAL, CRED_TASAINTERES, CRED_PLAZO, ESCR_ID, PERS_ID,
			PERS_NOMBRES, PERS_APELLIDOS,PERS_IDENTIFICACION, SALDO', 'safe', 'on'=>'buscar'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pERS' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
			'eSCR' => array(self::BELONGS_TO, 'Estadoscreditos', 'ESCR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CRED_ID' => 'ID',
			'CRED_VALOR' => 'VALOR',
			'CRED_FECHAINICIO' => 'F. INICIO',
			'CRED_FECHAFINAL' => 'F. FINAL',
			'CRED_TASAINTERES' => 'TASA',
			'CRED_PLAZO' => 'PLAZO',
			'ESCR_ID' => 'ESTADO',
			'PERS_ID' => 'PERSONA',
			
			'PERS_IDENTIFICACION' => 'IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES',
			'SALDO' => 'ABONO',
			'PERS_NOMBRECOMPLETO' => 'NOMBRE PERSONA',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$sort = new CSort();
		$sort->defaultOrder='p.PERS_NOMBRES ASC';
		$sort->attributes = array(
			
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PERS_NOMBRES'=>array(
				'asc'=>'p.PERS_NOMBRES',
				'desc'=>'p.PERS_NOMBRES desc',
			),
			
			'PERS_APELLIDOS'=>array(
				'asc'=>'p.PERS_APELLIDOS',
				'desc'=>'p.PERS_APELLIDOS desc',
			),
			
			
			'CRED_VALOR'=>array(
				'asc'=>'CRED_VALOR',
				'desc'=>'CRED_VALOR desc',
			),
			
			'CRED_FECHAINICIO'=>array(
				'asc'=>'CRED_FECHAINICIO',
				'desc'=>'CRED_FECHAINICIO desc',
			),
			
			'CRED_FECHAFINAL'=>array(
				'asc'=>'CRED_FECHAFINAL',
				'desc'=>'CRED_FECHAFINAL desc',
			),
			
			'CRED_TASAINTERES'=>array(
				'asc'=>'CRED_TASAINTERES',
				'desc'=>'CRED_TASAINTERES desc',
			),
			
			'ESCR_ID'=>array(
				'asc'=>'ESCR_ID',
				'desc'=>'ESCR_ID desc',
			),
			
			'CRED_PLAZO'=>array(
				'asc'=>'CRED_PLAZO',
				'desc'=>'CRED_PLAZO desc',
			),
			
			'SALDO'=>array(
				'asc'=>'SALDO',
				'desc'=>'SALDO desc',
			),
			
		);

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.*, (SELECT SUM(c.CUOT_VALOR) FROM TBL_CUOTAS c WHERE c.CRED_ID = t.CRED_ID) AS SALDO';
		$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';

		$criteria->compare('CRED_ID',$this->CRED_ID);
		$criteria->compare('CRED_VALOR',$this->CRED_VALOR,true);
		$criteria->compare('CRED_FECHAINICIO',$this->CRED_FECHAINICIO,true);
		$criteria->compare('CRED_FECHAFINAL',$this->CRED_FECHAFINAL,true);
		$criteria->compare('CRED_TASAINTERES',$this->CRED_TASAINTERES);
		$criteria->compare('CRED_PLAZO',$this->CRED_PLAZO,true);
		$criteria->compare('ESCR_ID',$this->ESCR_ID);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			
			'pagination' => array('pageSize' => 1000,),
		));
	}
	
	public function buscar()
	{
		$sort = new CSort();
		$sort->defaultOrder='p.PERS_NOMBRES ASC';
		$sort->attributes = array(
			
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PERS_NOMBRES'=>array(
				'asc'=>'p.PERS_NOMBRES',
				'desc'=>'p.PERS_NOMBRES desc',
			),
			
			'PERS_APELLIDOS'=>array(
				'asc'=>'p.PERS_APELLIDOS',
				'desc'=>'p.PERS_APELLIDOS desc',
			),
			
			
			'CRED_VALOR'=>array(
				'asc'=>'CRED_VALOR',
				'desc'=>'CRED_VALOR desc',
			),
			
			'CRED_FECHAINICIO'=>array(
				'asc'=>'CRED_FECHAINICIO',
				'desc'=>'CRED_FECHAINICIO desc',
			),
			
			'CRED_FECHAFINAL'=>array(
				'asc'=>'CRED_FECHAFINAL',
				'desc'=>'CRED_FECHAFINAL desc',
			),
			
			'CRED_TASAINTERES'=>array(
				'asc'=>'CRED_TASAINTERES',
				'desc'=>'CRED_TASAINTERES desc',
			),
			
			'ESCR_ID'=>array(
				'asc'=>'ESCR_ID',
				'desc'=>'ESCR_ID desc',
			),
			
			'CRED_PLAZO'=>array(
				'asc'=>'CRED_PLAZO',
				'desc'=>'CRED_PLAZO desc',
			),
			
			'SALDO'=>array(
				'asc'=>'SALDO',
				'desc'=>'SALDO desc',
			),
			
		);

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.*, (SELECT SUM(c.CUOT_VALOR) FROM TBL_CUOTAS c WHERE c.CRED_ID = t.CRED_ID) AS SALDO';
		$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';

		$criteria->compare('CRED_ID',$this->CRED_ID);
		$criteria->compare('CRED_VALOR',$this->CRED_VALOR,true);
		$criteria->compare('CRED_FECHAINICIO',$this->CRED_FECHAINICIO,true);
		$criteria->compare('CRED_FECHAFINAL',$this->CRED_FECHAFINAL,true);
		$criteria->compare('CRED_TASAINTERES',$this->CRED_TASAINTERES);
		$criteria->compare('CRED_PLAZO',$this->CRED_PLAZO,true);
		$criteria->compare('ESCR_ID',$this->ESCR_ID);
		$criteria->compare('t.PERS_ID',$this->PERS_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			
			'pagination' => array('pageSize' => 5,),
		));
	}
	
	public function getEstados()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESCR_ID, t.ESCR_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CREDITOS c ON t.ESCR_ID = c.ESCR_ID';	
	 $criteria->order = 't.ESCR_NOMBRE ASC';
	 return  CHtml::listData(Estadoscreditos::model()->findAll($criteria),'ESCR_ID','ESCR_NOMBRE'); 
	}
	
	public function getImagenEstado()
	 {
	   if($this->ESCR_ID=='1'){
		$imageUrl = '1.png'; 
	   }
	   if($this->ESCR_ID=='2'){
		$imageUrl = '2.png'; 
	   }		
	   if($this->ESCR_ID=='3'){
		$imageUrl = '3.png'; 
	   }
	   if($this->ESCR_ID=='4'){
		$imageUrl = '4.png'; 
	   }
	   if($this->ESCR_ID=='5'){
		$imageUrl = '5.png'; 
	   }
	   return Yii::app()->baseurl.'/images/creditos/'.$imageUrl;
	  }
	  
	public function updateEstado($id)
	{
	 $string = "SELECT c.CRED_VALOR, (SELECT SUM(ct.CUOT_VALOR) FROM TBL_CUOTAS ct WHERE ct.CRED_ID = c.CRED_ID ) AS ABONO
	 FROM TBL_CREDITOS c WHERE c.CRED_ID = $id GROUP BY (c.CRED_ID)";
     $criteria = Yii::app()->db->createCommand($string)->queryRow();
     
	 if($criteria["ABONO"]>=$criteria["CRED_VALOR"]){
	  $string = "UPDATE TBL_CREDITOS SET ESCR_ID = 1 WHERE CRED_ID = $id";
	  $criteria = Yii::app()->db->createCommand($string)->execute();	 
	 }else{
		  $string = "UPDATE TBL_CREDITOS SET ESCR_ID = 2 WHERE CRED_ID = $id";
	      $criteria = Yii::app()->db->createCommand($string)->execute();
		  }
   }
   
   public function valorPagado($id)
	{
	 $string = "SELECT SUM(ct.CUOT_VALOR) AS VALOR FROM TBL_CUOTAS ct WHERE ct.CRED_ID = $id GROUP BY ct.CRED_ID";
     $criteria = Yii::app()->db->createCommand($string)->queryColumn();
	 $valor = $criteria[0];
	 return $valor;
    }
	
	public function searchCredito($pagoservicio, $pagoconceptos)
	{ 
	 $Pagosservicios = Pagosservicios::model()->findByPk($pagoservicio->PASE_ID);
	 $Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
	 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
	 $Conductores = Conductores::model()->findByPk($Conductoresautomoviles->COND_ID);
	 $Personas = Personas::model()->findByPk($Conductores->PERS_ID);	  
	 $this->agregarCuotas($Personas, $pagoservicio, $pagoconceptos);    
	}
	
	private function agregarCuotas($Personas, $pagoservicio, $pagoconceptos){
	
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;
	 $criteria->order = 'CRED_ID ASC';		 
	 $prestamos = Creditos::model()->findAll($criteria);
     $filas = count($prestamos);
	 $valor = $pagoconceptos->PACO_VALOR;
	 if($filas>1){	  	 
	  foreach($prestamos as $rows){
	   $Creditos = Creditos::model()->findByPk($rows["CRED_ID"]);
	   $valorPagado = $this->valorPagado($Creditos->CRED_ID);
	   $valorPendiente = $Creditos->CRED_VALOR - $valorPagado;
	   
	    if($valorPendiente>0){ /* si debe en ese credito*/
	 	 if($valor >= $valorPendiente){ /*si el valor que abona es mayor al que que debe*/
		  if($valor !=0){
		   $Cuotas = new Cuotas;
	       $Cuotas->CRED_ID = $Creditos->CRED_ID;
	       $Cuotas->CUOT_VALOR = $valorPendiente;
	       $Cuotas->CUOT_FECHAPAGO = $pagoconceptos->PACO_FECHAINGRESO;
	       $Cuotas->PAGO_ID = $pagoservicio->PAGO_ID;
	       $Cuotas->CONC_ID = $pagoconceptos->CONC_ID;
	       $Cuotas->save();
		   $Creditos->updateEstado($Creditos->CRED_ID);
		   $valor = $valor - $valorPendiente;
		  }
		 }elseif($valor <= $valorPendiente){
			    if($valor !=0){
				 $Cuotas = new Cuotas;
	             $Cuotas->CRED_ID = $Creditos->CRED_ID;
	             $Cuotas->CUOT_VALOR = $valor;
	             $Cuotas->CUOT_FECHAPAGO = $pagoconceptos->PACO_FECHAINGRESO;
				 $Cuotas->PAGO_ID = $pagoservicio->PAGO_ID;
	             $Cuotas->CONC_ID = $pagoconceptos->CONC_ID;
	             $Cuotas->save();
				 $Creditos->updateEstado($Creditos->CRED_ID);
				}
				$valor = 0;
			  }
		}
	  }
	 }elseif($filas==1){
		   $criteria = new CDbCriteria;
           $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;
	       $criteria->order = 'CRED_ID DESC';
	 
	       $credito = Creditos::model()->find($criteria);
           $Creditos = Creditos::model()->findByPk($credito->CRED_ID);
	       $Cuotas = new Cuotas;
	       $Cuotas->CRED_ID = $Creditos->CRED_ID;
	       $Cuotas->CUOT_VALOR = $valor;
	       $Cuotas->CUOT_FECHAPAGO = $pagoconceptos->PACO_FECHAINGRESO;
		   $Cuotas->PAGO_ID = $pagoservicio->PAGO_ID;
	       $Cuotas->CONC_ID = $pagoconceptos->CONC_ID;
	       $Cuotas->save();
		   $Creditos->updateEstado($Creditos->CRED_ID);
		 }elseif($filas==0){		   
		   $Model = new Creditos;
           $Model->CRED_VALOR = 0;
           $Model->CRED_FECHAINICIO = '0000-00-00';
           $Model->CRED_FECHAFINAL = '0000-00-00';
           $Model->CRED_TASAINTERES =0;
           $Model->CRED_PLAZO = 0;
           $Model->ESCR_ID = 2;
           $Model->PERS_ID = $Personas->PERS_ID;		   
           $Model->save();
   			 
		   $Cuotas = new Cuotas;	 
	       $Cuotas->CRED_ID = $Model->CRED_ID;
	       $Cuotas->CUOT_VALOR = $valor;
	       $Cuotas->CUOT_FECHAPAGO = $pagoconceptos->PACO_FECHAINGRESO;
		   $Cuotas->PAGO_ID = $pagoservicio->PAGO_ID;
	       $Cuotas->CONC_ID = $pagoconceptos->CONC_ID;
	       $Cuotas->save();
		   $Model->updateEstado($Model->CRED_ID);
		 }
   }
	
	public	function reporteCreditos($Inf){
	 $connection = Yii::app()->db;	
	 $condicion = "";
	 if(($Inf->PERS_ID!="")){ /*1*/
	  $condicion .= " AND p.PERS_ID = ".$Inf->PERS_ID;
	 
	 }
	  	 
	 $sql = "
	       SELECT  t.*, p.*,
	       SUM(t.CRED_VALOR) AS PRESTAMOS,

          (SELECT (SUM(pr.CRED_VALOR))
           FROM TBL_CREDITOS pr
           WHERE  pr.CRED_FECHAINICIO < '".$Inf->CONT_FECHAINICIO."' 
		   AND pr.PERS_ID = p.PERS_ID) AS PRESTAMOANTERIOR,
		   
		   SUM((SELECT SUM(c.CUOT_VALOR)
			 FROM TBL_CUOTAS c
			 WHERE c.CRED_ID = t.CRED_ID
			 AND c.CUOT_FECHAPAGO < '".$Inf->CONT_FECHAINICIO."'
		   )) AS ABONOPASADO,

          (SELECT SUM(pr.CRED_VALOR)
           FROM TBL_CREDITOS pr
           WHERE pr.CRED_FECHAINICIO >= '".$Inf->CONT_FECHAINICIO."'  AND pr.CRED_FECHAINICIO <= '".$Inf->CONT_FECHAFINAL."'
           AND pr.PERS_ID = p.PERS_ID) AS PRESTAMOMES,
		
		SUM((SELECT SUM(c.CUOT_VALOR)
			 FROM TBL_CUOTAS c
			 WHERE c.CRED_ID = t.CRED_ID
			 AND c.CUOT_FECHAPAGO >= '".$Inf->CONT_FECHAINICIO."' AND c.CUOT_FECHAPAGO <= '".$Inf->CONT_FECHAFINAL."'
		)) AS ABONOMES,
		
		SUM((SELECT SUM(c.CUOT_VALOR)
			 FROM TBL_CUOTAS c
			 WHERE c.CRED_ID = t.CRED_ID
		)) AS ABONOTOTAL
		
		FROM		
		TBL_CREDITOS t, TBL_PERSONAS p
		WHERE
		p.PERS_ID = t.PERS_ID 
		GROUP BY p.PERS_ID
		ORDER BY p.PERS_NOMBRES ASC
	  ";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}