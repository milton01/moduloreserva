<?php

 /**
 * @author Codisola
 * @copyright 2012
 */

require_once("../core/Connection.php");
$object = new Connection();

if(isset($_POST['params']) && ($_POST['params'] != '')){
	$gParams = (base64_decode(str_replace('~', '=', trim(strval($_POST['params'])))));
	$gParams = (explode('::', trim(strval($gParams))));
}else{
	$gParams = NULL;
}

if(isset($_POST['step']) && ($_POST['step'] != '')){
	if($_POST['step'] == 1){
		if($gParams != NULL){
			$q_update = "UPDATE perfiles SET perfil_estado = ".$gParams[1]." WHERE perfil_id = ".$gParams[0];
			$update = $object->updquery($q_update);
		}
	}elseif($_POST['step'] == 2){
		if($gParams != NULL){
			if($gParams[1] == 1){
				$vWhere = ", usuario_contador = 0";
			}
			$q_update = "UPDATE usuarios SET usuario_estado = ".$gParams[1]." ".$vWhere." WHERE usuario_id = ".$gParams[0];
			$update = $object->updquery($q_update);
		}
	}else{
		#Aqui se puede segir agregando mas Pasos
	}
}
?>