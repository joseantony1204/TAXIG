<?php

/**
 * This is the model class for table "TBL_CONDUCTORESAUTOMOVOLES".
 *
 * The followings are the available columns in table 'TBL_CONDUCTORESAUTOMOVOLES':
 * @property integer $COAU_ID
 * @property string $COAU_FECHAASIGNACION
 * @property integer $COND_ID
 * @property integer $VEHI_ID
 * @property integer $ESCA_ID
 *
 * The followings are the available model relations:
 * @property TblEstadoconductoresautomovil $eSCA
 * @property TblConductores $cOND
 * @property TblVehiculos $vEHI
 */
class Conductoresautomoviles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Conductoresautomoviles the static model class
	 */
	public $PERS_NOMBRES, $PERS_APELLIDOS, $PERS_IDENTIFICACION, $VEHI_NUMEROMOVIL, $VEHI_PLACA;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_CONDUCTORESAUTOMOVOLES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COAU_FECHAASIGNACION, COND_ID, VEHI_ID, ESCA_ID', 'required'),
			array('COND_ID, VEHI_ID, ESCA_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COAU_ID, COAU_FECHAASIGNACION, COND_ID, VEHI_ID, ESCA_ID,
			PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, VEHI_NUMEROMOVIL, VEHI_PLACA', 'safe', 'on'=>'search'),
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
			'eSCA' => array(self::BELONGS_TO, 'Estadoconductoresautomovil', 'ESCA_ID'),
			'cOND' => array(self::BELONGS_TO, 'Conductores', 'COND_ID'),
			'vEHI' => array(self::BELONGS_TO, 'Vehiculos', 'VEHI_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COAU_ID' => 'ID',
			'COAU_FECHAASIGNACION' => 'F. ASIGNACION',
			'COND_ID' => 'CONDUCTOR',
			'VEHI_ID' => 'NUMERO DE MOVIL',
			'ESCA_ID' => 'ESTADO',
			
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES',
			
			'VEHI_NUMEROMOVIL' => 'NUM. MOVIL',
			'VEHI_PLACA' => 'PLACA',
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
				'asc'=>'v.VEHI_NUMEROMOVIL',
				'desc'=>'v.VEHI_NUMEROMOVIL desc',
			),
			
			'VEHI_PLACA'=>array(
				'asc'=>'v.VEHI_PLACA',
				'desc'=>'v.VEHI_PLACA desc',
			),
			
			'COAU_FECHAASIGNACION'=>array(
				'asc'=>'COAU_FECHAASIGNACION',
				'desc'=>'COAU_FECHAASIGNACION desc',
			),
			
			'ESCA_ID'=>array(
				'asc'=>'ESCA_ID',
				'desc'=>'ESCA_ID desc',
			),
		);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, v.*, c.*, p.*';
		$criteria->join ='
		INNER JOIN TBL_VEHICULOS v ON t.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON t.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';

		$criteria->compare('COAU_ID',$this->COAU_ID);
		$criteria->compare('COAU_FECHAASIGNACION',$this->COAU_FECHAASIGNACION,true);
		$criteria->compare('COND_ID',$this->COND_ID);
		$criteria->compare('VEHI_ID',$this->VEHI_ID);
		$criteria->compare('ESCA_ID',$this->ESCA_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public function getEstados()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.ESCA_ID, t.ESCA_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_CONDUCTORESAUTOMOVOLES ca ON t.ESCA_ID = ca.ESCA_ID';	
	 $criteria->order = 't.ESCA_NOMBRE ASC';
	 return  CHtml::listData(Estadoconductoresautomovil::model()->findAll($criteria),'ESCA_ID','ESCA_NOMBRE'); 
	}
}