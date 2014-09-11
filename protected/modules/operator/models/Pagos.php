<?php

/**
 * This is the model class for table "TBL_PAGOS".
 *
 * The followings are the available columns in table 'TBL_PAGOS':
 * @property integer $PAGO_ID
 * @property string $PAGO_FECHAREGISTRO
 * @property integer $SERV_ID
 * @property integer $USUA_ID 
 *
 * The followings are the available model relations:
 * @property TblServicios $sERV
 */
class Pagos extends CActiveRecord
{

	public $PERS_NOMBRES, $PERS_APELLIDOS, $PERS_IDENTIFICACION, $VEHI_NUMEROMOVIL, $VEHI_PLACA, $PACO_VALOR;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PAGO_FECHAREGISTRO, SERV_ID, USUA_ID', 'required'),
			array('SERV_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PAGO_ID, PAGO_FECHAREGISTRO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, VEHI_PLACA, 
			VEHI_NUMEROMOVIL, SERV_ID, PACO_VALOR, USUA_ID', 'safe', 'on'=>'search'),
			array('PAGO_ID, PAGO_FECHAREGISTRO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, VEHI_PLACA, 
			VEHI_NUMEROMOVIL, SERV_ID, PACO_VALOR', 'safe', 'on'=>'searchPagos'),
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
			'sERV' => array(self::BELONGS_TO, 'Servicios', 'SERV_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PAGO_ID' => 'FACTURA No.',
			'PAGO_FECHAREGISTRO' => 'FECHA PAGO',
			'SERV_ID' => 'FACTURA DEL SERVICIO No.',
			
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES',
			
			'VEHI_NUMEROMOVIL' => 'NUM. MOVIL',
			'VEHI_PLACA' => 'PLACA',
			
			'PACO_VALOR'=>'MONTO PAGADO',
			'USUA_ID'=>'USUARIO', 
		);
	}

	public function search()
	{

		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'p.PERS_IDENTIFICACION ASC',
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PERS_NOMBRES'=>array(
				'asc'=>'p.PERS_NOMBRES',
				'desc'=>'p.PERS_NOMBRES desc',
			),
			
			'PERS_APELLIDOS'=>array(
				'asc'=>'p.PERS_APELLIDOS',
				'desc'=>'p.PERS_APELLIDOS desc',
			),
			
			'VEHI_NUMEROMOVIL'=>array(
				'asc'=>'v.VEHI_NUMEROMOVIL',
				'desc'=>'v.VEHI_NUMEROMOVIL desc',
			),		
			
			'VEHI_PLACA'=>array(
				'asc'=>'v.VEHI_PLACA',
				'desc'=>'v.VEHI_PLACA desc',
			),
			
			'PAGO_FECHAREGISTRO'=>array(
				'asc'=>'PAGO_FECHAREGISTRO',
				'desc'=>'PAGO_FECHAREGISTRO desc',
			),
			
			'PACO_VALOR'=>array(
				'asc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID)',
				'desc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID) desc',
			), 
		);
		
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, s.*, v.*, c.*, p.*,tr.*,
		(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID) AS PACO_VALOR';
		$criteria->join ='
		INNER JOIN TBL_SERVICIOS s ON s.SERVI_ID = t.SERV_ID
		INNER JOIN TBL_TARIFAS tr ON s.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON s.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';

