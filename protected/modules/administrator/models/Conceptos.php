<?php

/**
 * Esta es la clase de modelo para la tabla "TBL_CONCEPTOS".
 *
 * Las siguientes son las columnas disponibles en la tabla 'TBL_CONCEPTOS':
 * @Propiedad integer $CONC_ID
 * @Propiedad string $CONC_NOMBRE
 * @Propiedad integer $TICO_ID
 *
 * Las siguientes son las relaciones de modelo disponibles:
 * @Propiedad TblTiposconceptos $tICO
 */
class Conceptos extends CActiveRecord
{
	/**
	 * @Devuelve el modelo estático de la clase AR especificado. 
	 * @param string $ className activo nombre de la clase de registro. 
	 * @Devuelve Conceptos la clase del modelo estàtico.
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
		return 'TBL_CONCEPTOS';
	}

	/**
	 * @Devuelve las reglas de validación de matriz para los atributos de modelo.
	 */
	public function rules()
	{
	  //NOTA: sólo se debe definir reglas para los atributos que
      //van a recibir las entradas de los usuarios.
		return array(
			array('CONC_NOMBRE, TICO_ID', 'required'),
			array('TICO_ID', 'numerical', 'integerOnly'=>true),
			array('CONC_NOMBRE', 'length', 'max'=>100),
			//La siguiente regla es utilizada por search ().
            //Por favor, elimine los atributos que no se deben buscar.
			array('CONC_ID, CONC_NOMBRE, TICO_ID', 'safe', 'on'=>'search'),
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
			'tICO' => array(self::BELONGS_TO, 'Tiposconceptos', 'TICO_ID'),
		);
	}

	/**
	 * @Devuelve matriz personalizados etiquetas de atributos  (nombre => etiqueta)
	 */
	public function attributeLabels()
	{
		return array(
			'CONC_ID' => 'ID',
			'CONC_NOMBRE' => 'DESCRIPCION DEL CONCEPTO',
			'TICO_ID' => 'TIPO DE CONCEPTO',
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

		$criteria->compare('CONC_ID',$this->CONC_ID);
		$criteria->compare('CONC_NOMBRE',$this->CONC_NOMBRE,true);
		$criteria->compare('TICO_ID',$this->TICO_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}