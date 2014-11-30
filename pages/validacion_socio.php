<!-- InstanceBegin template="/Templates/codisola.dwt.php" codeOutsideHTMLIsLocked="false" --><!-- InstanceBeginEditable name="head" -->
<?php

 /**
 * @author Codisola
 * @copyright 2012
 */

?>
<!-- InstanceEndEditable -->
<div id="wrapper">
	<!-- InstanceBeginEditable name="includes" -->
  	<?php
	include('header.php');
    include('menu.php');
	$_SESSION['app_id'] = 6;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
		$action_bar = "<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'detail\', ', sd.solicitud_id, ');\" class=\"fuente10_negro\"><img src=\"../images/icon_search.png\" title=\"Detalle solicitud\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td></tr></table>";
		$q_solicitudes = "SELECT sd.solicitud_id, CONCAT(so.socio_nombre1, ' ', so.socio_nombre2, ' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, sd.solicitud_fecha, ts.tipo_soli_nombre, sd.solicitud_estado, CONCAT('".$action_bar."', '') AS detalle FROM solicitud sd INNER JOIN socio so ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = sd.tipo_soli_id WHERE sd.solicitud_estado = 'Ingresada' AND so.socio_estado = 'Inactivo' ORDER BY sd.solicitud_id";
		$solicitudes = $object->selquery($q_solicitudes);
	}elseif($action == 'detail'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Aprobar usuario <img src=\"../images/accept.png\" title=\"Aprobar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Rechazar usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
		$q_solicitud = "SELECT sd.solicitud_id, so.socio_sexo, so.est_civil_id, so.socio_nombre1, so.socio_nombre2, so.socio_apellido1, so.socio_apellido2, so.socio_apellidoc, so.socio_dui, so.socio_nit, so.socio_isss, so.socio_fecha_nacimiento, so.socio_salario, so.socio_tel_casa, so.socio_tel_celular, so.socio_tel_oficina, so.socio_email, so.socio_direccion FROM solicitud sd INNER JOIN socio so ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = sd.tipo_soli_id WHERE sd.solicitud_id = '".$solicitud_id."' ORDER BY sd.solicitud_id";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
	}elseif($action == 'accept'){
		$q_solicitud = "UPDATE solicitud SET solicitud_estado = 2 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		
		$q_socio = "SELECT socio_id, socio_nombre1, socio_apellido1, socio_email FROM socio WHERE solicitud_id = ".$solicitud_id;
		$datos_socio = $object->selquery($q_socio);
		$datos_socio = $datos_socio[0];
		
		$q_usuario = "INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email, usuario_estado, usuario_contador, perfil_id) VALUES ('".$datos_socio['socio_nombre1']."', '".$datos_socio['socio_apellido1']."', '".$datos_socio['socio_email']."', '".md5($datos_socio['socio_email'])."', '".$datos_socio['socio_email']."', 1, 0, 3)";
		$usuario_id = $object->insquery($q_usuario);
		
		$q_socio = "UPDATE socio SET usuario_id = '".$usuario_id."' WHERE socio_id = ".$datos_socio['socio_id'];
		$socio = $object->updquery($q_socio);
		$object->redireccionURL();
	}elseif($action == 'reject'){
		$q_solicitud = "UPDATE solicitud SET solicitud_estado = 3 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		$object->redireccionURL();
	}
    ?>
    <script>
	function sndForm(action, solicitud_id){
		var form = document.createElement("form");
		form.setAttribute("name", "formulario");
		form.setAttribute("action", "");
		form.setAttribute("method", "post");
		
		var input_action = document.createElement("input");
		input_action.setAttribute("name", "action");
		input_action.setAttribute("type", "hidden");
		input_action.setAttribute("value", action);
		
		var input_solicitud_id = document.createElement("input");
		input_solicitud_id.setAttribute("name", "solicitud_id");
		input_solicitud_id.setAttribute("type", "hidden");
		input_solicitud_id.setAttribute("value", solicitud_id);
		
		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
	}
	</script>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="titulo_reporte">Validaci&oacute;n Socio</div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none' && count($solicitudes) > 0){
	?>
    <form autocomplete="off">
       <table id="tabla_contenido">
          <tr>
            <th align="center">N&ordm; Solicitud</th>
            <th align="center">Nombre</th>
            <th align="center">Fecha de Ingreso</th>
            <th align="center">Tipo de Solicitud</th>
            <th align="center">Estado</th>
            <th align="center">Detalle</th>
          </tr>
          <?php
          foreach($solicitudes as $key => $val){
		  ?>
          <tr>
            <td align="center"><?php echo $val['solicitud_id']?></td>
            <td><?php echo $val['nombre_completo']?></td>
            <td align="center"><?php echo $val['solicitud_fecha']?></td>
            <td align="center"><?php echo $val['tipo_soli_nombre']?></td>
            <td align="center"><?php echo $val['solicitud_estado']?></td>
            <td align="center"><?php echo $val['detalle']?></td>
          </tr>
          <?php
		  }
		  ?>
	  </table>
    </form>
    <?php
	}elseif($action == 'none'){
	?>
		<table>
            <tr class="fuente12_rojo">
                <td>No hay validaciones pendientes</td>
            </tr>
        </table>
	<?php
	}elseif($action == 'detail'){
	?>
	<form method="post" autocomplete="off">
    	<table id="tabla_contenido">
            <tr>
                <td colspan="3">DATOS PERSONALES</td>
                <td align="right"><a href="validacion_socio.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
            </tr>
            <tr>
                <td width="150">Sexo</td>
                <td width="175"><input type="radio" name="socio_sexo" id="socio_sexo_m" value="M" <?php echo (($solicitud['socio_sexo'] == 'M')? 'checked': 'disabled="disabled"')?>/>Masculino<input type="radio" name="socio_sexo" id="socio_sexo_f" value="F" <?php echo (($solicitud['socio_sexo'] == 'F')? 'checked': 'disabled="disabled"')?>/>Femenino</td>
                <td width="150">Estado Civil</td>
                <td width="175">
                <?php
                $estados_civiles = $object->selquery("SELECT est_civil_id, est_civil_nombre FROM estado_civil ORDER BY est_civil_nombre");
				echo '<select id="est_civil_id" name="est_civil_id" disabled="disabled">';
				foreach($estados_civiles as $key => $val){
					echo '<option value="'.$val['est_civil_id'].'" '.(($val['est_civil_id'] == $solicitud['est_civil_id'])?'selected':'').'>'.$val['est_civil_nombre'].'</option>';
				}
				echo '</select>';
				?>
                </td>
            </tr>
            <tr>
            	<td>Primer Nombre</td>
                <td><input name="socio_nombre1" type="text" disabled="disabled" id="socio_nombre1" value="<?php echo $solicitud['socio_nombre1']?>" size="25" readonly="readonly"/></td>
                <td>Segundo Nombre</td>
                <td><input name="socio_nombre2" type="text" disabled="disabled" id="socio_nombre2" value="<?php echo $solicitud['socio_nombre2']?>" size="25" readonly="readonly"/></td>
            </tr>
            <tr>
                <td>Primer Apellido</td>
                <td><input name="socio_apellido1" type="text" disabled="disabled" id="socio_apellido1" value="<?php echo $solicitud['socio_apellido1']?>" size="25" readonly="readonly"/></td>
                <td>Segundo Apellido</td>
                <td><input name="socio_apellido2" type="text" disabled="disabled" id="socio_apellido2" value="<?php echo $solicitud['socio_apellido2']?>" size="25" readonly="readonly"/></td>
            </tr>
            <tr id="tr_hidden" style="display:none;">
              	<td>Apellido Casada</td>
              	<td><input name="socio_apellidoc" type="text" disabled="disabled" id="socio_apellidoc" value="<?php echo $solicitud['socio_apellidoc']?>" size="25" readonly="readonly"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>DUI</td>
                <td><input name="socio_dui" type="text" disabled="disabled" id="socio_dui" value="<?php echo $solicitud['socio_dui']?>" size="20" readonly="readonly"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
              <td>NIT</td>
              <td><input name="socio_nit" type="text" disabled="disabled" id="socio_nit" value="<?php echo $solicitud['socio_nit']?>" size="20" readonly="readonly"/></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>ISSS</td>
              <td><input name="socio_isss" type="text" disabled="disabled" id="socio_isss" value="<?php echo $solicitud['socio_isss']?>" size="20" readonly="readonly"/></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Fecha nacimiento</td>
                <td><input name="socio_fecha_nacimiento" type="text" disabled="disabled" id="socio_fecha_nacimiento" value="<?php echo $solicitud['socio_fecha_nacimiento']?>" size="20" readonly="readonly"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Sueldo</td>
                <td><input name="socio_salario" type="text" disabled="disabled" id="socio_salario" value="<?php echo $solicitud['socio_salario']?>" size="20" readonly="readonly"/></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
				<td colspan="4">INFORMACION DE CONTACTO</td>
            </tr>
            <tr>
                <td>Tel&eacute;fono casa</td>
                <td><input name="socio_tel_casa" type="text" disabled="disabled" id="socio_tel_casa" value="<?php echo $solicitud['socio_tel_casa']?>" size="20" readonly="readonly"/></td>
            </tr>
            <tr>
                <td>Tel&eacute;fono celular</td>
                <td colspan="3"><input name="socio_tel_celular" type="text" disabled="disabled" id="socio_tel_celular" value="<?php echo $solicitud['socio_tel_celular']?>" size="20" readonly="readonly"/></td>
            </tr>
            <tr>
                <td>Tel&eacute;fono oficina</td>
                <td colspan="3"><input name="socio_tel_oficina" type="text" disabled="disabled" id="socio_tel_oficina" value="<?php echo $solicitud['socio_tel_oficina']?>" size="20" readonly="readonly"/></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td colspan="3"><input name="socio_email" type="text" disabled="disabled" id="socio_email" value="<?php echo $solicitud['socio_email']?>" size="50" readonly="readonly"/></td>
            </tr>
            <tr>
                <td>Direcci&oacute;n</td>
                <td colspan="3"><textarea name="socio_direccion" disabled="disabled" readonly="readonly" id="socio_direccion" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"><?php echo $solicitud['socio_direccion']?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="50" colspan="3" valign="bottom"><?php echo $action_bar?></td>
            </tr>
        </table>
		</form>
	<?php
	}
	?>
  	<!-- InstanceEndEditable -->
  </div>
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->