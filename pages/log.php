<?php

 /**
 * @author Codisola
 * @copyright 2012
 */

$suite_id = $object->seldato("SELECT suite_id FROM aplicaciones WHERE app_id = '".$_SESSION['app_id']."'");

$app = $object->seldato("SELECT app_id FROM perfiles_aplicaciones WHERE perfil_id = '".$_SESSION['datos_usuario']['perfil_id']."' AND app_id = '".$_SESSION['app_id']."' AND perapp_estado = 1");

if($app > 0){
	$permiso_app = true;
}else{
	$permiso_app = false;
}
if($_SESSION['app_id'] > 0 && $suite_id > 0){
?>
	<script>AppSelected('<?php echo $_SESSION['app_id']?>', '<?php echo $suite_id?>')</script>
<?php
}
?>