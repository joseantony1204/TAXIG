
<?php

/**
 * Esta es la clase de modelo para la tabla "TBL_PAGOSSERVICIOS".
 *
 * Las siguientes son las columnas disponibles en la tabla 'TBL_PAGOSSERVICIOS':
 * @Propiedad integer $PASE_ID
 * @Propiedad integer $PAGO_ID
 * @Propiedad integer $SERV_ID
 *
 * Las siguientes son las relaciones de modelo disponibles:
 * @Propiedad TblPagos $pAGO
 */
class Pagosservicios extends CActiveRecord
{
	/**
	 * @Devuelve el modelo estático de la clase AR especificado. 
	 * @param string $ className activo nombre de la clase de registro. 
	 * @Devuelve Pagosservicios la clase del modelo estàtico.
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @Devuelve cadena el nombre de tabla de base de datos asociado
	 */
	public function tableName()
	{
		return 'TBL_PAGOSSERVICIOS';
	}

	/**
	 * @Devuelve las reglas de validación de matriz para los atributos de modelo.
	 */
	public function rules()
	{
	  //NOTA: sólo se debe definir reglas para los atributos que
      //van a recibir las entradas de los usuarios.
		return array(
			array('PAGO_ID, SERV_ID', 'required'),
			array('PAGO_ID, SERV_ID', 'numerical', 'integerOnly'=>true),
			//La siguiente regla es utilizada por search ().
            //Por favor, elimine los atributos que no se deben buscar.
			array('PASE_ID, PAGO_ID, SERV_ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @Devolver reglas relacionales matriz.
	 */
	public function relations()
	{
		//Nota: es posible que necesite ajustar el nombre de la relación y la relacionada
        //Nombre de clase de las relaciones generadas automáticamente a continuación.
		return array(
			'pAGO' => array(self::BELONGS_TO, 'TblPagos', 'PAGO_ID'),
		);
	}

	/**
	 * @Devuelve matriz personalizados etiquetas de atributos  (nombre => etiqueta)
	 */
	public function attributeLabels()
	{
		return array(
						'PASE_ID' => 'PASE',
						'PAGO_ID' => 'PAGO',
						'SERV_ID' => 'FACTURA DEL SERVICION No.',
		);
	}

	 /**
     *@Recupera una lista de los modelos basados ​​en las actuales condiciones de búsqueda / filtro.
     *@Return CActiveDataProvider el proveedor de datos que puede devolver los modelos basados ​​en las condiciones de búsqueda / filtro.
     */
	public function search()
	{
		//Advertencia: Por favor, modifique el siguiente código para quitar atributos que
        //No debe ser buscado.

		$criteria=new CDbCriteria;

		$criteria->compare('PASE_ID',$this->PASE_ID);
		$criteria->compare('PAGO_ID',$this->PAGO_ID);
		$criteria->compare('SERV_ID',$this->SERV_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}