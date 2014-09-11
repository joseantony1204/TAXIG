<?php

/**
 * This is the model class for table "TBL_ESTADOCONDUCTORESAUTOMOVIL".
 *
 * The followings are the available columns in table 'TBL_ESTADOCONDUCTORESAUTOMOVIL':
 * @property integer $ESCA_ID
 * @property string $ESCA_NOMBRE
 */
class Estadoconductoresautomovil extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estadoconductoresautomovil the static model class
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
		return 'TBL_ESTADOCONDUCTORESAUTOMOVIL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ESCA_ID, ESCA_NOMBRE', 'required'),
			array('ESCA_ID', 'numerical', 'integerOnly'=>true),
			array('ESCA_NOMBRE', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ESCA_ID, ESCA_NOMBRE', 'safe', 'on'=>'search'),
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
			'ESCA_ID' => 'Esca',
			'ESCA_NOMBRE' => 'Esca Nombre',
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

		$criteria->compare('ESCA_ID',$this->ESCA_ID);
		$criteria->compare('ESCA_NOMBRE',$this->ESCA_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}