		$criteria->compare('PAGO_ID',$this->PAGO_ID);
		$criteria->compare('PAGO_FECHAREGISTRO',$this->PAGO_FECHAREGISTRO,true);
		$criteria->compare('SERV_ID',$this->SERV_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL,true);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'keyAttribute'=>'PAGO_ID',// IMPORTANTE, para que el CGridView conozca la seleccion
			'sort'=>$sort,
			'pagination' => array('pageSize' => 30,),
		));
	}
	
	public	function reportePagos($Inf){
	 $connection = Yii::app()->db;	
	 $condicion = "";
	 if(($Inf->CONC_ID!="") && ($Inf->ESDS_ID!="") && ($Inf->VEHI_NUMEROMOVIL!="")){ /*1, 2 y 3*/
	  $condicion .= " AND es.ESDS_ID = ".$Inf->ESDS_ID." AND v.VEHI_NUMEROMOVIL = ".$Inf->VEHI_NUMEROMOVIL." AND cn.CONC_ID = ".$Inf->CONC_ID;
	 
	 }elseif(($Inf->CONC_ID!="") && ($Inf->ESDS_ID!="")){ /*1 y 2*/
	  $condicion .= " AND es.ESDS_ID = ".$Inf->ESDS_ID." AND cn.CONC_ID = ".$Inf->CONC_ID;
	  
	 }elseif(($Inf->CONC_ID!="") && ($Inf->VEHI_NUMEROMOVIL!="")){ /*1 y 3*/
	  $condicion .= " AND cn.CONC_ID = ".$Inf->CONC_ID." AND v.VEHI_NUMEROMOVIL = ".$Inf->VEHI_NUMEROMOVIL;
	  
	 }elseif(($Inf->ESDS_ID!="") && ($Inf->VEHI_NUMEROMOVIL!="")){ /*2 y 3*/
	  $condicion .= " AND es.ESDS_ID = ".$Inf->ESDS_ID." AND v.VEHI_NUMEROMOVIL = ".$Inf->VEHI_NUMEROMOVIL;
	  
	 }elseif($Inf->VEHI_NUMEROMOVIL!=""){ /*3*/
	  $condicion .= " AND v.VEHI_NUMEROMOVIL = ".$Inf->VEHI_NUMEROMOVIL;
	  
	 }elseif($Inf->ESDS_ID!=""){/*2*/
	  $condicion .= " AND es.ESDS_ID = ".$Inf->ESDS_ID;
	  
	 }elseif($Inf->CONC_ID!=""){/*1*/
	  $condicion .= " AND cn.CONC_ID = ".$Inf->CONC_ID;
	 }
	  	 
	 $sql = "
	 SELECT 
	   p.PERS_IDENTIFICACION, p.PERS_NOMBRES, p.PERS_APELLIDOS, v.VEHI_NUMEROMOVIL, cn.CONC_NOMBRE, pcn.PACO_VALOR, 
	   es.ESDS_NOMBRE, pg.PAGO_FECHAREGISTRO, pg.USUA_ID
	 FROM 
	   TBL_PERSONAS p, TBL_CONDUCTORES c, TBL_CONDUCTORESAUTOMOVOLES ca, TBL_VEHICULOS v, TBL_SERVICIOS s, TBL_ESTADOSDESERVICIOS es,
	   TBL_PAGOS pg, TBL_PAGOSCONCEPTOS pcn, TBL_CONCEPTOS cn
	 WHERE 
	   p.PERS_ID = c.PERS_ID AND c.COND_ID = ca.COND_ID AND v.VEHI_ID = ca.VEHI_ID AND ca.COAU_ID = s.COAU_ID
	   AND s.ESDS_ID = es.ESDS_ID AND s.SERVI_ID = pg.SERV_ID AND pg.PAGO_ID = pcn.PAGO_ID AND pcn.CONC_ID = cn.CONC_ID
	   AND pg.PAGO_FECHAREGISTRO >= '".$Inf->CONT_FECHAINICIO.'% 00:00:00'."' 
	   AND pg.PAGO_FECHAREGISTRO <= '".$Inf->CONT_FECHAFINAL.'% 23:59:59'."'
	   $condicion 
	   ORDER BY p.PERS_NOMBRES, es.ESDS_NOMBRE ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public function searchPagos()
	{

		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'p.PERS_IDENTIFICACION ASC',
			
			'PAGO_ID'=>array(
				'asc'=>'t.PAGO_ID',
				'desc'=>'t.PAGO_ID desc',
			),
			
			'PERS_IDENTIFICACION'=>array(
				'asc'=>'p.PERS_IDENTIFICACION',
				'desc'=>'p.PERS_IDENTIFICACION desc',
			),
			
			'PERS_NOMBRES'=>array(
				'asc'=>'p.PERS_NOMBRES',
				'desc'=>'p.PERS_NOMBRES desc',
			),
			
			'PERS_APELLIDOS'=>array(
				'asc'=>'p.PERS_APELLIDOS',
				'desc'=>'p.PERS_APELLIDOS desc',
			),
			
			'VEHI_NUMEROMOVIL'=>array(
				'asc'=>'v.VEHI_NUMEROMOVIL',
				'desc'=>'v.VEHI_NUMEROMOVIL desc',
			),		
			
			'VEHI_PLACA'=>array(
				'asc'=>'v.VEHI_PLACA',
				'desc'=>'v.VEHI_PLACA desc',
			),
			
			'PAGO_FECHAREGISTRO'=>array(
				'asc'=>'PAGO_FECHAREGISTRO',
				'desc'=>'PAGO_FECHAREGISTRO desc',
			),
			
			'PACO_VALOR'=>array(
				'asc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID)',
				'desc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID) desc',
			), 
		);
		
		
		$criteria=new CDbCriteria;
		
		$criteria->select='t.*, s.*, v.*, c.*, p.*,tr.*,
		(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PAGO_ID = t.PAGO_ID) AS PACO_VALOR';
		$criteria->join ='
		INNER JOIN TBL_SERVICIOS s ON s.SERVI_ID = t.SERV_ID
		INNER JOIN TBL_TARIFAS tr ON s.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON s.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';
		
		$criteria->order ='t.PAGO_ID DESC';

		$criteria->compare('PAGO_ID',$this->PAGO_ID);
		$criteria->compare('PAGO_FECHAREGISTRO',$this->PAGO_FECHAREGISTRO,true);
		$criteria->compare('SERV_ID',$this->SERV_ID);
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL,true);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 5,),
		));
	}
	
	public	function facturaGeneral($id=NULL){
	 $connection = Yii::app()->db;	 
	 $condicion = '';
	 if($id!=NULL){$condicion = ' AND t.CONC_ID = '.$id;}	 
	 $sql = "
	 SELECT 
	  t.*, pc.* FROM `TBL_CONCEPTOS` `t`
	 INNER JOIN TBL_PAGOSCONCEPTOS pc 
	  ON t.CONC_ID = pc.CONC_ID AND pc.PAGO_ID = ".$this->PAGO_ID." $condicion ORDER BY t.CONC_ID ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
}