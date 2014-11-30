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
	$_SESSION['app_id'] = 7;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
		$action_ope ="<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'operacion\', ', sd.solicitud_id, ');\" class=\"fuente10_negro\"><img src=\"../images/accept.png\" title=\"Accion solicitud\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td></tr></table>";
		$q_solicitudes = "SELECT sd.solicitud_id, CONCAT(so.socio_nombre1, ' ', so.socio_nombre2, ' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, sd.solicitud_fecha, ts.tipo_soli_nombre, sd.solicitud_estado, so.socio_salario, CONCAT('".$action_bar."', '') AS detalle, CONCAT('".$action_ope."', '') AS operacion FROM solicitud sd INNER JOIN socio so ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = sd.tipo_soli_id WHERE so.socio_estado = 'Inactivo' ORDER BY sd.solicitud_id";
		$solicitudes = $object->selquery($q_solicitudes);
	}elseif($action == 'operacion'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Finalizar Proceso Socio<img src=\"../images/accept.png\" title=\"Solicitar Creacion Cuenta\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Eliminar Solicitud Usuario <img src=\"../images/icon_delete.png\" title=\"Eliminar Solicitud Usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
		$q_solicitud = "SELECT sd.solicitud_id, so.socio_sexo, so.est_civil_id, so.socio_nombre1, so.socio_nombre2, so.socio_apellido1, so.socio_apellido2, so.socio_apellidoc, so.socio_dui, so.socio_nit, so.socio_isss, so.socio_fecha_nacimiento, so.socio_salario, so.socio_tel_casa, so.socio_tel_celular, so.socio_tel_oficina, so.socio_email, so.socio_direccion FROM solicitud sd INNER JOIN socio so ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = sd.tipo_soli_id WHERE sd.solicitud_id = '".$solicitud_id."' ORDER BY sd.solicitud_id";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
	}elseif($action == 'accept'){
		
		$q_cuenta_max = "SELECT MAX(cuenta_id)+10 AS max_cuenta FROM ahorro";
		$dato_cuenta = $object->selquery($q_cuenta_max);
		$dato_cuenta = $dato_cuenta[0];
		
		$q_socioid = "SELECT socio_id FROM socio WHERE solicitud_id = ".$solicitud_id."";
		$socio_id = $object->selquery($q_socioid);
		$socio_id = $socio_id[0];

//observacion
		
		if($dato_cuenta['max_cuenta']==null && $dato_cuenta['cuenta_id']==null){
		$q_cuenta = "INSERT ahorro (cuenta_numero, socio_id) VALUES(1,'".$socio_id['socio_id']."')";
		$insert_solicitud = $object->insquery($q_cuenta);
		
		}else{
		
		$q_cuenta = "INSERT ahorro (cuenta_numero, socio_id) VALUES('".$dato_cuenta['max_cuenta']."','".$socio_id['socio_id']."')";
		$insert_solicitud = $object->insquery($q_cuenta);
		}
		
		$q_cuenta_socio = "SELECT cuenta_id FROM ahorro WHERE socio_id = '".$socio_id['socio_id']."'";
		$dato_ncuenta_socio = $object->selquery($q_cuenta_socio);
		$dato_ncuenta_socio = $dato_ncuenta_socio[0];	
		
		$q_aportacion = "INSERT aportacion (aportacion_cantidad, cuenta_id) VALUES('".addslashes($socio_aportacion)."','".$dato_ncuenta_socio['cuenta_id']."')";
		$insert_aportacion = $object->insquery($q_aportacion);	
		
		$cuota = 0;
		switch ($pago_membresia){case '150':$cuota = 1;break;case '75':$cuota = 2;break;case '50':$cuota = 3;break;case '37.5':$cuota = 4;break;}
		
		$q_membresia  = "INSERT INTO membresia (membresia_plan_pago, membresia_abono, socio_id) VALUES ('$cuota','".addslashes($pago_membresia)."','".$socio_id['socio_id']."')";
		$insert_membresia = $object->insquery($q_membresia);	
		
/*		$q_solicitud = "UPDATE socio SET cuenta_id = (SELECT MAX(cuenta_numero) FROM ahorro) WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud); */
		
		$date = date("Y-m-d");
		$q_operacion = "INSERT INTO operacion (operacion_fecha, socio_id, cuenta_ahorro, usuario_id, tipo_operacion, operacion_monto, solicitud_id) VALUES ('$date','".$socio_id['socio_id']."',(SELECT cuenta_numero FROM ahorro WHERE socio_id = '".$socio_id['socio_id']."'), " . $datos_usuario['usuario_id'] . ",'Membresia','".addslashes($pago_membresia)."',".$solicitud_id.")";
		$nueva_operacion = $object->insquery($q_operacion);	
	
		$q_usuario = "INSERT INTO beneficiario (bene_nombre1, bene_nombre2, bene_apellido1, bene_apellido2, bene_porcentaje, bene_telefono, socio_id) VALUES ('".addslashes($beneficiario_nombre1)."','".addslashes($beneficiario_nombre2)."','".addslashes($beneficiario_apellido1)."','".addslashes($beneficiario_apellido2)."','".addslashes($beneficiario_porcentaje)."','".addslashes($beneficiario_telefono)."','".$socio_id['socio_id']."' )";
		$usuario_id = $object->insquery($q_usuario);
		
		$q_socio = "UPDATE socio SET socio_estado = 'Activo' WHERE socio_id = ".$socio_id['socio_id'];
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
		
		var socio_aportacion = document.getElementById('socio_aportacion');
		var socio_plan_pago = document.getElementById('pago_membresia');
		
		var formBeneficiario1 = document.getElementById('frmbeneficiario1');
		
		
		
		if(input_action.value=='operacion'){
		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
		
		}else if (input_action.value=='accept'){

		formBeneficiario1.appendChild(input_action);
		formBeneficiario1.appendChild(input_solicitud_id);
		formBeneficiario1.appendChild(socio_aportacion);
		formBeneficiario1.appendChild(socio_plan_pago);
		document.getElementsByTagName("body")[0].appendChild(formBeneficiario1);
		document.frmbeneficiario1.submit();
	
	}
		
		

		
		
	}
	
	function cantidad_benef(){

	beneficiarios= document.getElementById('cant_benef').options[document.getElementById('cant_benef').selectedIndex].value;
	
	if(beneficiarios==1){
		document.getElementById('frmbeneficiario1').style.display = '';
		document.getElementById('frmbeneficiario2').style.display = 'none';	
		document.getElementById('frmbeneficiario3').style.display = 'none';


	}else if(beneficiarios==2){

		document.getElementById('frmbeneficiario1').style.display = '';
		document.getElementById('frmbeneficiario2').style.display = '';	
		document.getElementById('frmbeneficiario3').style.display = 'none';

	}else if (beneficiarios==3){

		document.getElementById('frmbeneficiario1').style.display = '';
		document.getElementById('frmbeneficiario2').style.display = '';	
		document.getElementById('frmbeneficiario3').style.display = '';

	}
	
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
			<th align="center">Operación</th>
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
			<td align="center"><?php echo $val['operacion']?></td>
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
	}elseif($action == 'operacion'){
	?>
	
				<table>
				<tr class="fuente12_rojo">
					<td>Solicitud Creación Cuenta</td>
				</tr>

    	<table id="tabla_contenido">
            <tr>
                <td colspan="3"><span><b>DATOS PERSONALES</b></span></td>
                <td align="right"><a href="solicitudes_socio_pendientes.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
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
              <td>NIT</td>
              <td><input name="socio_nit" type="text" disabled="disabled" id="socio_nit" value="<?php echo $solicitud['socio_nit']?>" size="20" readonly="readonly"/></td>
            </tr>	
			<tr>
			<td>Salario</td>
			<td><input name="socio_salario" type="text" disabled="disabled" id="socio_salario" value="$ <?php echo $solicitud['socio_salario']?>" size="20" readonly="readonly"/></td>
			</tr>			
			<tr>
			<td>Aportacion Mensual</td>
			<td><input name="socio_aportacion" placeholder="$15.00" type="text" id="socio_aportacion" size="10" /></td>
			<td>Plan Pago Membresía</td>
			<td>
			  <select id="pago_membresia" name="pago_membresia">
			  <option value="150">Cuota $150.00</option>
			  <option value="75">2 Cuotas $75.00</option>
			  <option value="50">3 Cuotas $50.00</option>
			  <option value="37.5">4 Cuotas $37.50</option>
			  </select><td>
			</tr>
            <tr>
              <td>Beneficiarios</td>
              <td>
			  <select id="cant_benef" onchange="cantidad_benef();">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  </select></td>
            </tr>             
        </table>
		        </table>
<hr>		

	
	<?php
	}
	?>
	
	<form style="display:none;"  method="POST" id="frmbeneficiario1" name="frmbeneficiario1">

		<table id="tabla_contenido">
		<tr>		
		<td class="fuente12_rojo">Datos Primer Beneficiario</td>		
		</tr>
		<tr>
		<td>Primer Nombre<td>
		<td><input name="beneficiario_nombre1" type="text" id="beneficiario_nombre1"/></td>		
		<td>Segundo Nombre<td>
		<td><input name="beneficiario_nombre2" type="text" id="beneficiario_nombre2"/></td>
		</tr>
		<tr>
		<td>Primer Apellido<td>
		<td><input name="beneficiario_apellido1" type="text" id="beneficiario_apellido1"/></td>		
		<td>Segundo Apellido<td>
		<td><input name="beneficiario_apellido2" type="text" id="beneficiario_apellido2"/></td>
		</tr>
		<tr>
		<td>Porcentaje Beneficiario<td>
		<td><input name="beneficiario_porcentaje" type="text" id="beneficiario_porcentaje" size="5"/></td>
		<td>Beneficiario Tel&eacute;fono<td>
		<td><input name="beneficiario_telefono" type="text" id="beneficiario_telefono"/></td>
		</tr>
		</table>

	</form>
