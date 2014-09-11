<?php

/**
 * This is the model class for table "TBL_PAGOS".
 *
 * The followings are the available columns in table 'TBL_PAGOS':
 * @property integer $PAGO_ID
 * @property string $PAGO_FECHAREGISTRO
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
		return 'TBL_PAGOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PAGO_FECHAREGISTRO, USUA_ID', 'required'),
			array('USUA_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PAGO_ID, PAGO_FECHAREGISTRO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, VEHI_PLACA, 
			VEHI_NUMEROMOVIL, PACO_VALOR, USUA_ID', 'safe', 'on'=>'search'),
			array('PAGO_ID, PAGO_FECHAREGISTRO, PERS_NOMBRES, PERS_APELLIDOS, PERS_IDENTIFICACION, VEHI_PLACA, 
			VEHI_NUMEROMOVIL, PACO_VALOR', 'safe', 'on'=>'searchPagos'),
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
			'PAGO_ID' => '#',
			'PAGO_FECHAREGISTRO' => 'F. PAGO',
			//'SERV_ID' => 'FACTURA DEL SERVICIO No.',
			
			'PERS_IDENTIFICACION' => 'NUM. IDENTIDAD',
			'PERS_APELLIDOS' => 'APELLIDOS',
			'PERS_NOMBRES' => 'NOMBRES',
			
			'VEHI_NUMEROMOVIL' => 'MOVIL',
			'VEHI_PLACA' => 'PLACA',
			
			'PACO_VALOR'=>'MONTO',
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
				'asc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID)',
				'desc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID) desc',
			), 
		);
		
		
		$criteria=new CDbCriteria;
		
		$criteria->select='ps.*, t.*, s.*, v.*, c.*, p.*,tr.*,
		(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID) AS PACO_VALOR';
		$criteria->join ='
		INNER JOIN TBL_PAGOSSERVICIOS ps ON ps.PAGO_ID = t.PAGO_ID
		INNER JOIN TBL_SERVICIOS s ON s.SERVI_ID = ps.SERV_ID
		INNER JOIN TBL_TARIFAS tr ON s.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON s.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';

		$criteria->compare('PAGO_ID',$this->PAGO_ID);
		$criteria->compare('PAGO_FECHAREGISTRO',$this->PAGO_FECHAREGISTRO,true);
	
		
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
	   es.ESDS_NOMBRE, pg.PAGO_FECHAREGISTRO, pg.USUA_ID, s.SERVI_FECHAINGRESO
	 FROM 
	   TBL_PERSONAS p, TBL_CONDUCTORES c, TBL_CONDUCTORESAUTOMOVOLES ca, TBL_VEHICULOS v, TBL_SERVICIOS s, TBL_ESTADOSDESERVICIOS es,
	   TBL_PAGOS pg, TBL_PAGOSSERVICIOS ps, TBL_PAGOSCONCEPTOS pcn, TBL_CONCEPTOS cn
	 WHERE 
	   p.PERS_ID = c.PERS_ID AND c.COND_ID = ca.COND_ID AND v.VEHI_ID = ca.VEHI_ID AND ca.COAU_ID = s.COAU_ID
	   AND s.ESDS_ID = es.ESDS_ID AND s.SERVI_ID = ps.SERV_ID AND pg.PAGO_ID = ps.PAGO_ID
       AND ps.PASE_ID = pcn.PASE_ID AND pcn.CONC_ID = cn.CONC_ID
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
				'asc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID)',
				'desc'=>'(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID) desc',
			), 
		);
		
		//$today = date("Y-m-d");
		$criteria=new CDbCriteria;
		
		$criteria->select='ps.*, t.*, s.*, v.*, c.*, p.*,tr.*,
		(SELECT SUM(pc.PACO_VALOR) FROM TBL_PAGOSCONCEPTOS pc WHERE pc.PASE_ID = ps.PASE_ID AND ps.PAGO_ID = t.PAGO_ID) AS PACO_VALOR';
		$criteria->join ='
		INNER JOIN TBL_PAGOSSERVICIOS ps ON ps.PAGO_ID = t.PAGO_ID
		INNER JOIN TBL_SERVICIOS s ON s.SERVI_ID = ps.SERV_ID
		INNER JOIN TBL_TARIFAS tr ON s.TARI_ID = tr.TARI_ID
		INNER JOIN TBL_CONDUCTORESAUTOMOVOLES cv ON s.COAU_ID = cv.COAU_ID
		INNER JOIN TBL_VEHICULOS v ON cv.VEHI_ID = v.VEHI_ID
		INNER JOIN TBL_CONDUCTORES c ON cv.COND_ID = c.COND_ID
		INNER JOIN TBL_PERSONAS p ON p.PERS_ID = c.PERS_ID';
		//$criteria->condition = ' t.PAGO_FECHAREGISTRO LIKE '.''."'%".''.$today.''."%'".''.'';
		$criteria->order ='t.PAGO_ID DESC';
		

		$criteria->compare('t.PAGO_ID',$this->PAGO_ID);
		$criteria->compare('PAGO_FECHAREGISTRO',$this->PAGO_FECHAREGISTRO,true);
		
		
		$criteria->compare('p.PERS_IDENTIFICACION',$this->PERS_IDENTIFICACION, true);
		$criteria->compare('p.PERS_NOMBRES',$this->PERS_NOMBRES, true);
		$criteria->compare('p.PERS_APELLIDOS',$this->PERS_APELLIDOS, true);
		
		$criteria->compare('v.VEHI_NUMEROMOVIL',$this->VEHI_NUMEROMOVIL,true);
		$criteria->compare('v.VEHI_PLACA',$this->VEHI_PLACA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' =>12,),
		));
	}
	
	public	function facturaGeneral($id=NULL){
	 $connection = Yii::app()->db;	 
	 $condicion = '';
	 if($id!=NULL){$condicion = ' AND t.CONC_ID = '.$id;}	 
	 $sql = "
	 SELECT 
	  t.*, ps.*, pc.* 
	 FROM `TBL_CONCEPTOS` `t`
	 INNER JOIN TBL_PAGOSCONCEPTOS pc ON t.CONC_ID = pc.CONC_ID 
	 INNER JOIN TBL_PAGOSSERVICIOS ps ON pc.PASE_ID = ps.PASE_ID 
	 AND ps.PAGO_ID = ".$this->PAGO_ID." $condicion ORDER BY t.CONC_ID ASC";
	 $data = $connection->createCommand($sql)->queryAll(); 
	 return $data;   
	}
	
	public function getImpresion(){ 	   
	   return Yii::app()->baseurl.'/images/imp.png';
	}
}