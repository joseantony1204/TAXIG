<?php

/**
 * This is the model class for table "TBL_MOVIMIENTOSCUENTAS".
 *
 * The followings are the available columns in table 'TBL_MOVIMIENTOSCUENTAS':
 * @property integer $MOCU_ID
 * @property string $MOCU_FECHAPROCESO
 * @property integer $MOCU_VALOR
 * @property integer $TIMC_ID
 * @property integer $CUEN_ID
 *
 * The followings are the available model relations:
 * @property TblCuentas $cUEN
 * @property TblTiposmovimientoscuentas $tIMC
 */
class Movimientoscuentas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Movimientoscuentas the static model class
	 */
	public $MOVIMIENTO;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_MOVIMIENTOSCUENTAS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MOCU_FECHAPROCESO, MOCU_VALOR, TIMC_ID, CUEN_ID', 'required'),
			array('MOCU_VALOR, TIMC_ID, CUEN_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MOCU_ID, MOCU_FECHAPROCESO, MOCU_VALOR, TIMC_ID, CUEN_ID', 'safe', 'on'=>'search'),
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
			'cUEN' => array(self::BELONGS_TO, 'TblCuentas', 'CUEN_ID'),
			'tIMC' => array(self::BELONGS_TO, 'Tiposmovimientoscuentas', 'TIMC_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MOCU_ID' => 'ID',
			'MOCU_FECHAPROCESO' => 'FECHA PROCESO',
			'MOCU_VALOR' => 'VALOR TRANSACCION',
			'TIMC_ID' => 'TIPO DE MOVIMIENTO',
			'CUEN_ID' => 'Cuen',
			'MOVIMIENTO' =>'',
		);
	}

	public function search()
	{
	
		$criteria=new CDbCriteria;

		$criteria->compare('MOCU_ID',$this->MOCU_ID);
		$criteria->compare('MOCU_FECHAPROCESO',$this->MOCU_FECHAPROCESO,true);
		$criteria->compare('MOCU_VALOR',$this->MOCU_VALOR);
		$criteria->compare('TIMC_ID',$this->TIMC_ID);
		$criteria->compare('CUEN_ID',$this->CUEN_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function registrarMovimiento($id,$valor,$tipo)
	{
	 $Movimientoscuentas = new Movimientoscuentas;
	 $Movimientoscuentas->MOCU_FECHAPROCESO = date("Y-m-d").' '.date("H:m:s");
	 $Movimientoscuentas->MOCU_VALOR = $valor;
	 $Movimientoscuentas->TIMC_ID = $tipo;
	 $Movimientoscuentas->CUEN_ID = $id;
	 $Movimientoscuentas->save();
	 
	 $Cuentas = Cuentas::model()->findByPk($Movimientoscuentas->CUEN_ID);
	 if($tipo==1){	  
	  $Cuentas->CUEN_SALDO = $Cuentas->CUEN_SALDO + $Movimientoscuentas->MOCU_VALOR;	  
	 }elseif($tipo==2){
		    $Cuentas->CUEN_SALDO = $Cuentas->CUEN_SALDO - $Movimientoscuentas->MOCU_VALOR;
		   }
	 
	 $Cuentas->save();
	 
	}
	
	public function getTiposmovimientoscuentas()
	{
	 $criteria=new CDbCriteria;
     $criteria->select='t.TIMC_ID, t.TIMC_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_MOVIMIENTOSCUENTAS mc ON t.TIMC_ID = mc.TIMC_ID';	
	 $criteria->order = 't.TIMC_NOMBRE ASC';
	 return  CHtml::listData(Tiposmovimientoscuentas::model()->findAll($criteria),'TIMC_ID','TIMC_NOMBRE'); 
	}
	
	public function getImagenMovimiento()
	 {
	   if($this->TIMC_ID=='1'){
		$imageUrl = 'ingreso.png'; 
	   }
	   if($this->TIMC_ID=='2'){
		$imageUrl = 'egreso.png'; 
	   }
	   return Yii::app()->baseurl.'/images/estados/'.$imageUrl;
	}
	
}