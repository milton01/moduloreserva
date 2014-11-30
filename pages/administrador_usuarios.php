<?php

 /**
 * @author Codisola
 * @copyright 2012
 */
?>
<style type="text/css" media="all">
@import "../resources/css/StyleMain.css";
</style>
<div id="wrapper">
<?php
	include('header.php');
	include('menu.php');
	$_SESSION['app_id'] = 3;
	include('log.php');
	
	$action = ($_POST['action'] == '')? 'none': $_POST['action'];
	$usuario_id = ($_POST['usuario_id'] == '')? 0: $_POST['usuario_id'];
	
	$usuario_apellido = ($_POST['usuario_apellido'] == '')? '': $_POST['usuario_apellido'];
	$usuario_nombre = ($_POST['usuario_nombre'] == '')? '': $_POST['usuario_nombre'];
	$usuario_email = ($_POST['usuario_email'] == '')? '': $_POST['usuario_email'];
	$usuario_estado = ($_POST['usuario_estado'] == '')? 0: $_POST['usuario_estado'];
	$usuario_perfil = ($_POST['perfil_id'] == '')? 0: $_POST['perfil_id'];
	$checkbox = ($_POST['checkbox'] == '')? '': $_POST['checkbox'];
	$usuario_usuario = ($_POST['usuario_estado'] == '')? 0: $_POST['usuario_usuario'];
	$usuario_clave = ($_POST['clave1'] == '')? '': $_POST['clave1'];
	
	//echo $checkbox.'<br>';
	//echo $action.'<br>';
	
	if($action == 'none'){
		
		$action_bar = "<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'update\', ', u.usuario_id, '); \"><img src=\"../images/icon_edit.png\" title=\"Modificar usuario\" style=\"border:none;\"></a></td></tr></table>";
		$add1 = "<table class=\"fuente08_negro\" align=\"center\"><tr><td width=\"20\"><form name=\"frm1\" method=\"post\" action=\"administrador_usuarios.php\"><input type=\"hidden\" name=\"action\" id=\"action\" value=\"insert\"><input type=\"image\" src=\"../images/icon_add.png\"></form></td></tr></table>";
		
		$query = "SELECT u.usuario_id, u.usuario_nombre, u.usuario_apellido, u.usuario_usuario, u.usuario_email, u.usuario_estado, p.perfil_nombre, CONCAT('".$action_bar."', '') AS accion FROM usuarios u INNER JOIN perfiles p ON p.perfil_id = u.perfil_id ORDER BY u.usuario_apellido, u.usuario_nombre";
		$datos_usuarios = $object->selquery($query);
		
	}elseif($action == 'update'){
		
		$query = "SELECT u.usuario_id, u.usuario_nombre, u.usuario_apellido, u.usuario_usuario, u.usuario_email, u.usuario_estado, p.perfil_id, CONCAT('".$action_bar."', '') AS accion FROM usuarios u INNER JOIN perfiles p ON p.perfil_id = u.perfil_id WHERE u.usuario_id = '".$usuario_id."' ORDER BY u.usuario_apellido, u.usuario_nombre";
		$datos_user = $object->selquery($query);
		$datos_user = $datos_user[0];
		
	}elseif($action == 'actualizar'){
		if($checkbox=='on'){
			$vWhere = ", usuario_clave = MD5('".$usuario_clave."')";
		}else{
			$vWhere = "";
		}
		$query = "UPDATE usuarios SET usuario_nombre='".strtoupper($usuario_nombre)."', usuario_apellido='".strtoupper($usuario_apellido)."', usuario_email='".$usuario_email."', usuario_estado=".$usuario_estado.", perfil_id='".$usuario_perfil."' ".$vWhere." WHERE usuario_id='".$usuario_id."'";
		$upd = $object->updquery($query);
		$object->redireccionURL();
	}elseif($action == 'insertar'){
		$query = "INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email, usuario_estado, usuario_contador, perfil_id) VALUES('".strtoupper($usuario_nombre)."', '".strtoupper($usuario_apellido)."', '".$usuario_usuario."', MD5('".$usuario_clave."'), '".$usuario_email."', ".$usuario_estado.", 0, '".$usuario_perfil."')";
		$inser = $object->insquery($query);
		$object->redireccionURL();
	}
	?>
	<script type="text/javascript">
	function chngEstado(){
		var myParams = (chngEstado.arguments);
		var nP = ((parseInt(myParams.length) < 1)?'':myParams[0]);
		var tParams = (Base64.encode(myParams[0] + '::' + myParams[1]).split('=').join('~'));
		$.ajax({
			type:	 	"POST",
			url:	 	"consultas_jquery.php",
			async:		true,
			data:	 	("step=2&params="+tParams),
			success: 	function(datos){
							alert('Cambio de estado de usuario satisfactorio');
						}
		});
	}
	
	
	function submitform(){
		if(document.frm1.onsubmit()){
			document.frm1.submit();
		}
	}
	
	
	function sndForm(action, usuario_id){
		var form = document.createElement("form");
		form.setAttribute("name", "formulario");
		form.setAttribute("action", "");
		form.setAttribute("method", "post");
		
		var input_action = document.createElement("input");
		input_action.setAttribute("name", "action");
		input_action.setAttribute("type", "hidden");
		input_action.setAttribute("value", action);
		
		var input_usuario_id = document.createElement("input");
		input_usuario_id.setAttribute("name", "usuario_id");
		input_usuario_id.setAttribute("type", "hidden");
		input_usuario_id.setAttribute("value", usuario_id);
		
		form.appendChild(input_action);
		form.appendChild(input_usuario_id);
		
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
	}
	
	$(document).ready(function(){
		$("#checkbox").click(function() { 
			var _status = this.checked; 
			if(_status == true){
				$("#div_clave1").attr('style', 'display: block');
				$("#div_clave2").attr('style', 'display: block');
			}else if(_status == false){
				$("#div_clave1").attr('style', 'display: none');
				$("#div_clave2").attr('style', 'display: none');
			}
		});
	});
	
	</script>
    <div id="content">
	<!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <div class="titulo_reporte">Administrador de Usuarios</div>
        <?php
        $object->permisoApp($permiso_app);
        
        if($action == 'none' && count($datos_usuarios) > 0){
            //$object->getReport($datos_usuarios);
        ?>
        <table id="tabla_reporte">
            <tr>
                <th width="150">Apellido</th>
              <th width="150">Nombre</th>
              <th width="100">Usuario</th>
              <th width="150">E-Mail</th>
              <th width="100">Estado</th>
              <th width="150">Perfil Asignado</th>
              <th width="100" align="center"><?php echo $add1?></th>
            </tr>
            <?php
            foreach($datos_usuarios as $key => $val){
            ?>
            <tr>
                <td><?php echo $val['usuario_apellido'];?></td>
                <td><?php echo $val['usuario_nombre'];?></td>
                <td><?php echo $val['usuario_usuario'];?></td>
                <td><?php echo $val['usuario_email'];?></td>
              <td align="center">
        <select id="usuario_estado_<?php echo $val['usuario_id']?>" name="usuario_estado_<?php echo $val['usuario_id']?>" class="fuente10_negro" onChange="chngEstado(<?php echo $val['usuario_id']?>, this.value);">
                        <?php
                        $estados = $object->getEnumValues('usuarios', 'usuario_estado');
                        foreach($estados as $k => $v){
                        ?>
                        <option value="<?php echo ($k + 1)?>" <?php echo ($val['usuario_estado'] == $v)?'selected':''?>><?php echo $v?></option>
                        <?php
                        }
                        ?>
                    </select>
              </td>
              <td align="center"><?php echo $val['perfil_nombre'];?></td>
              <td align="center"><?php echo $val['accion'];?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
        }elseif($action == 'none'){
        ?>
        <table>
            <tr class="fuente12_rojo">
                <td>No se encontraron usuarios a mostrar</td>
            </tr>
        </table>
        <?php
        }elseif($action == 'update'){
        ?>
        <form id="datos_usuario" method="post">
        <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $datos_user['usuario_id']?>"/>
        <table>
            <tr height="25">
                <td colspan="2" class="fuente14b_negro" align="center" height="50" valign="top"><u>Datos de usuario</u></td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">ID</td>
                <td width="200" class="fuente12_negro"><?php echo $datos_user['usuario_id']?></td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Apellido</td>
                <td width="200" class="fuente12_negro">
                    <input type="text" id="usuario_apellido" class="validate[required] text-input" name="usuario_apellido" class=":required :only_on_submit" value="<?php echo $datos_user['usuario_apellido']?>" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Nombre</td>
                <td width="200" class="fuente12_negro">
                    <input type="text" id="usuario_nombre"  class="validate[required] text-input" name="usuario_nombre" class=":required :only_on_submit" value="<?php echo $datos_user['usuario_nombre']?>" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Usuario</td>
                <td width="200" class="fuente12_negro"><?php echo $datos_user['usuario_usuario']?></td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">E-Mail</td>
                <td width="200" class="fuente12_negro">
                    <input type="text" class="validate[required[custom[email]]] text-input" id="usuario_email" name="usuario_email" class=":required :email :only_on_submit" value="<?php echo $datos_user['usuario_email']?>" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Estado</td>
                <td width="200" class="fuente12_negro">
                    <select id="usuario_estado" name="usuario_estado">
                        <?php
                        $estados = $object->getEnumValues('usuarios', 'usuario_estado');
                        foreach($estados as $k => $v){
                        ?>
                        <option value="<?php echo ($k + 1)?>" <?php echo ($datos_user['usuario_estado'] == $v)?'selected':''?>><?php echo $v?></option>
                        <?php
                        }
                        ?>
                  </select>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Perfil</td>
                <td width="200" class="fuente12_negro">
                    <select id="perfil_id" name="perfil_id">
                        <?php
                        $perfiles = $object->selquery("SELECT perfil_id, perfil_nombre FROM perfiles ORDER BY perfil_nombre");
                        foreach($perfiles as $k => $v){
                        ?>
                        <option value="<?php echo $v['perfil_id']?>" <?php echo ($datos_user['perfil_id'] == $v['perfil_id'])?'selected':''?>><?php echo $v['perfil_nombre']?></option>
                        <?php
                        }
                        ?>
                  </select>
              </td>
            </tr>
            <tr height="40">
                <td width="100" class="fuente12b_rojo">Cambiar clave</td>
                <td width="200" class="fuente12_rojo">
                    <input type="checkbox" id="checkbox" name="checkbox"/>
              </td>
            </tr>
        </table>
        <table id="div_clave1" style="display:none">
        <tr>
                <td width="100" class="fuente12b_negro">Nueva Clave</td>
                <td width="200" class="fuente12_negro">
                    <input type="password" id="clave1" name="clave1" style="width:200px"/>
                </td>
            </tr>
            <tr>
                <td width="100" class="fuente12b_negro">Repetir clave</td>
                <td width="200" class="fuente12_negro">
                    <input type="password" id="clave2" name="clave2" style="width:200px"/>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td height="40" valign="bottom" align="center" width="250">
                    <input type="submit" id="submit" name="submit" class=":submit" value="Actualizar"/>
                    <input type="hidden" id="action" name="action" value="actualizar"/>
                </td>
            </tr>
        </table>
        </form>
        <?php
        }elseif($action == 'insert'){
        ?>
        <form method="post">
        <table>
            <tr height="25">
                <td colspan="2" class="fuente14b_negro" align="center" height="50" valign="top"><u>Datos del nuevo usuario</u></td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Apellido</td>
                <td width="200" class="fuente12_negro">
                    <input type="text" id="usuario_apellido" name="usuario_apellido" class=":required :only_on_submit" value="" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Nombre</td>
                <td width="200" class="fuente12_negro">
                    <input type="text" id="usuario_nombre" name="usuario_nombre" class=":required :only_on_submit" value="" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Usuario</td>
                <td width="200" class="fuente12_negro">
                <input type="text" id="usuario_usuario" name="usuario_usuario" class=":required :only_on_submit" value="" style="width:200px"/>
            </td>
            </tr>
            <tr>
                <td width="100" class="fuente12b_negro">Nueva Clave</td>
                <td width="200" class="fuente12_negro">
                    <input type="password" id="clave1" name="clave1" class=":required :only_on_submit" value="" style="width:200px"/>
                </td>
            </tr>
            <tr>
                <td width="100" class="fuente12b_negro">Repetir clave</td>
                <td width="200" class="fuente12_negro">
                    <input type="password" id="clave2" name="clave2" class=":required :only_on_submit" style="width:200px"/>
                </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">E-Mail</td>
                <td width="200" class="fuente12_negro">
                <input type="text" id="usuario_email" name="usuario_email" class=":required :email :only_on_submit" value="" style="width:200px"/>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Estado</td>
                <td width="200" class="fuente12_negro">
                    <select id="usuario_estado" name="usuario_estado">
                        <?php
                        $estados = $object->getEnumValues('usuarios', 'usuario_estado');
                        foreach($estados as $k => $v){
                        ?>
                        <option value="<?php echo ($k + 1)?>" <?php echo ($datos_user['usuario_estado'] == $v)?'selected':''?>><?php echo $v?></option>
                        <?php
                        }
                        ?>
                  </select>
              </td>
            </tr>
            <tr height="25">
                <td width="100" class="fuente12b_negro">Perfil</td>
                <td width="200" class="fuente12_negro">
                    <select id="perfil_id" name="perfil_id">
                        <?php
                        $perfiles = $object->selquery("SELECT perfil_id, perfil_nombre FROM perfiles ORDER BY perfil_nombre");
                        foreach($perfiles as $k => $v){
                        ?>
                        <option value="<?php echo $v['perfil_id']?>" <?php echo ($datos_user['perfil_id'] == $v['perfil_id'])?'selected':''?>><?php echo $v['perfil_nombre']?></option>
                        <?php
                        }
                        ?>
                  </select>
              </td>
            </tr>
            <tr>
                <td height="40" colspan="2" valign="bottom" align="center" width="250">
                    <input type="submit" id="submit" name="submit" class=":submit" value="Guardar"/>
                    <input type="hidden" id="action" name="action" value="insertar"/>
                </td>
            </tr>
        </table>
        </form>
        <?php
        }
        ?>
	</div>
    <?php
    include('footer.php');
	?>
</div>