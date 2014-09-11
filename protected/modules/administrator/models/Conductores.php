<?php

/**
 * This is the model class for table "TBL_CONDUCTORES".
 *
 * The followings are the available columns in table 'TBL_CONDUCTORES':
 * @property integer $COND_ID
 * @property string $COND_NUMLICENCIA
 * @property string $COND_FECHAEXPEDICION
 * @property string $COND_FECHAVENCIMIENTO
 * @property string $COND_CATEGORIA
 * @property integer $PERS_ID
 *
 * The followings are the available model relations:
 * @property TblPersonas $pERS
 */
class Conductores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Conductores the static model class
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
		return 'TBL_CONDUCTORES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COND_NUMLICENCIA, COND_FECHAEXPEDICION, COND_FECHAVENCIMIENTO, COND_CATEGORIA, PERS_ID', 'required'),
			array('PERS_ID', 'numerical', 'integerOnly'=>true),
			array('COND_NUMLICENCIA', 'length', 'max'=>100),
			array('COND_CATEGORIA', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COND_ID, COND_NUMLICENCIA, COND_FECHAEXPEDICION, COND_FECHAVENCIMIENTO, COND_CATEGORIA, PERS_ID, 
			PERS_NOMBRES, PERS_APELLIDOS,PERS_IDENTIFICACION', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COND_ID' => 'ID',
			'COND_NUMLICENCIA' => 'NUM. LICENCIA',
			'COND_FECHAEXPEDICION' => 'F. EXPEDICION',
			'COND_FECHAVENCIMIENTO' => 'F. VENCIMIENTO',
			'COND_CATEGORIA' => 'CATEGORIA',
			'PERS_ID' => 'Pers',
			
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
			
			
			'COND_NUMLICENCIA'=>array(
				'asc'=>'COND_NUMLICENCIA',
				'desc'=>'COND_NUMLICENCIA desc',
			),
			
			'COND_FECHAEXPEDICION'=>array(
				'asc'=>'COND_FECHAEXPEDICION',
				'desc'=>'COND_FECHAEXPEDICION desc',
			),
			
			'COND_FECHAVENCIMIENTO'=>array(
				'asc'=>'COND_FECHAVENCIMIENTO',
				'desc'=>'COND_FECHAVENCIMIENTO desc',
			),
			
			'COND_CATEGORIA'=>array(
				'asc'=>'COND_CATEGORIA',
				'desc'=>'COND_CATEGORIA desc',
			),
			
		);
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, p.*';
		$criteria->join ='
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = t.PERS_ID';

		$criteria->compare('COND_ID',$this->COND_ID);
		$criteria->compare('COND_NUMLICENCIA',$this->COND_NUMLICENCIA,true);
		$criteria->compare('COND_FECHAEXPEDICION',$this->COND_FECHAEXPEDICION,true);
		$criteria->compare('COND_FECHAVENCIMIENTO',$this->COND_FECHAVENCIMIENTO,true);
		$criteria->compare('COND_CATEGORIA',$this->COND_CATEGORIA,true);
		$criteria->compare('PERS_ID',$this->PERS_ID);

		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public	function download(){
	 $connection = Yii::app()->db;	  	 
	 $sql ="
	 SELECT t.*, v.*, c.*, p.* 
	 FROM TBL_CONDUCTORESAUTOMOVOLES t
	 INNER JOIN TBL_VEHICULOS v ON t.VEHI_ID = v.VEHI_ID
	 INNER JOIN TBL_CONDUCTORES c ON t.COND_ID = c.COND_ID
	 INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID
	 ORDER BY p.PERS_NOMBRES ASC
	 ";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}