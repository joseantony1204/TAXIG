<?php

/**
 * This is the model class for table "TBL_VEHICULOS".
 *
 * The followings are the available columns in table 'TBL_VEHICULOS':
 * @property integer $VEHI_ID
 * @property integer $VEHI_NUMEROMOVIL
 * @property integer $VEHI_NUMLICENCIA
 * @property string $VEHI_FECHAEXPEDICION
 * @property string $VEHI_PLACA
 * @property string $VEHI_MARCA
 * @property string $VEHI_LINEACILINDRAJE
 * @property string $VEHI_MODELO
 * @property string $VEHI_CLASE
 * @property string $VEHI_COLOR
 * @property string $VEHI_SERVICIO
 * @property string $VEHI_CARROCERIATIPO
 * @property string $VEHI_PUERTAS
 * @property string $VEHI_NUMMOTOR
 * @property string $VEHI_NUMSERIE
 * @property string $VEHI_NUMCHASIS
 * @property integer $PERS_ID
 */
class Vehiculos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vehiculos the static model class
	 */
	public $PERS_NOMBRES, $PERS_APELLIDOS, $PERS_IDENTIFICACION;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_VEHICULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('VEHI_NUMEROMOVIL, VEHI_NUMLICENCIA, VEHI_FECHAEXPEDICION, VEHI_PLACA, VEHI_MARCA, VEHI_LINEACILINDRAJE, VEHI_MODELO,
			 VEHI_CLASE, VEHI_COLOR, VEHI_SERVICIO, VEHI_CARROCERIATIPO, VEHI_PUERTAS, VEHI_NUMMOTOR, VEHI_NUMSERIE, 
			 VEHI_NUMCHASIS, PERS_ID, EMPR_ID', 'required'),
			array('PERS_ID, EMPR_ID', 'numerical', 'integerOnly'=>true),
			array('VEHI_NUMEROMOVIL', 'unique'),
			array('VEHI_PLACA, VEHI_MARCA, VEHI_LINEACILINDRAJE, VEHI_MODELO, VEHI_CLASE, VEHI_COLOR, 
			VEHI_SERVICIO, VEHI_CARROCERIATIPO, VEHI_PUERTAS, VEHI_NUMMOTOR, VEHI_NUMSERIE, VEHI_NUMCHASIS', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('VEHI_ID, VEHI_NUMEROMOVIL, VEHI_NUMLICENCIA, VEHI_FECHAEXPEDICION, VEHI_PLACA, VEHI_MARCA, 
			VEHI_LINEACILINDRAJE, VEHI_MODELO, VEHI_CLASE, VEHI_COLOR, VEHI_SERVICIO, VEHI_CARROCERIATIPO, 
			VEHI_PUERTAS, VEHI_NUMMOTOR, VEHI_NUMSERIE, VEHI_NUMCHASIS, PERS_ID, PERS_NOMBRES, PERS_APELLIDOS, 
			PERS_IDENTIFICACION, EMPR_ID', 'safe', 'on'=>'search'),
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
		'eMPR' => array(self::BELONGS_TO, 'Empresas', 'EMPR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'VEHI_ID' => 'ID',
			'VEHI_NUMEROMOVIL' => 'NUM. MOVIL',
			'VEHI_NUMLICENCIA' => 'NUM. LICENCIA TRANSITO',
			'VEHI_FECHAEXPEDICION' => 'F. EXPEDICION',
			'VEHI_PLACA' => 'PLACA',
			'VEHI_MARCA' => 'MARCA',
			'VEHI_LINEACILINDRAJE' => 'LINEA Y CILINDRAJE',
			'VEHI_MODELO' => 'MODELO',
			'VEHI_CLASE' => 'CLASE VEHICULO',
			'VEHI_COLOR' => 'COLOR(es)',
			'VEHI_SERVICIO' => 'SERVICIO',
			'VEHI_CARROCERIATIPO' => 'TIPO CARROCERIA',
			'VEHI_PUERTAS' => 'NUM. PUERTAS',
			'VEHI_NUMMOTOR' => 'NUM. MOTOR',
			'VEHI_NUMSERIE' => 'NUM. SERIE',
			'VEHI_NUMCHASIS' => 'NUM. CHASIS',
			'PERS_ID' => 'PERSONA',
			'EMPR_ID' => 'EMPRESA',
			
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES', 
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		

		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'p.PERS_IDENTIFICACION ASC',
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
			
			'VEHI_MARCA'=>array(
				'asc'=>'VEHI_MARCA',
				'desc'=>'VEHI_MARCA desc',
			),
			
			'VEHI_MODELO'=>array(
				'asc'=>'VEHI_MODELO',
				'desc'=>'VEHI_MODELO desc',
			),
			
			'VEHI_PLACA'=>array(
				'asc'=>'VEHI_PLACA',
				'desc'=>'VEHI_PLACA desc',
			),
			
			'VEHI_CLASE'=>array(
				'asc'=>'VEHI_CLASE',
				'desc'=>'VEHI_CLASE desc',
			),
			
			'EMPR_ID'=>array(
				'asc'=>'EMPR_ID',
				'desc'=>'EMPR_ID desc',
			), 
		);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.*';
		$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';

		$criteria->compare('VEHI_ID',$this->VEHI_ID);
		$criteria->compare('VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL);
		$criteria->compare('VEHI_NUMLICENCIA',$this->VEHI_NUMLICENCIA);
		$criteria->compare('VEHI_FECHAEXPEDICION',$this->VEHI_FECHAEXPEDICION,true);
		$criteria->compare('VEHI_PLACA',$this->VEHI_PLACA,true);
		$criteria->compare('VEHI_MARCA',$this->VEHI_MARCA,true);
		$criteria->compare('VEHI_LINEACILINDRAJE',$this->VEHI_LINEACILINDRAJE,true);
		$criteria->compare('VEHI_MODELO',$this->VEHI_MODELO,true);
		$criteria->compare('VEHI_CLASE',$this->VEHI_CLASE,true);
		$criteria->compare('VEHI_COLOR',$this->VEHI_COLOR,true);
		$criteria->compare('VEHI_SERVICIO',$this->VEHI_SERVICIO,true);
		$criteria->compare('VEHI_CARROCERIATIPO',$this->VEHI_CARROCERIATIPO,true);
		$criteria->compare('VEHI_PUERTAS',$this->VEHI_PUERTAS,true);
		$criteria->compare('VEHI_NUMMOTOR',$this->VEHI_NUMMOTOR,true);
		$criteria->compare('VEHI_NUMSERIE',$this->VEHI_NUMSERIE,true);
		$criteria->compare('VEHI_NUMCHASIS',$this->VEHI_NUMCHASIS,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('EMPR_ID',$this->EMPR_ID); 
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getEmpresas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.EMPR_ID, t.EMPR_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_VEHICULOS v ON t.EMPR_ID = v.EMPR_ID';	
	 $criteria->order = 't.EMPR_ID ASC';
	 return  CHtml::listData(Empresas::model()->findAll($criteria),'EMPR_ID','EMPR_NOMBRE'); 
	}
	
	public	function download(){
	 $connection = Yii::app()->db;	  	 
	 $sql ="
	 SELECT t.*, p.* 
	 FROM TBL_VEHICULOS t
	 INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID
	 ORDER BY p.PERS_NOMBRES ASC
	 ";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}