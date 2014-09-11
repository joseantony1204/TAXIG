<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Informesdocumentos extends CFormModel
{
	public $CONT_FECHAFINAL;	
	public $TIDO_ID;


	public function rules()
	{
		return array(
			// username and password are required
			array('TIDO_ID, CONT_FECHAFINAL', 'required'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'CONT_FECHAFINAL'=>'HASTA FECHA VENCIMIENTO',
			'TIDO_ID'=>'TIPO DE DOCUMENTO',
		);
	}
}