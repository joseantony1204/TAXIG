<?php

/**
 * This is the model class for table "TBL_USUARIOSPERFILESUSUARIOS".
 *
 * The followings are the available columns in table 'TBL_USUARIOSPERFILESUSUARIOS':
 * @property integer $USPU_ID
 * @property integer $USUA_ID
 * @property integer $USPE_ID
 * @property string $USPU_FECHAINGRESO
 *
 * The followings are the available model relations:
 * @property TblUsuarios $uSUA
 * @property TblUsuariosperfiles $uSPE
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public $USUA_USUARIO, $PENA_ID, $USUA_FECHAALTA, $USUA_FECHABAJA, $USUA_ULTIMOACCESO,
	$PENA_IDENTIFICACION, $PENA_NOMBRES, $PENA_APELLIDOS;
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TBL_USUARIOSPERFILESUSUARIOS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUA_ID, USPE_ID, USPU_FECHAINGRESO', 'required'),
			array('USUA_ID, USPE_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USPU_ID, USUA_ID, USPE_ID, USPU_FECHAINGRESO, PENA_IDENTIFICACION, PENA_NOMBRES, PENA_APELLIDOS,
		USUA_USUARIO', 'safe', 'on'=>'search'),
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
			'uSUA' => array(self::BELONGS_TO, 'TblUsuarios', 'USUA_ID'),
			'rel_usuarios_perfiles' => array(self::BELONGS_TO, 'Usuariosperfiles', 'USPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(	
			'USPU_ID' => 'ID',
			'USUA_ID' => 'USUARIO',
			'USPE_ID' => 'PERFIL',
			'USPU_FECHAINGRESO' => 'FECHA CREADO',
			
			'USUA_USUARIO' => 'USUARIO',
			'PENA_ID' => 'PERSONA',
			'USES_ID' => 'ESTADO',
			'USUA_FECHAALTA' => 'FECHA CREACION',
			'USUA_FECHABAJA' => 'FECHA SUSPENSION',
			'USUA_ULTIMOACCESO' => 'ULTIMA VISITA',
			
			'PENA_IDENTIFICACION' => 'IDENTIFICACION',
			'PENA_NOMBRES' => 'NOMBRES',
			'PENA_APELLIDOS' => 'APELLIDOS',
		);
	}


	public function search()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.USUA_ID ASC',
			'PENA_IDENTIFICACION'=>array(
				'asc'=>'pn.PENA_IDENTIFICACION',
				'desc'=>'pn.PENA_IDENTIFICACION desc',
			),
			
			'PENA_NOMBRES'=>array(
				'asc'=>'pn.PENA_NOMBRES',
				'desc'=>'pn.PENA_NOMBRES desc',
			),
			
			'PENA_APELLIDOS'=>array(
				'asc'=>'pn.PENA_APELLIDOS',
				'desc'=>'pn.PENA_APELLIDOS desc',
			),
			
			'USPE_ID'=>array(
				'asc'=>'t.USPE_ID',
				'desc'=>'t.USPE_ID desc',
			),
			
			'USUA_USUARIO'=>array(
				'asc'=>'u.USUA_USUARIO',
				'desc'=>'u.USUA_USUARIO desc',
			),
			
			'USUA_ULTIMOACCESO'=>array(
				'asc'=>'u.USUA_ULTIMOACCESO',
				'desc'=>'u.USUA_ULTIMOACCESO desc',
			),
			
			
		);
		
		$criteria=new CDbCriteria;
		$criteria->select='t.*, u.*, pn.*';
		$criteria->join ='
		INNER JOIN TBL_USUARIOS  u ON u.USUA_ID = t.USUA_ID
		INNER JOIN TBL_PERSONASNATURALES  pn ON pn.PENA_ID = u.PENA_ID';

		$criteria->compare('USPU_ID',$this->USPU_ID);
		$criteria->compare('USUA_ID',$this->USUA_ID);
		$criteria->compare('USPE_ID',$this->USPE_ID);
		$criteria->compare('USUA_USUARIO',$this->USUA_USUARIO,true);
		$criteria->compare('USPU_FECHAINGRESO',$this->USPU_FECHAINGRESO,true);
		
		$criteria->compare('PENA_IDENTIFICACION',$this->PENA_IDENTIFICACION,true);
		$criteria->compare('PENA_NOMBRES',$this->PENA_NOMBRES,true);
		$criteria->compare('PENA_APELLIDOS',$this->PENA_APELLIDOS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
			'pagination' => array('pageSize' => 10,),
		));
	}
}