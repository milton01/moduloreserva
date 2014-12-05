<?php

 /**
 * @author 
 * @copyright 
 */
 
require_once("Connection.php");

class Users extends Connection{
	
	function search_user($usuario){
			$query_datos = "SELECT U.username, E.first_name, E.last_name, E.phone_number, E.email, E.address_1, E.numero_documento FROM decameron_employees U, decameron_people E WHERE U.username = '".addslashes($usuario)."' AND E.person_id = U.person_id";
			$datos = $this->selquery($query_datos);
			if(count($datos) > 0){
				return $datos;
			}else{
				return False;
			}		
	}	
	
	function IsLogued(){
		$fecha_actual = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));
		if($fecha_actual <= $_SESSION['fecha_log']){
			$fecha_log = true;
		}else{
			$fecha_log = false;
		}
		if($fecha_log == true){
			if(isset($_SESSION['islog']) && $_SESSION['islog'] == true){
				$_SESSION['fecha_log'] = mktime(date('H'), date('i')+30, date('s'), date('n'), date('j'), date('Y'));
				return true;
			}else{
				$this->LogOut();
				return false;
			}
		}else{
			$this->LogOut();
			return false;
		}
	}
}

?>