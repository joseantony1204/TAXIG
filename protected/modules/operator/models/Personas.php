<?php

/**
 * This is the model class for table "TBL_PERSONAS".
 *
 * The followings are the available columns in table 'TBL_PERSONAS':
 * @property integer $PERS_ID
 * @property string $PERS_NOMBRES
 * @property string $PERS_APELLIDOS
 * @property string $PERS_IDENTIFICACION
 * @property string $PERS_SANGRERH
 * @property string $PERS_LUGAREXPIDENTIDAD
 * @property string $PERS_FECHANACIMIENTO
 * @property string $PERS_CIUDAD
 * @property string $PERS_DIRECCION
 * @property string $PERS_TELEFONO
 * @property integer $SEXO_ID
 * @property integer $TIID_ID
 */
class Personas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personas the static model class
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
		return 'TBL_PERSONAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, PERS_SANGRERH, PERS_LUGAREXPIDENTIDAD, 
			PERS_FECHANACIMIENTO, PERS_FECHAINGRESO, PERS_CIUDAD, PERS_DIRECCION, PERS_TELEFONO, SEXO_ID, TIID_ID', 'required'),
			array('SEXO_ID, TIID_ID', 'numerical', 'integerOnly'=>true),
			array('PERS_NOMBRES, PERS_APELLIDOS, PERS_CIUDAD, PERS_DIRECCION, PERS_TELEFONO', 'length', 'max'=>100),
			array('PERS_IDENTIFICACION, PERS_LUGAREXPIDENTIDAD', 'length', 'max'=>15),
			array('PERS_SANGRERH', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PERS_ID, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, PERS_SANGRERH, 
			PERS_LUGAREXPIDENTIDAD, PERS_FECHANACIMIENTO, PERS_CIUDAD, PERS_DIRECCION, PERS_TELEFONO, SEXO_ID, TIID_ID', 'safe', 'on'=>'search'),
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
		'tIDI' => array(self::BELONGS_TO, 'Tiposidentificacion', 'TIID_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PERS_ID' => 'ID',
			'PERS_NOMBRES' => 'NOMBRES',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_SANGRERH' => 'SANGRE RH',
			'PERS_LUGAREXPIDENTIDAD' => 'LUGAR EXPEDICION ',
			'PERS_FECHANACIMIENTO' => 'F. NACIMIENTO',
			'PERS_CIUDAD' => 'CIUDAD',
			'PERS_DIRECCION' => 'DIRECCION',
			'PERS_TELEFONO' => 'TELEFONO',
			'SEXO_ID' => 'SEXO',
			'TIID_ID' => 'TIPO DE IDENTIDAD',
			'PERS_FECHAINGRESO'=>'FECHA INGRESO',
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

		$criteria->compare('PERS_ID',$this->PERS_ID);
		$criteria->compare('PERS_NOMBRES',$this->PERS_NOMBRES,true);
		$criteria->compare('PERS_APELLIDOS',$this->PERS_APELLIDOS,true);
		$criteria->compare('PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION,true);
		$criteria->compare('PERS_SANGRERH',$this->PERS_SANGRERH,true);
		$criteria->compare('PERS_LUGAREXPIDENTIDAD',$this->PERS_LUGAREXPIDENTIDAD,true);
		$criteria->compare('PERS_FECHANACIMIENTO',$this->PERS_FECHANACIMIENTO,true);
		$criteria->compare('PERS_CIUDAD',$this->PERS_CIUDAD,true);
		$criteria->compare('PERS_DIRECCION',$this->PERS_DIRECCION,true);
		$criteria->compare('PERS_TELEFONO',$this->PERS_TELEFONO,true);
		$criteria->compare('SEXO_ID',$this->SEXO_ID);
		$criteria->compare('TIID_ID',$this->TIID_ID);
		$criteria->compare('PERS_FECHAINGRESO',$this->PERS_FECHAINGRESO); 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getNombreCompleto()
    {
        return $this->PERS_NOMBRES.' '.$this->PERS_APELLIDOS;
    }
	
	public function verificarCuenta($id)
    {
      $criteria = new CDbCriteria;
	  $criteria->condition = 'PERS_ID = '.$id;
	  if($Cuenta = Cuentas::model()->find($criteria)){
	   $Cuentas = Cuentas::model()->findByPk($Cuenta->CUEN_ID);
	  }else{
		   $Cuentas = new Cuentas;
		   $Cuentas->CUEN_FECHAAPERTURA = date("Y-m-d").' '.date("h:i:s");
		   $Cuentas->CUEN_SALDO = 0;
		   $Cuentas->PERS_ID = $id;
		   $Cuentas->ESDC_ID = 1;
		   $Cuentas->save();
		   }
    }
	
	public	function reporteCumpleanios($Informe){
	 $connection = Yii::app()->db;	  	 
	 $sql ="
	 SELECT
	   p.PERS_ID, p.PERS_IDENTIFICACION, p.PERS_NOMBRES, p.PERS_APELLIDOS, p.PERS_FECHANACIMIENTO, DAY(p.PERS_FECHANACIMIENTO) AS D
	 FROM
	   TBL_PERSONAS p
	 WHERE
	   p.PERS_FECHANACIMIENTO LIKE '%-".$Informe->INFO_MES."-%'
     ORDER BY D ASC
	 ";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}