<!-- InstanceBegin template="/Templates/codisola.dwt.php" codeOutsideHTMLIsLocked="false" --><!-- InstanceBeginEditable name="head" -->
<?php

 /**
 * @author Codisola
 * @copyright 2012
 */
/*
 echo '<pre>';
 echo 'GET';
 print_r($_GET);
 echo 'POST';
 print_r($_POST);
 echo '<pre>';
 */
?>
<!-- InstanceEndEditable -->
<div id="wrapper">
	<!-- InstanceBeginEditable name="includes" -->
  	<?php
	include('header.php');
    include('menu.php');
	$_SESSION['app_id'] = 8;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
	
	}elseif($action == 'operacion'){		
		$q_solicitud = "SELECT so.socio_id, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, ap.aportacion_cantidad,  so.socio_salario, so.socio_estado,  sd.solicitud_fecha FROM socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = 1 INNER JOIN ahorro ao ON ao.socio_id = so.socio_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id WHERE so.socio_id = '".$socio_id."'";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
	}elseif($action == 'accept'){

    	$date = date("Y-m-d");
		$q_solicitud = "SELECT so.socio_id, ao.cuenta_numero, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, ap.aportacion_cantidad,  so.socio_salario, so.socio_estado,  sd.solicitud_fecha FROM socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = 2 INNER JOIN ahorro ao ON ao.socio_id = so.solicitud_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id WHERE so.socio_id = '".$socio_id."'";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];	

	
		if($movimiento_ahorro=='Abono'){
	    
		$q_solicitud = "INSERT INTO solicitud (solicitud_estado, solicitud_fecha, tipo_soli_id, usuario_id, sucursal_id) VALUES (4, NOW(), 2, " . $datos_usuario['usuario_id'] . ", 1)";
        $solicitud_id_ = $object->insquery($q_solicitud);
		
    	$q_sol_max = "SELECT MAX(solicitud_id) AS solicitud_ap FROM solicitud";
		$q_solicitudmax = $object->selquery($q_sol_max);
		$q_solicitudmax = $q_solicitudmax[0];		
	
		if($q_solicitudmax['solicitud_ap']==null){
		
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(1,".$socio_id.")";
		$sol_socio = $object->insquery($q_sol_socio);		
		
		}else{
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(".$q_solicitudmax['solicitud_ap'].",".$socio_id.")";
		$sol_socio = $object->insquery($q_sol_socio);	
		}
		
		$q_operacion = "INSERT INTO operacion (operacion_fecha, socio_id, cuenta_ahorro, usuario_id, tipo_operacion, operacion_monto) VALUES ('$date','".$solicitud['socio_id']."','".$solicitud['cuenta_numero']."', " . $datos_usuario['usuario_id'] . ",'Ahorro','".addslashes($cantidad_ahorro)."')";
		$nueva_operacion = $object->insquery($q_operacion);		
		
			
		
		}else if($movimiento_ahorro=='Retiro Parcial'){
		
		$q_solicitud = "INSERT INTO solicitud (solicitud_estado, solicitud_fecha, tipo_soli_id, usuario_id, sucursal_id) VALUES ('Ingresada', NOW(), 2, " . $datos_usuario['usuario_id'] . ", 1)";
        $solicitud_id_ = $object->insquery($q_solicitud);
		
    	$q_sol_max = "SELECT MAX(solicitud_id) AS solicitud_ap FROM solicitud";
		$q_solicitudmax = $object->selquery($q_sol_max);
		$q_solicitudmax = $q_solicitudmax[0];
		
		if($q_solicitudmax['solicitud_ap']==null){
		
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(1,".$socio_id.")";
		$sol_socio = $object->insquery($q_sol_socio);		
		
		}else{
		$q_sol_socio = "INSERT INTO solicitud_socio (solicitud_id, socio_id) VALUES(".$q_solicitudmax['solicitud_ap'].",".$socio_id.")";
		$sol_socio = $object->insquery($q_sol_socio);	
		}

		$q_sol_socio = "INSERT INTO op_ahorro (op_ahorro_monto, op_ahorro_fecha, op_ahorro_descripcion, op_ahorro_tipo, solicitud_id) VALUES( '" . addslashes($cantidad_ahorro) . "','$date', '" . addslashes($observaciones_solicitud_prestamo) . "','Retiro',".$q_solicitudmax['solicitud_ap'].")";
		$sol_socio = $object->insquery($q_sol_socio);	
		
		}else if($movimiento_ahorro=='Retiro'){
			
		echo $movimiento_ahorro;
		}
	
	
	/*	$q_solicitud = "UPDATE socio SET cuenta_id = 2 WHERE solicitud_id = ".$socio_id;
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
		
		var form = document.createElement("form");
		form.setAttribute("name", "formulario");
		form.setAttribute("action", "");
		form.setAttribute("method", "post");
		
		var input_action = document.createElement("input");
		input_action.setAttribute("name", "action");
		input_action.setAttribute("type", "hidden");
		input_action.setAttribute("value", action);
		
		var input_solicitud_id = document.createElement("input");
		input_solicitud_id.setAttribute("name", "socio_id");
		input_solicitud_id.setAttribute("type", "hidden");
		input_solicitud_id.setAttribute("value", document.getElementById("socio_id").value);
		
		
		var ahorro_monto = document.getElementById('cantidad_ahorro');
		
		var movimiento_ahorro = document.getElementById('movimiento_ahorro'); 
		
		var ahorro_observaciones = document.getElementById('observaciones_solicitud_prestamo'); 
		
		var formSolAhorro = document.getElementById('frmSolicitudAhorro');
		
		
		if(input_action.value=='operacion'){
		
		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
		
		}else if (input_action.value=='accept'){
		formSolAhorro.appendChild(input_action);
		formSolAhorro.appendChild(input_solicitud_id);
		formSolAhorro.appendChild(movimiento_ahorro);		
		formSolAhorro.appendChild(ahorro_monto);
		formSolAhorro.appendChild(ahorro_observaciones);
		document.getElementsByTagName("body")[0].appendChild(formSolAhorro);
		document.frmSolicitudAhorro.submit();
	
	}
	}
	
	
	</script>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="titulo_reporte">Solicitud Retiro de Ahorros</div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none'){
	?>
    <form autocomplete="off">
 	  <font color="black" > Id de Socio <font>
   <input class=":required :alpha :only_on_submit vanadium-invalid ;adv" name="socio_id" type="text" id="socio_id" size="5"/>
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
		    <form autocomplete="off">
	  	  <font color="black" > Id de Socio <font>
	   <input class=":required :alpha :only_on_submit vanadium-invalid ;adv" value="<?php echo $solicitud['socio_id'] ?>" name="socio_id" type="text" id="socio_id" size="5"/>
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
                <td align="right"><a href="solicitudes_ahorro.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
       
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
        <td>Ahorros</td>
        <td><input name="ahorro_socio_acumulado" value="<?php echo $solicitud['aportacion_cantidad'] ?>" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>	  
      <tr>
        <td>Aportacion</td>
        <td><input name="ahorro_socio_acumulado" value="<?php echo $solicitud['aportacion_cantidad'] ?>" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"  class="fuente12_rojo">Informacion de Solicitud</td>
      </tr>
      <tr>
	  </table>
	    </form>
	<form id="frmSolicitudAhorro" method="post">
	<table id="tabla_contenido">
	<td> Tipo Movimiento </td>
	<td> <select id="movimiento_ahorro" name="movimiento_ahorro">
		<option value="Abono">Abono</option>
		<option value="Retiro Parcial">Retio Parcial</option>
		<option value="Retiro Total">Retiro Total</option>
		</select></td>
		<tr>
        <td>Monto</td>
        <td><input class="validate[required,custom[number],min[1],max[50000]]"  name="cantidad_ahorro" type="text" id="cantidad_ahorro" size="15"/></td>
      </tr>
 
        <td height="62">Observaciones</td>
        <td><textarea class="validate[required] text-input"" name="observaciones_solicitud_prestamo" id="observaciones_solicitud_prestamo" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"></textarea></td>
      </tr>
      <tr>
        <td colspan="2">Los Campos con * son Obligatorios</td>
      </tr>
      <tr>
	 
        <td>&nbsp;</td>
        <td><input type="hidden" id="action" name="action" value="ingresar"/>
		 <input type="submit" id="submit" name="submit"  class="submit" onclick="sndForm('accept');"  value="Ingresar Solicitud"/>
          </td>
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