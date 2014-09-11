<?php

/**
 * This is the model class for table "TBL_TARIFAS".
 *
 * The followings are the available columns in table 'TBL_TARIFAS':
 * @property integer $TARI_ID
 * @property string $TARI_DESCRIPCION
 * @property integer $TARI_VALOR
 * @property integer $TARI_VALORBASEMES
 * @property string $TARI_HORADEPAGO
 */
class Tarifas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tarifas the static model class
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
		return 'TBL_TARIFAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TARI_DESCRIPCION, TARI_VALOR, TARI_VALORBASEMES, TARI_HORADEPAGO', 'required'),
			array('TARI_VALOR, TARI_VALORBASEMES', 'numerical', 'integerOnly'=>true),
			array('TARI_DESCRIPCION', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TARI_ID, TARI_DESCRIPCION, TARI_VALOR, TARI_VALORBASEMES, TARI_HORADEPAGO', 'safe', 'on'=>'search'),
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
			'TARI_ID' => 'ID',
			'TARI_DESCRIPCION' => 'DESCRIPCION TARIFA',
			'TARI_VALOR' => 'VALOR TARIFA',
			'TARI_VALORBASEMES' => 'VALOR BASE MENSUAL',
			'TARI_HORADEPAGO' => 'HORA DE PAGO',
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

		$criteria->compare('TARI_ID',$this->TARI_ID);
		$criteria->compare('TARI_DESCRIPCION',$this->TARI_DESCRIPCION,true);
		$criteria->compare('TARI_VALOR',$this->TARI_VALOR);
		$criteria->compare('TARI_VALORBASEMES',$this->TARI_VALORBASEMES);
		$criteria->compare('TARI_HORADEPAGO',$this->TARI_HORADEPAGO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}