<hr>
	<form style="display:none;" method="POST" id="frmbeneficiario2">
		<table id="tabla_contenido">
		<tr>		
		<td class="fuente12_rojo">Datos Segundo Beneficiario</td>		
		</tr>
		<tr>
		<td>Primer Nombre<td>
		<td><input name="2beneficiario_nombre1" type="text" id="2beneficiario_nombre1"/></td>		
		<td>Segundo Nombre<td>
		<td><input name="2beneficiario_nombre2" type="text" id="2beneficiario_nombre2"/></td>
		</tr>
		<tr>
		<td>Primer Apellido<td>
		<td><input name="2beneficiario_apellido1" type="text" id="2beneficiario_apellido1"/></td>		
		<td>Segundo Apellido<td>
		<td><input name="2beneficiario_apellido2" type="text" id="2beneficiario_apellido2"/></td>
		</tr>
		<tr>
		<td>Porcentaje Beneficiario<td>
		<td><input name="2beneficiario_porcentaje" type="text" id="2beneficiario_porcentaje" size="5"/></td>
		<td>Beneficiario Tel&eacute;fono<td>
		<td><input name="2beneficiario_telefono" type="text" id="2beneficiario_telefono"/></td>
		</tr>
		</table>
	</form>
<hr>
	<form  style="display:none;" method="POST" id="frmbeneficiario3">
		<table id="tabla_contenido">
		<tr>		
		<td class="fuente12_rojo">Datos Tercer Beneficiario</td>		
		</tr>
		<tr>
		<td>Primer Nombre<td>
		<td><input name="3beneficiario_nombre1" type="text" id="3beneficiario_nombre1"/></td>		
		<td>Segundo Nombre<td>
		<td><input name="3beneficiario_nombre2" type="text" id="3beneficiario_nombre2"/></td>
		</tr>
		<tr>
		<td>Primer Apellido<td>
		<td><input name="3beneficiario_apellido1" type="text" id="3beneficiario_apellido1"/></td>		
		<td>Segundo Apellido<td>
		<td><input name="3beneficiario_apellido2" type="text" id="3beneficiario_apellido2"/></td>
		</tr>
		<tr>
		<td>Porcentaje Beneficiario<td>
		<td><input name="3beneficiario_porcentaje" type="text" id="3beneficiario_porcentaje" size="5"/></td>
		<td>Beneficiario Tel&eacute;fono<td>
		<td><input name="3beneficiario_telefono" type="text" id="3beneficiario_telefono"/></td>
		</tr>
		</table>
		</form>
             <?php echo $action_bar?>


  	<!-- InstanceEndEditable -->
  </div>
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->