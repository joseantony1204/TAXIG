<?php

/**
 * This is the model class for table "TBL_TIPOSIDENTIFICACION".
 *
 * The followings are the available columns in table 'TBL_TIPOSIDENTIFICACION':
 * @property integer $TIID_ID
 * @property string $TIID_NOMBRE
 * @property string $TIID_DESCRIPCION
 */
class Tiposidentificacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tiposidentificacion the static model class
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
		return 'TBL_TIPOSIDENTIFICACION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIID_NOMBRE, TIID_DESCRIPCION', 'required'),
			array('TIID_NOMBRE', 'length', 'max'=>25),
			array('TIID_DESCRIPCION', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIID_ID, TIID_NOMBRE, TIID_DESCRIPCION', 'safe', 'on'=>'search'),
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
			'TIID_ID' => 'Tiid',
			'TIID_NOMBRE' => 'Tiid Nombre',
			'TIID_DESCRIPCION' => 'Tiid Descripcion',
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

		$criteria->compare('TIID_ID',$this->TIID_ID);
		$criteria->compare('TIID_NOMBRE',$this->TIID_NOMBRE,true);
		$criteria->compare('TIID_DESCRIPCION',$this->TIID_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}