<?php

/**
 * Esta es la clase de modelo para la tabla "TBL_TIPOSCONCEPTOS".
 *
 * Las siguientes son las columnas disponibles en la tabla 'TBL_TIPOSCONCEPTOS':
 * @Propiedad integer $TICO_ID
 * @Propiedad string $TICO_NOMBRE
 * @Propiedad string $TICO_DESCRIPCION
 */
class Tiposconceptos extends CActiveRecord
{
	/**
	 * @Devuelve el modelo estático de la clase AR especificado. 
	 * @param string $ className activo nombre de la clase de registro. 
	 * @Devuelve Tiposconceptos la clase del modelo estàtico.
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
		return 'TBL_TIPOSCONCEPTOS';
	}

	/**
	 * @Devuelve las reglas de validación de matriz para los atributos de modelo.
	 */
	public function rules()
	{
	  //NOTA: sólo se debe definir reglas para los atributos que
      //van a recibir las entradas de los usuarios.
		return array(
			array('TICO_DESCRIPCION', 'required'),
			array('TICO_NOMBRE', 'length', 'max'=>50),
			array('TICO_DESCRIPCION', 'length', 'max'=>10),
			//La siguiente regla es utilizada por search ().
            //Por favor, elimine los atributos que no se deben buscar.
			array('TICO_ID, TICO_NOMBRE, TICO_DESCRIPCION', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @Devuelve matriz personalizados etiquetas de atributos  (nombre => etiqueta)
	 */
	public function attributeLabels()
	{
		return array(
						'TICO_ID' => 'TICO',
						'TICO_NOMBRE' => 'TICO NOMBRE',
						'TICO_DESCRIPCION' => 'TICO DESCRIPCION',
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

		$criteria->compare('TICO_ID',$this->TICO_ID);
		$criteria->compare('TICO_NOMBRE',$this->TICO_NOMBRE,true);
		$criteria->compare('TICO_DESCRIPCION',$this->TICO_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}