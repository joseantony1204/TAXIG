<?php

/**
 * This is the model class for table "TBL_USUARIOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOS':
 * @property integer $USUA_ID
 * @property string $USUA_USUARIO
 * @property string $USUA_CLAVE
 * @property string $USUA_SESSION
 * @property string $USUA_FECHAALTA
 * @property string $USUA_FECHABAJA
 * @property string $USUA_ULTIMOACCESO
 * @property integer $PENA_ID
 *
 * The followings are the available model relations:
 * @property TblPersonasnaturales $pENA
 */
class Usuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
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
		return 'TBL_USUARIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_USUARIO, USUA_CLAVE, USUA_SESSION, USUA_FECHAALTA, USUA_FECHABAJA, USUA_ULTIMOACCESO, PENA_ID', 'required'),
			array('PENA_ID', 'numerical', 'integerOnly'=>true),
			array('USUA_USUARIO', 'length', 'max'=>100),
			array('USUA_USUARIO', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USUA_ID, USUA_USUARIO, USUA_CLAVE, USUA_SESSION, USUA_FECHAALTA, USUA_FECHABAJA, USUA_ULTIMOACCESO, PENA_ID', 'safe', 'on'=>'search'),
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
			'pENA' => array(self::BELONGS_TO, 'TblPersonasnaturales', 'PENA_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USUA_ID' => 'Usua',
			'USUA_USUARIO' => 'USUARIO',
			'USUA_CLAVE' => 'CLAVE',
			'USUA_SESSION' => 'Usua Session',
			'USUA_FECHAALTA' => 'FECHA INGRESO',
			'USUA_FECHABAJA' => 'FECHA RETIRO',
			'USUA_ULTIMOACCESO' => 'ULTIMO ACCESO',
			'PENA_ID' => 'Pena',
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

		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('USUA_USUARIO',$this->USUA_USUARIO,true);
		$criteria->compare('USUA_CLAVE',$this->USUA_CLAVE,true);
		$criteria->compare('USUA_SESSION',$this->USUA_SESSION,true);
		$criteria->compare('USUA_FECHAALTA',$this->USUA_FECHAALTA,true);
		$criteria->compare('USUA_FECHABAJA',$this->USUA_FECHABAJA,true);
		$criteria->compare('USUA_ULTIMOACCESO',$this->USUA_ULTIMOACCESO,true);
		$criteria->compare('PENA_ID',$this->PENA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->USUA_SESSION)===$this->USUA_CLAVE;
	}
	
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}
	
	public function generateSalt()
	{
		return uniqid('',true);
	}
}