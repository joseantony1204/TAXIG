<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Informescumpleanios extends CFormModel
{
	public $INFO_MES;


	public function rules()
	{
		return array(
			// username and password are required
			array('INFO_MES', 'required'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'INFO_MES'=>'MES DE CUMPLEAÑO ',
	
		);
	}
}