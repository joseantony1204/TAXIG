<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Informes extends CFormModel
{
	public $CONT_FECHAINICIO;
	public $CONT_FECHAFINAL;
	
	public $ESDS_ID, $VEHI_NUMEROMOVIL;


	public function rules()
	{
		return array(
			// username and password are required
			array('CONT_FECHAINICIO, CONT_FECHAFINAL', 'required'),
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
			'pERS' => array(self::BELONGS_TO, 'Personas', 'PERS_ID'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'CONT_FECHAINICIO'=>'DESDE FECHA INGRESO  : ',
			'CONT_FECHAFINAL'=>'HASTA FECHA INGRESO  :',
			
			'ESDS_ID'=>'ESTADO DE SERVICIO',
			'VEHI_NUMEROMOVIL'=>'NUMERO DE MOVIL',
		);
	}
}