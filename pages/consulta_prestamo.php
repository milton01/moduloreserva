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
	$_SESSION['app_id'] = 14;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
	
	}elseif($action == 'operacion'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Solicitar Creacion Cuenta<img src=\"../images/accept.png\" title=\"Solicitar Creacion Cuenta\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Eliminar Solicitud Usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
		$q_solicitud = "SELECT CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, ap.aportacion_cantidad,  so.socio_salario, so.socio_estado,  sd.solicitud_fecha FROM socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = 1 INNER JOIN ahorro ao ON ao.socio_id = so.solicitud_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id WHERE so.solicitud_id = '".$solicitud_id."'";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
	}elseif($action == 'accept'){
		$q_solicitud = "UPDATE socio SET cuenta_id = 2 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		
		$q_socio = "SELECT socio_id, socio_nombre1, socio_apellido1, socio_email FROM socio WHERE solicitud_id = ".$solicitud_id;
		$datos_socio = $object->selquery($q_socio);
		$datos_socio = $datos_socio[0];
		
		$q_usuario = "INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email, usuario_estado, usuario_contador, perfil_id) VALUES ('".$datos_socio['socio_nombre1']."', '".$datos_socio['socio_apellido1']."', '".$datos_socio['socio_email']."', '".md5($datos_socio['socio_email'])."', '".$datos_socio['socio_email']."', 1, 0, 3)";
		$usuario_id = $object->insquery($q_usuario);
		
		$q_socio = "UPDATE socio SET socio_estado = 2, usuario_id = '".$usuario_id."' WHERE socio_id = ".$datos_socio['socio_id'];
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
		input_solicitud_id.setAttribute("value", document.getElementById("socio_id").value);
		
		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
	}
	
	function calculoPago(){
	
	//Cálculo Interés Francés
	
	var numPeriodos = document.getElementById('select_plazo').options[document.getElementById('select_plazo').selectedIndex].value; 
	var tasaInteres = document.getElementById('interes').value;
	var solicitado = document.getElementById('cantidad_solicitar').value;
	var interesMensual= (tasaInteres/12)/100;
	var cuota_mensual= solicitado*(((interesMensual)*Math.pow(1+interesMensual,numPeriodos))/(Math.pow(1+interesMensual,numPeriodos)-1))
	var cuotaPlazo = document.getElementById('cuota_plazo');
	
	var cuotaPlazo = document.getElementById('cuota_plazo');
	
	var total_a_pagar = document.getElementById('total_a_pagar');
	cuotaPlazo.setAttribute("value", Math.round(cuota_mensual*100)/100);
	
	total_a_pagar.setAttribute("value", Math.round(cuota_mensual*numPeriodos*100)/100);
	
		
	}
	
	</script>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="titulo_reporte">Consulta Prestamo</div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none'){
	?>
    <form autocomplete="off">
   Id de Socio
   <input class=":required :alpha :only_on_submit vanadium-invalid ;adv" name="socio_id" type="text" id="socio_id" size="10"/>
   <input type="button" value="Buscar" onclick="sndForm('operacion');"/>

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
                <td align="right"><a href="solicitud_ingreso_prestamo.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
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
	}elseif($action == 'operacion'){
	?>
				<table>
				<tr class="fuente12_rojo">
					<td></td>
				</tr>
			<form id="datos" method="post" autocomplete="off">
    	<table id="tabla_contenido">
            <tr>
                <td colspan="3"  class="fuente12_rojo">DATOS PERSONALES</td>
                <td align="right"><a href="solicitud_ingreso_prestamo.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
       
		   </tr>
           
            <tr>
            	<td>Primer Nombre</td>
                <td><input name="socio_nombre1" type="text" disabled="disabled" id="socio_nombre1" value="<?php echo $solicitud['nombre_completo']?>" size="35" readonly="readonly"/></td>
            </tr>
			      <tr>
        <td>Sueldo</td>
        <td><input class=":alpha :only_on_submit vanadium-invalid" name="socio_sueldo" type="text" id="socio_sueldo" value="<?php echo $solicitud['socio_salario']?>"  size="10"/></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td><input class=":required :only_on_submit vanadium-invalid" value ="<?php echo $solicitud['socio_estado']?>" name="socio_estado" type="text" id="socio_estado" size="10"/></td>
      </tr>
      <tr>
        <td>Fecha de Ingreso</td>
        <td><input class=":required :only_on_submit vanadium-invalid" value="<?php echo $solicitud['solicitud_fecha']?>" name="socio_fecha_ingreso" type="text" id="socio_fecha_ingreso" size="20"/></td>
      </tr>
      <tr>
        <td>Aportacion</td>
        <td><input name="ahorro_socio_acumulado" value="<?php echo $solicitud['aportacion_cantidad'] ?>" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>Ahorros</td>
        <td><input name="ahorro_socio_acumulado" type="text" id="ahorro_socio_acumulado" size="15" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"  class="fuente12_rojo">Informacion de Solicitud</td>
      </tr>
      <tr>
        <td>Cantidad a Solicitar</td>
        <td><input name="cantidad_solicitar" type="text" id="cantidad_solicitar" size="15"/></td>
      </tr>
      <tr>
        <td>Plazo</td>
        <td>
		<select name="select_plazo" id="select_plazo">
		<option value="2">2</option>
		<option value="4">4</option>
		<option value="6">6</option>
		<option value="8">8</option>
		<option value="10">10</option>
		<option value="12">12</option>
		<option value="14">14</option>
		<option value="16">16</option>
		<option value="18">18</option>
		<option value="20">20</option>
		<option value="22">22</option>
		<option value="24">24</option>
		<option value="26">26</option>
		<option value="28">28</option>
		<option value="30">30</option>
		<option value="32">32</option>
		<option value="34">34</option>
		<option value="36">36</option>
		
		
		</select>
		</td>
      </tr>
      <tr>
        <td>Inter&eacute;s %</td>
        <td><input name="interes" id="interes" onblur="calculoPago();" type="text" size="4"/>
		Cuota de Plazo
		<input name="cuota_plazo" id="cuota_plazo" type="text"/>
		 </td>
        <td></td>
      </tr>
      <tr>
        <td>Total a Pagar</td>
        <td><input class="required" name="total_a_pagar" id="total_a_pagar" type="text" size="15"/></td>
      </tr>
      <tr>
        <td height="62">Observaciones</td>
        <td><textarea class=":required :only_on_submit vanadium-invalid" name="observaciones_solicitud_prestamo" id="observaciones_solicitud_prestamo" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"></textarea></td>
      </tr>
      <tr>
        <td colspan="2">Los Campos con * son Obligatorios</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" id="action" name="action" value="ingresar"/>
          <input type="submit" id="submit" name="submit" class="submit" value="Ingresar"/></td>
      </tr>
			              <td height="50" colspan="3" valign="bottom"><?php echo $action_bar?></td>
        </table>
		</form>		
	<?php
	}
	?>

        </table>

  	<!-- InstanceEndEditable -->
  </div>
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->