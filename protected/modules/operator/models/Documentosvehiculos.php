<?php

/**
 * This is the model class for table "TBL_DOCUMENTOSVEHICULOS".
 *
 * The followings are the available columns in table 'TBL_DOCUMENTOSVEHICULOS':
 * @property integer $DOHI_ID
 * @property string $DOHI_FECHAVENCIMIENTO
 * @property integer $TIDO_ID
 * @property integer $VEHI_ID
 */
class Documentosvehiculos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documentosvehiculos the static model class
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
		return 'TBL_DOCUMENTOSVEHICULOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIDO_ID, VEHI_ID', 'required'),
			array('TIDO_ID, VEHI_ID', 'numerical', 'integerOnly'=>true),
			array('DOHI_FECHAVENCIMIENTO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DOHI_ID, DOHI_FECHAVENCIMIENTO, TIDO_ID, VEHI_ID', 'safe', 'on'=>'search'),
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
		'tIDO' => array(self::BELONGS_TO, 'Tiposdocumentos', 'TIDO_ID'),
		'vEHI' => array(self::BELONGS_TO, 'Vehiculos', 'VEHI_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DOHI_ID' => 'ID',
			'DOHI_FECHAVENCIMIENTO' => 'FECHA VENCIMIENTO',
			'TIDO_ID' => 'TIPO DE DOCUMENTO',
			'VEHI_ID' => 'Vehi',
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

		$criteria->compare('DOHI_ID',$this->DOHI_ID);
		$criteria->compare('DOHI_FECHAVENCIMIENTO',$this->DOHI_FECHAVENCIMIENTO,true);
		$criteria->compare('TIDO_ID',$this->TIDO_ID);
		$criteria->compare('VEHI_ID',$this->VEHI_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchItems($id)
	{
	 $connection = Yii::app()->db;
	 $sql = "SELECT t.DOHI_ID, t.TIDO_ID, t.TIDO_NOMBRE, t.DOHI_FECHAVENCIMIENTO
	 FROM
	 (
	 SELECT dv.DOHI_ID, dv.TIDO_ID, t.TIDO_NOMBRE, dv.DOHI_FECHAVENCIMIENTO
	 FROM  TBL_TIPOSDOCUMENTOS t, TBL_DOCUMENTOSVEHICULOS dv
	 WHERE t.TIDO_ID = dv.TIDO_ID AND dv.VEHI_ID = $id
	 UNION ALL
	 SELECT '',t.TIDO_ID, t.TIDO_NOMBRE, ''
	 FROM TBL_TIPOSDOCUMENTOS t
	 ) t
	 GROUP BY t.TIDO_ID";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;
	}
	
	public	function reporteDocumentosvehiculos($Informe){
	 $connection = Yii::app()->db;	
	 $condicion = " ";
	 if($Informe->TIDO_ID!=""){
	  $condicion .= " AND td.TIDO_ID = ".$Informe->TIDO_ID;
	 }
	  	 
	 $sql = "
	 SELECT 
	   p.PERS_IDENTIFICACION, p.PERS_NOMBRES, p.PERS_APELLIDOS, v.VEHI_NUMEROMOVIL, td.TIDO_NOMBRE, dv.DOHI_FECHAVENCIMIENTO
	 FROM 
	   TBL_PERSONAS p, TBL_VEHICULOS v, TBL_DOCUMENTOSVEHICULOS dv, TBL_TIPOSDOCUMENTOS td
	 WHERE 
	   p.PERS_ID = v.PERS_ID AND v.VEHI_ID = dv.VEHI_ID AND dv.TIDO_ID = td.TIDO_ID
	   AND dv.DOHI_FECHAVENCIMIENTO <= '".$Informe->CONT_FECHAFINAL.'%'."' 
	   $condicion 
	   ORDER BY p.PERS_NOMBRES ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	} 
}