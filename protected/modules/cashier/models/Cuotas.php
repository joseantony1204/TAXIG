<?php

/**
 * This is the model class for table "TBL_CUOTAS".
 *
 * The followings are the available columns in table 'TBL_CUOTAS':
 * @property integer $CUOT_ID
 * @property string $CUOT_VALOR
 * @property string $CUOT_FECHAPAGO
 * @property integer $CRED_ID
 *
 * The followings are the available model relations:
 * @property TblCreditos $cRED
 */
class Cuotas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuotas the static model class
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
		return 'TBL_CUOTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CUOT_VALOR, CUOT_FECHAPAGO, CRED_ID', 'required'),
			array('CRED_ID', 'numerical', 'integerOnly'=>true),
			array('CUOT_VALOR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CUOT_ID, CUOT_VALOR, CUOT_FECHAPAGO, CRED_ID', 'safe', 'on'=>'search'),
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
			'cRED' => array(self::BELONGS_TO, 'Creditos', 'CRED_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CUOT_ID' => 'ID',
			'CUOT_VALOR' => 'VALOR CUOTA',
			'CUOT_FECHAPAGO' => 'FECHA DE PAGO',
			'CRED_ID' => 'CREDITO',
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

		$criteria->compare('CUOT_ID',$this->CUOT_ID);
		$criteria->compare('CUOT_VALOR',$this->CUOT_VALOR,true);
		$criteria->compare('CUOT_FECHAPAGO',$this->CUOT_FECHAPAGO,true);
		$criteria->compare('CRED_ID',$this->CRED_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 500,),
		));
	}
}