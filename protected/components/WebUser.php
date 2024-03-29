<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser implements IWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->first_name
 public function getNombres(){
    if(Yii::app()->user->getIsGuest())
    {
      return "";
    }else{
		  if(Yii::app()->session['UsuarioNombre']==''){
	       $model = new Usuarios;
           $nombreUsuario = $model->getDatosUsuario(Yii::app()->user->id);
		   $sessionUsuario = Yii::app()->session['UsuarioNombre'] = $nombreUsuario[0];    
          }else{
			    $sessionUsuario = Yii::app()->session['UsuarioNombre'];
			   }
			   return $sessionUsuario;
	     }
  }
  
   public function getIdtipoadmin(){
    if(Yii::app()->user->getIsGuest())
    {
      return "";
    }else{
          $user = Usuarios::model()->findByPk(Yii::app()->user->id);
         } 
  }
 
 
  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null){
                $this->_model=Usuarios::model()->findByPk(Yii::app()->user->id);				  
			}
        }
        return $this->_model;
    }
	
   public function getModulosUsuarios(){
	 if(Yii::app()->user->getIsGuest())
     {
       return "";
     }else{
	     	 $connection = Yii::app()->db;
			 $id = Yii::app()->user->id;
			 
			 $sql = "SELECT um.USMO_ID, um.USMO_NOMBRE, um.USMO_URL
			 FROM TBL_USUARIOSMODULOS um, TBL_USUARIOSROLES ur, TBL_USUARIOSPERFILES up, TBL_USUARIOSPERFILESUSUARIOS upu, TBL_USUARIOS u
			 WHERE um.USMO_ID = ur.USMO_ID AND ur.USPE_ID = up.USPE_ID AND up.USPE_ID = upu.USPE_ID
			 AND upu.USUA_ID = u.USUA_ID AND u.USUA_ID = $id GROUP BY um.USMO_ID";
			 $data = $connection->createCommand($sql)->queryAll();
			 //echo "<br><br><br>".$sql; 
			 return $data;  
	      }
	}
	
   public function subModulosUsuarios($modulo){
	 if(Yii::app()->user->getIsGuest())
     {
       return "";
     }else{
	     	 $connection = Yii::app()->db;
			 $id = Yii::app()->user->id;
			 
			 $sql = "SELECT usm.USSM_ID, usm.USSM_NOMBRE, usm.USSM_URL
			 FROM TBL_USUARIOSMODULOS um, TBL_USUARIOSSUBMODULOS usm, TBL_USUARIOSROLES ur, TBL_USUARIOSPERFILES up,
			 TBL_USUARIOSPERFILESUSUARIOS upu, TBL_USUARIOS u
			 WHERE um.USMO_ID = ur.USMO_ID AND usm.USSM_ID = ur.USSM_ID AND ur.USPE_ID = up.USPE_ID AND up.USPE_ID = upu.USPE_ID
			 AND upu.USUA_ID = u.USUA_ID AND u.USUA_ID = $id AND um.USMO_URL='$modulo'  GROUP BY usm.USSM_ID";
			 $data = $connection->createCommand($sql)->queryAll();
			 //echo "<br><br><br>".$sql; 
			 return $data;  
	      }
	}	
	
	public function viewsAccesoUsuario($modulo,$submodulo,$controlador){
	  if(Yii::app()->user->getIsGuest())
      {
        return "";
      }else{
	        $connection = Yii::app()->db;
			$id = Yii::app()->user->id;
			$sql = "SELECT uv.USVI_URL FROM TBL_USUARIOSMODULOS um, TBL_USUARIOSSUBMODULOS usm,
			TBL_USUARIOSCONTROLADORES uc, TBL_USUARIOSVISTAS uv, TBL_USUARIOSROLES ur, TBL_USUARIOSPERFILES up,
			TBL_USUARIOSPERFILESUSUARIOS upu, TBL_USUARIOS u
			WHERE um.USMO_ID = usm.USMO_ID AND usm.USSM_ID = uc.USSM_ID AND uc.USCO_ID = uv.USCO_ID
			AND um.USMO_ID = ur.USMO_ID AND usm.USSM_ID = ur.USSM_ID AND uc.USCO_ID = ur.USCO_ID AND uv.USVI_ID = ur.USVI_ID
			AND ur.USPE_ID = up.USPE_ID AND up.USPE_ID = upu.USPE_ID AND upu.USUA_ID = u.USUA_ID AND u.USUA_ID = $id
			AND um.USMO_URL = '$modulo' AND usm.USSM_URL= '$submodulo' AND uc.USCO_URL = '$controlador'";
			$data = $connection->createCommand($sql)->queryAll(); 
		    //echo "<br><br><br>".$sql;
			return $data;
	  }
	}
	
   public function getTiposHabitaciones(){
	 if(Yii::app()->user->getIsGuest())
     {
       return "";
     }else{
	     	 $connection = Yii::app()->db;
			 $id = Yii::app()->user->id;
			 
			 $sql = "SELECT th.TIHA_ID, th.TIHA_NOMBRE FROM TBL_TIPOSHABITACIONES th ORDER BY TIHA_ID ASC";
			 $data = $connection->createCommand($sql)->queryAll();
			 //echo "<br><br><br>".$sql; 
			 return $data;  
	      }
	}
	
   public function habitaciones($id){
	 if(Yii::app()->user->getIsGuest())
     {
       return "";
     }else{
	     	 $connection = Yii::app()->db;			 
			 $sql = "SELECT h.HABI_ID, h.HABI_NOMBRE, eh.ESHA_NOMBRE, eh.ESHA_URLIMAGEN
			 FROM TBL_HABITACIONES h, TBL_ESTADOHABITACIONES eh
			 WHERE h.ESHA_ID = eh.ESHA_ID AND h.TIHA_ID = $id
			 ORDER BY HABI_ID ASC";
			 $data = $connection->createCommand($sql)->queryAll();
			 //echo "<br><br><br>".$sql; 
			 return $data;  
	      }
	}			
}
?>