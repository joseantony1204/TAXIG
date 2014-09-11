<?php

/**
 * This is the model class for table "TBL_PAGOSCONCEPTOS".
 *
 * The followings are the available columns in table 'TBL_PAGOSCONCEPTOS':
 * @property integer $PACO_ID
 * @property string $PACO_FECHAINGRESO
 * @property integer $PACO_VALOR
 * @property integer $CONC_ID
 * @property integer $PAGO_ID
 *
 * The followings are the available model relations:
 * @property TblPagos $pAGO
 * @property TblConceptos $cONC
 */
class Pagosconceptos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pagosconceptos the static model class
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
		return 'TBL_PAGOSCONCEPTOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PACO_FECHAINGRESO, PACO_VALOR, CONC_ID, PAGO_ID', 'required'),
			array('PACO_VALOR, CONC_ID, PAGO_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PACO_ID, PACO_FECHAINGRESO, PACO_VALOR, CONC_ID, PAGO_ID', 'safe', 'on'=>'search'),
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
			'pAGO' => array(self::BELONGS_TO, 'TblPagos', 'PAGO_ID'),
			'cONC' => array(self::BELONGS_TO, 'TblConceptos', 'CONC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PACO_ID' => 'ID',
			'PACO_FECHAINGRESO' => 'FECHA INGRESO',
			'PACO_VALOR' => 'VALOR A PAGAR',
			'CONC_ID' => 'CONCEPTOS',
			'PAGO_ID' => 'Pago',
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

		$criteria->compare('PACO_ID',$this->PACO_ID);
		$criteria->compare('PACO_FECHAINGRESO',$this->PACO_FECHAINGRESO,true);
		$criteria->compare('PACO_VALOR',$this->PACO_VALOR);
		$criteria->compare('CONC_ID',$this->CONC_ID);
		$criteria->compare('PAGO_ID',$this->PAGO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchConcepto($id)
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.PACO_ID, t.CONC_ID, t.CONC_NOMBRE, t.PACO_VALOR, t.PACO_FECHAINGRESO
	 FROM
	 (
	 SELECT pc.PACO_ID, pc.CONC_ID, t.CONC_NOMBRE, pc.PACO_VALOR, pc.PACO_FECHAINGRESO
	 FROM  TBL_CONCEPTOS t, TBL_PAGOSCONCEPTOS pc
	 WHERE t.CONC_ID = pc.CONC_ID AND pc.PAGO_ID = $id
     UNION ALL
	 SELECT '',t.CONC_ID, t.CONC_NOMBRE, '', ''
	 FROM TBL_CONCEPTOS t
     ) t
	 GROUP BY t.CONC_ID";
	  $data = $connection->createCommand($sql)->queryAll();	 
	  return $data;
	}
	
	public function searchConceptos()
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.CONC_ID, t.CONC_NOMBRE FROM TBL_CONCEPTOS t  GROUP BY t.CONC_ID"; 
	 $data = $connection->createCommand($sql)->queryAll();	 
	 return $data;
	}
}