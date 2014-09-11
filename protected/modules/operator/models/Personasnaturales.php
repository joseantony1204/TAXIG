<?php

/**
 * This is the model class for table "TBL_PERSONASNATURALES".
 *
 * The followings are the available columns in table 'TBL_PERSONASNATURALES':
 * @property integer $PENA_ID
 * @property string $PENA_IDENTIFICACION
 * @property string $PENA_NOMBRES
 * @property string $PENA_APELLIDOS
 * @property string $PENA_TELEFONO
 * @property string $PENA_DIRECCION
 * @property string $PENA_FECHANACIMIENTO
 * @property string $PENA_FECHAINGRESO
 * @property string $PENA_SEXO
 */
class Personasnaturales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personasnaturales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_PERSONASNATURALES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PENA_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS, PENA_TELEFONO, PENA_DIRECCION', 'required'),
			array('PENA_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS, PENA_TELEFONO, PENA_DIRECCION, PENA_SEXO', 'length', 'max'=>45),
			array('PENA_FECHANACIMIENTO, PENA_FECHAINGRESO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PENA_ID, PENA_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS, PENA_TELEFONO, PENA_DIRECCION, PENA_FECHANACIMIENTO, PENA_FECHAINGRESO, PENA_SEXO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PENA_ID' => 'Pena',
			'PENA_IDENTIFICACION' => 'IDENTIFICACION',
			'PENA_NOMBRES' => 'NOMBRES',
			'PENA_APELLIDOS' => 'APELLIDOS',
			'PENA_TELEFONO' => 'TELEFONO',
			'PENA_DIRECCION' => 'DIRECCION',
			'PENA_FECHANACIMIENTO' => 'FECHA NACIMIENTO',
			'PENA_FECHAINGRESO' => 'FECHA INGRESO',
			'PENA_SEXO' => 'SEXO',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('PENA_ID',$this->PENA_ID);
		$criteria->compare('PENA_IDENTIFICACION',$this->PENA_IDENTIFICACION,true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);
		$criteria->compare('PENA_TELEFONO',$this->PENA_TELEFONO,true);
		$criteria->compare('PENA_DIRECCION',$this->PENA_DIRECCION,true);
		$criteria->compare('PENA_FECHANACIMIENTO',$this->PENA_FECHANACIMIENTO,true);
		$criteria->compare('PENA_FECHAINGRESO',$this->PENA_FECHAINGRESO,true);
		$criteria->compare('PENA_SEXO',$this->PENA_SEXO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function loadLastData ($id, $fechaingreso){
	 $sql = "SELECT MAX(PENA_ID) FROM TBL_PERSONASNATURALES 
	 WHERE PENA_IDENTIFICACION = '$id' AND PENA_FECHAINGRESO = '$fechaingreso'";
	 $connection = Yii::app()->db;
	 $query = $connection->createCommand($sql)->queryColumn();
	 $lastId = $query[0];
	 $User = Personasnaturales::model()->findByPk($lastId);
	 return $User;
	}
}