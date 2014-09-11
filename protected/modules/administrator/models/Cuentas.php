<?php

class Cuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuentas the static model class
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
		return 'TBL_CUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CUEN_FECHAAPERTURA, CUEN_SALDO, PERS_ID, ESDC_ID', 'required'),
			array('CUEN_SALDO, PERS_ID, ESDC_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CUEN_ID, CUEN_FECHAAPERTURA, CUEN_SALDO, PERS_ID, ESDC_ID, PERS_NOMBRES, PERS_APELLIDOS, 
			PERS_IDENTIFICACION', 'safe', 'on'=>'search'),
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
			'eSDC' => array(self::BELONGS_TO, 'Estadosdecuentas', 'ESDC_ID'),
			'pERS' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CUEN_ID' => 'ID',
			'CUEN_FECHAAPERTURA' => 'FECHA APERTURA',
			'CUEN_SALDO' => 'SALDO',
			'PERS_ID' => 'Pers',
			'ESDC_ID' => 'ESTADO',
			
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
			
			'CUEN_SALDO'=>array(
				'asc'=>'CUEN_SALDO',
				'desc'=>'CUEN_SALDO desc',
			),
			
			'CUEN_SALDO'=>array(
				'asc'=>'CUEN_SALDO',
				'desc'=>'CUEN_SALDO desc',
			),
			
			'CUEN_FECHAAPERTURA'=>array(
				'asc'=>'CUEN_FECHAAPERTURA',
				'desc'=>'CUEN_FECHAAPERTURA desc',
			),
			
			'ESDC_ID'=>array(
				'asc'=>'ESDC_ID',
				'desc'=>'ESDC_ID desc',
			),
		);

		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.*';
		$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';

		$criteria->compare('CUEN_ID',$this->CUEN_ID);
		$criteria->compare('CUEN_FECHAAPERTURA',$this->CUEN_FECHAAPERTURA,true);
		$criteria->compare('CUEN_SALDO',$this->CUEN_SALDO);
		$criteria->compare('t.PERS_ID',$this->PERS_ID);
		$criteria->compare('ESDC_ID',$this->ESDC_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function searchConductor($id)
	{
	 $Pagosservicios = Pagosservicios::model()->findByPk($id);
	 $Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
	 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
	 $Conductores = Conductores::model()->findByPk($Conductoresautomoviles->COND_ID);
	 $Personas = Personas::model()->findByPk($Conductores->PERS_ID);
	 
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;
	 $Cuenta = Cuentas::model()->find($criteria);
     $Cuentas = Cuentas::model()->findByPk($Cuenta->CUEN_ID);
     return $Cuentas;
	}
	
	public function searchPersona($id)
	{
	 $Pagosservicios = Pagosservicios::model()->findByPk($id);
	 $Servicios = Servicios::model()->findByPk($Pagosservicios->SERV_ID);
	 $Conductoresautomoviles = Conductoresautomoviles::model()->findByPk($Servicios->COAU_ID);
	 $Vehiculos = Vehiculos::model()->findByPk($Conductoresautomoviles->VEHI_ID);
	 $Personas = Personas::model()->findByPk($Vehiculos->PERS_ID);
	 
	 $criteria = new CDbCriteria;
     $criteria->condition = 'PERS_ID = '.$Personas->PERS_ID;
	 $Cuenta = Cuentas::model()->find($criteria);
     $Cuentas = Cuentas::model()->findByPk($Cuenta->CUEN_ID);
     return $Cuentas;
	}
	
	public function getEstados()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESDC_ID, t.ESDC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CUENTAS c ON t.ESDC_ID = c.ESDC_ID';	
	 $criteria->order = 't.ESDC_NOMBRE ASC';
	 return  CHtml::listData(Estadosdecuentas::model()->findAll($criteria),'ESDC_ID','ESDC_NOMBRE'); 
	}
}