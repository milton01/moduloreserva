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
	$_SESSION['app_id'] = 9;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
	
	}elseif($action == 'operacion'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Enviar Solicitud<img src=\"../images/accept.png\" title=\"Solicitar Creacion Cuenta\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Eliminar Solicitud Usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
		$q_solicitud = "SELECT so.socio_id, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, ap.aportacion_cantidad,  so.socio_salario, so.socio_estado,  sd.solicitud_fecha FROM socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = 1 INNER JOIN ahorro ao ON ao.socio_id = so.socio_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id WHERE so.socio_id = '".$solicitud_id."'";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
	}elseif($action == 'accept'){	

        $q_solicitud = "INSERT INTO solicitud (solicitud_estado, solicitud_fecha, tipo_soli_id, usuario_id, sucursal_id) VALUES (1, NOW(), 2, " . $datos_usuario['usuario_id'] . ", 1)";
        $solicitud_id_ = $object->insquery($q_solicitud);
	
		$q_sol_max = "SELECT MAX(solicitud_id) AS solicitud_ap FROM solicitud";
		$q_solicitudmax = $object->selquery($q_sol_max);
		$q_solicitudmax = $q_solicitudmax[0];		
		
		$q_socio_dato ="SELECT COUNT(so.solicitud_id) AS solicitud_count FROM solicitud_socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id WHERE so.socio_id = ".$solicitud_id." AND sd.solicitud_estado = 2";
		$socio_dato_p = $object->selquery($q_socio_dato);
		$socio_dato_p = $socio_dato_p[0];
		
		if($q_solicitudmax['solicitud_ap']==null){
		
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(1,".$solicitud_id.")";
		$sol_socio = $object->insquery($q_sol_socio);
		
		$q_prestamo = "INSERT INTO prestamo (prestamo_numero,prestamo_cuota,prestamo_plazo,prestamo_interes, prestamo_monto,  prestamo_tpagar,prestamo_observacion, solicitud_id) VALUES  (1,'".addslashes($prestamo_cuota)."','".addslashes($plazo)."','".addslashes($prestamo_interes)."','".addslashes($cantidad_solicitar)."','".addslashes($prestamo_tpagar)."','".addslashes($prestamo_observacion)."',1)";
		$insert_solicitud_p = $object->insquery($q_prestamo);
		
		}else{
		
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(".$q_solicitudmax['solicitud_ap'].",".$solicitud_id.")";
		$sol_socio = $object->insquery($q_sol_socio);
		
		$q_prestamo = "INSERT INTO prestamo (prestamo_numero,prestamo_cuota,prestamo_plazo,prestamo_interes, prestamo_monto,  prestamo_tpagar,prestamo_observacion, solicitud_id) VALUES  (".$socio_dato_p['solicitud_count'].",'".addslashes($prestamo_cuota)."','".addslashes($plazo)."','".addslashes($prestamo_interes)."','".addslashes($cantidad_solicitar)."','".addslashes($prestamo_tpagar)."','".addslashes($prestamo_observacion)."','".$q_solicitudmax['solicitud_ap']."')";
		$insert_solicitud_p = $object->insquery($q_prestamo);
		}		
				
		
	/*	$q_solicitud = "UPDATE socio SET cuenta_id = 2 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		
		$q_socio = "SELECT socio_id, socio_nombre1, socio_apellido1, socio_email FROM socio WHERE solicitud_id = ".$solicitud_id;
		$datos_socio = $object->selquery($q_socio);
		$datos_socio = $datos_socio[0];
		
		$q_usuario = "INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email, usuario_estado, usuario_contador, perfil_id) VALUES ('".$datos_socio['socio_nombre1']."', '".$datos_socio['socio_apellido1']."', '".$datos_socio['socio_email']."', '".md5($datos_socio['socio_email'])."', '".$datos_socio['socio_email']."', 1, 0, 3)";
		$usuario_id = $object->insquery($q_usuario);
		
		$q_socio = "UPDATE socio SET socio_estado = 2, usuario_id = '".$usuario_id."' WHERE socio_id = ".$datos_socio['socio_id'];
		$socio = $object->updquery($q_socio);
		$object->redireccionURL(); */
		
	}elseif($action == 'reject'){
		$q_solicitud = "UPDATE solicitud SET solicitud_estado = 3 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		$object->redireccionURL();
	}
    ?>
    <script>
	function sndForm(action, solicitud_id){

		
		var input_action = document.createElement("input");
		input_action.setAttribute("name", "action");
		input_action.setAttribute("type", "hidden");
		input_action.setAttribute("value", action);
		
		var input_solicitud_id = document.createElement("input");
		input_solicitud_id.setAttribute("name", "solicitud_id");
		input_solicitud_id.setAttribute("type", "hidden");
		input_solicitud_id.setAttribute("value", document.getElementById("socio_id").value);

		var formSolPrestamo = document.getElementById('formSolicitudPrestamo');
				
		
		var form = document.createElement("form");
		form.setAttribute("name", "formulario");
		form.setAttribute("action", "");
		form.setAttribute("method", "post");
				
		
		var cantidad_solicitar = document.getElementById('cantidad_solicitar');
		var plazo = document.getElementById('plazo');
		var prestamo_tpagar = document.getElementById('prestamo_tpagar');
		var prestamo_interes = document.getElementById('prestamo_interes');				
		var prestamo_cuota = document.getElementById('prestamo_cuota'); 		
		var prestamo_observacion = document.getElementById('prestamo_observacion');		
		
		if(input_action.value=='operacion'){

		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
		
		}else if (input_action.value=='accept' && plazo.value>0 && prestamo_tpagar.value>0){
		alert(input_solicitud_id.value);
		formSolPrestamo.appendChild(input_action);
		formSolPrestamo.appendChild(input_solicitud_id);
		formSolPrestamo.appendChild(cantidad_solicitar);
		formSolPrestamo.appendChild(plazo);								
		formSolPrestamo.appendChild(prestamo_tpagar);
		formSolPrestamo.appendChild(prestamo_interes);		
		formSolPrestamo.appendChild(prestamo_cuota);
		formSolPrestamo.appendChild(prestamo_observacion);			
		document.getElementsByTagName("body")[0].appendChild(formSolPrestamo);
		document.formSolicitudPrestamo.submit();
		}else{
		false;
		}
	}
	
	function calculoPago(){
	
	//Cálculo Interés Francés
	
	var numPeriodos = document.getElementById('prestamo_cuota').options[document.getElementById('prestamo_cuota').selectedIndex].value; 
	var tasaInteres = document.getElementById('prestamo_interes').value;
	var solicitado = document.getElementById('cantidad_solicitar').value;
	var interesMensual= (tasaInteres/12)/100;
	var cuota_mensual= solicitado*(((interesMensual)*Math.pow(1+interesMensual,numPeriodos))/(Math.pow(1+interesMensual,numPeriodos)-1))

	var cuotaPlazo = document.getElementById('plazo');
	
	var total_a_pagar1 = document.getElementById('prestamo_tpagar');
	cuotaPlazo.setAttribute("value", Math.round(cuota_mensual*100)/100);
	
	total_a_pagar1.setAttribute("value", Math.round(cuota_mensual*numPeriodos*100)/100);
	
		
	}
	
	</script>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="titulo_reporte">Solicitud Ingreso Prestamo</div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none'){
	?>
		<form id="consulta" autocomplete="off">
	  <font color="black" > Id de Socio <font>
	   <input class="validate[required] text-input" name="socio_id" type="text" id="socio_id" size="5"/>
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
	}elseif($action == 'operacion'){
	?>
	   Id de Socio
		<form id="consulta" method="post" autocomplete="off">
	   <input class="validate[required] text-input" value="<?php echo $solicitud['socio_id'] ?>" name="socio_id" type="text" id="socio_id" size="5"/>
	   <input type="button" value="Buscar" onclick="sndForm('operacion');"/>

    </form>	
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
                <td><input name="socio_nombre1" type="text" disabled="disabled" id="socio_nombre1" value="<?php echo $solicitud['nombre_completo']?>" size="45" readonly="readonly"/></td>
            </tr>
			      <tr>
        <td>Sueldo</td>
        <td><input class=":alpha :only_on_submit vanadium-invalid" name="socio_sueldo" type="text" id="socio_sueldo" value="<?php echo $solicitud['socio_salario']?>"  size="5"/></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td><input class=":required :only_on_submit vanadium-invalid" value ="<?php echo $solicitud['socio_estado']?>" name="socio_estado" type="text" id="socio_estado" size="5"/></td>
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
        <td><input name="ahorro_socio_acumulado" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  </table>
	  </form>
	 
	  <form id="formSolicitudPrestamo" method="post">
	   <table id="tabla_contenido">
      <tr>
        <td colspan="2"  class="fuente12_rojo">Informacion de Solicitud</td>
      </tr>
      <tr>
        <td>Cantidad a Solicitar</td>
        <td><input  class="validate[required,custom[number],min[50],max[3000]]" name="cantidad_solicitar" type="text" id="cantidad_solicitar" size="10"/></td>
      </tr>
      <tr>
        <td>Plazo</td>
        <td>
		<select name="prestamo_cuota" id="prestamo_cuota">
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
        <td><input class="validate[required,custom[number],min[1],max[100]]" name="prestamo_interes" id="prestamo_interes" onblur="calculoPago();" type="text" size="4"/>
		Cuota de Plazo
		<input name="plazo" id="plazo" type="text" size="5"/>
		 </td>
        <td></td>
      </tr>
      <tr>
        <td>Total a Pagar</td>
        <td><input class="required" name="prestamo_tpagar" id="prestamo_tpagar" type="text" size="10"/></td>
      </tr>
      <tr>
        <td height="62">Observaciones</td>
        <td><textarea class="validate[required]" name="prestamo_observacion" id="prestamo_observacion" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"></textarea></td>
      </tr>
      <tr>
        <td colspan="2">Los Campos con * son Obligatorios</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" id="action" name="action" value="ingresar"/>
          <input type="submit" id="submit" name="submit" class="submit" onclick="sndForm('accept');" value="Ingresar"/></td>
      </tr>

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