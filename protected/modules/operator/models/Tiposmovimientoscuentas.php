<?php

/**
 * This is the model class for table "TBL_TIPOSMOVIMIENTOSCUENTAS".
 *
 * The followings are the available columns in table 'TBL_TIPOSMOVIMIENTOSCUENTAS':
 * @property integer $TIMC_ID
 * @property string $TIMC_NOMBRE
 */
class Tiposmovimientoscuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposmovimientoscuentas the static model class
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
		return 'TBL_TIPOSMOVIMIENTOSCUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIMC_NOMBRE', 'required'),
			array('TIMC_NOMBRE', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIMC_ID, TIMC_NOMBRE', 'safe', 'on'=>'search'),
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
			'TIMC_ID' => 'Timc',
			'TIMC_NOMBRE' => 'Timc Nombre',
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

		$criteria->compare('TIMC_ID',$this->TIMC_ID);
		$criteria->compare('TIMC_NOMBRE',$this->TIMC_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}