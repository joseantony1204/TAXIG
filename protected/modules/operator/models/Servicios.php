<?php

/**
 * This is the model class for table "TBL_SERVICIOS".
 *
 * The followings are the available columns in table 'TBL_SERVICIOS':
 * @property integer $SERVI_ID
 * @property string $SERVI_FECHAINGRESO
 * @property integer $TARI_ID
 * @property integer $COAU_ID
 * @property integer $ESDS_ID
 *
 * The followings are the available model relations:
 * @property TblEstadosdeservicios $eSDS
 * @property TblTarifas $tARI
 * @property TblConductoresautomovoles $cOAU
 */
class Servicios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servicios the static model class
	 */
	public $PERS_NOMBRES, $PERS_APELLIDOS, $PERS_IDENTIFICACION, $VEHI_NUMEROMOVIL, $VEHI_PLACA, $TARI_HORADEPAGO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_SERVICIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SERVI_FECHAINGRESO, TARI_ID, COAU_ID, ESDS_ID', 'required'),
			array('TARI_ID, COAU_ID, ESDS_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SERVI_ID, SERVI_FECHAINGRESO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, 
			VEHI_NUMEROMOVIL, VEHI_PLACA, TARI_ID, TARI_HORADEPAGO, COAU_ID, ESDS_ID', 'safe', 'on'=>'search'),
			
			array('SERVI_ID, SERVI_FECHAINGRESO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, 
			VEHI_NUMEROMOVIL, VEHI_PLACA, TARI_ID, TARI_HORADEPAGO, COAU_ID, ESDS_ID', 'safe', 'on'=>'searchServices'),
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
			'eSDS' => array(self::BELONGS_TO, 'Estadosdeservicios', 'ESDS_ID'),
			'tARI' => array(self::BELONGS_TO, 'Tarifas', 'TARI_ID'),
			'cOAU' => array(self::BELONGS_TO, 'Conductoresautomoviles', 'COAU_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SERVI_ID' => 'ID',
			'SERVI_FECHAINGRESO' => 'F. INGRESO',
			'TARI_ID' => 'TARIFA',
			'COAU_ID' => 'NUMERO DE MOVIL',
			'ESDS_ID' => 'ESTADO',
			
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES',
			
			'VEHI_NUMEROMOVIL' => 'MOVIL',
			'VEHI_PLACA' => 'PLACA',
			
			'TARI_HORADEPAGO'=>'HORA PAGO',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$sort = new CSort();
		$sort->defaultOrder = 't.ESDS_ID ASC';
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
			
			'VEHI_NUMEROMOVIL'=>array(
				'asc'=>'VEHI_NUMEROMOVIL',
				'desc'=>'VEHI_NUMEROMOVIL desc',
			),
			
			'TARI_ID'=>array(
				'asc'=>'TARI_ID',
				'desc'=>'TARI_ID desc',
			),
			
			'SERVI_FECHAINGRESO'=>array(
				'asc'=>'SERVI_FECHAINGRESO',
				'desc'=>'SERVI_FECHAINGRESO desc',
			),
			
			'ESDS_ID'=>array(
				'asc'=>'ESDS_ID',
				'desc'=>'ESDS_ID desc',
			),
			
			'TARI_HORADEPAGO'=>array(
				'asc'=>'TARI_HORADEPAGO',
				'desc'=>'TARI_HORADEPAGO desc',
			), 
		);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, v.*, c.*, p.*,tr.*';
		$criteria->join ='
		INNER JOIN TBL_TARIFAS tr ON t.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON t.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';

		$criteria->compare('t.SERVI_ID',$this->SERVI_ID);
		$criteria->compare('t.SERVI_FECHAINGRESO',$this->SERVI_FECHAINGRESO,true);
		$criteria->compare('t.TARI_ID',$this->TARI_ID);
		$criteria->compare('t.COAU_ID',$this->COAU_ID);
		$criteria->compare('t.ESDS_ID',$this->ESDS_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);
		
		$criteria->compare('tr.TARI_HORADEPAGO',$this->TARI_HORADEPAGO,true); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'keyAttribute'=>'SERVI_ID',// IMPORTANTE, para que el CGridView conozca la seleccion
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getTarifas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TARI_ID, t.TARI_VALOR';
	 $criteria->join = 'INNER JOIN TBL_SERVICIOS s ON t.TARI_ID = s.TARI_ID';	
	 $criteria->order = 't.TARI_VALOR ASC';
	 return  CHtml::listData(Tarifas::model()->findAll($criteria),'TARI_ID','TARI_VALOR'); 
	}
	
	public function getEstados()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESDS_ID, t.ESDS_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_SERVICIOS s ON t.ESDS_ID = s.ESDS_ID';	
	 $criteria->order = 't.ESDS_NOMBRE ASC';
	 return  CHtml::listData(Estadosdeservicios::model()->findAll($criteria),'ESDS_ID','ESDS_NOMBRE'); 
	}
	
	public function getImagenEstado()
	 {
	   if($this->ESDS_ID=='1'){
		$imageUrl = '1.png'; 
	   }
	   if($this->ESDS_ID=='2'){
		$imageUrl = '2.png'; 
	   }		
	   if($this->ESDS_ID=='3'){
		$imageUrl = '3.png'; 
	   }
	   if($this->ESDS_ID=='4'){
		$imageUrl = '4.png'; 
	   }
	   if($this->ESDS_ID=='5'){
		$imageUrl = '5.png'; 
	   }
	   if($this->ESDS_ID=='6'){
		$imageUrl = '6.png'; 
	   }
	   return Yii::app()->baseurl.'/images/estados/'.$imageUrl;
	  }
	  
	public	function reporteServicios($Informe){
	 $connection = Yii::app()->db;	
	 $condicion = " ";
	 if(($Informe->ESDS_ID!="") && ($Informe->VEHI_NUMEROMOVIL!="")){
	  $condicion .= " AND es.ESDS_ID = ".$Informe->ESDS_ID." AND v.VEHI_NUMEROMOVIL = ".$Informe->VEHI_NUMEROMOVIL;	 
	 }elseif($Informe->ESDS_ID!=""){
	  $condicion .= " AND es.ESDS_ID = ".$Informe->ESDS_ID;
	 }elseif($Informe->VEHI_NUMEROMOVIL!=""){
	  $condicion .= " AND v.VEHI_NUMEROMOVIL = ".$Informe->VEHI_NUMEROMOVIL;
	 }
	  	 
	 $sql = "
	 SELECT 
	   p.PERS_IDENTIFICACION, p.PERS_NOMBRES, p.PERS_APELLIDOS, v.VEHI_NUMEROMOVIL, es.ESDS_NOMBRE, s.SERVI_FECHAINGRESO, tr.TARI_VALOR
	 FROM 
	   TBL_PERSONAS p, TBL_CONDUCTORES c, TBL_CONDUCTORESAUTOMOVOLES ca, TBL_VEHICULOS v, TBL_SERVICIOS s, TBL_ESTADOSDESERVICIOS es,
	   TBL_TARIFAS tr
	 WHERE 
	   p.PERS_ID = c.PERS_ID AND c.COND_ID = ca.COND_ID AND v.VEHI_ID = ca.VEHI_ID AND ca.COAU_ID = s.COAU_ID
	   AND s.ESDS_ID = es.ESDS_ID AND s.TARI_ID = tr.TARI_ID
	   AND s.SERVI_FECHAINGRESO >= '".$Informe->CONT_FECHAINICIO.'% 00:00:00'."' 
	   AND s.SERVI_FECHAINGRESO <= '".$Informe->CONT_FECHAFINAL.'% 23:59:59'."'
	   $condicion 
	   ORDER BY p.PERS_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public function searchServices()
	{

		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.ESDS_ID DESC',
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
			
			'VEHI_NUMEROMOVIL'=>array(
				'asc'=>'VEHI_NUMEROMOVIL',
				'desc'=>'VEHI_NUMEROMOVIL desc',
			),
			
			'TARI_ID'=>array(
				'asc'=>'TARI_ID',
				'desc'=>'TARI_ID desc',
			),
			
			'SERVI_FECHAINGRESO'=>array(
				'asc'=>'SERVI_FECHAINGRESO',
				'desc'=>'SERVI_FECHAINGRESO desc',
			),
			
			'ESDS_ID'=>array(
				'asc'=>'ESDS_ID',
				'desc'=>'ESDS_ID desc',
			),
			
			'TARI_HORADEPAGO'=>array(
				'asc'=>'TARI_HORADEPAGO',
				'desc'=>'TARI_HORADEPAGO desc',
			), 
		);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, v.*, c.*, p.*,tr.*';
		$criteria->join ='
		INNER JOIN TBL_TARIFAS tr ON t.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON t.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID AND t.ESDS_ID != 2';

		$criteria->compare('t.SERVI_ID',$this->SERVI_ID);
		$criteria->compare('t.SERVI_FECHAINGRESO',$this->SERVI_FECHAINGRESO,true);
		$criteria->compare('t.TARI_ID',$this->TARI_ID);
		$criteria->compare('t.COAU_ID',$this->COAU_ID);
		$criteria->compare('t.ESDS_ID',$this->ESDS_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);
		
		$criteria->compare('tr.TARI_HORADEPAGO',$this->TARI_HORADEPAGO,true); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination'=>array('pageSize'=>2),
		));
	} 
	
	public function verificarEstado($model)
	{
	 $connection = Yii::app()->db;
	 $sql = 'SELECT * FROM tbl_servicios s WHERE s.COAU_ID = '.$model->COAU_ID.' AND s.ESDS_ID = 1 AND s.SERVI_FECHAINGRESO>="2014-06-10" ';
	 $rows = $connection->createCommand($sql)->queryRow();
     if($rows>0){
      return 'true';
	 }else{	 
	       return 'false'; 
	      } 
	}	

	
}