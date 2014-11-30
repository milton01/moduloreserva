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
	$_SESSION['app_id'] = 25;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
		$action_bar = "<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'detail\', ', so.socio_id,', ', sd.solicitud_id,');\" class=\"fuente10_negro\"><img src=\"../images/icon_search.png\" title=\"Detalle solicitud\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td></tr></table>";
		$q_solicitudes = "SELECT so.socio_id, CONCAT(so.socio_nombre1,' ',so.socio_nombre2,' ',so.socio_apellido1,' ',so.socio_apellido2) AS nombre_completo,sd.solicitud_id,sd.tipo_soli_id,ts.tipo_soli_nombre,sd.solicitud_fecha, sd.solicitud_estado,  CONCAT('".$action_bar."', '') AS detalle FROM solicitud sd INNER JOIN solicitud_socio ss ON ss.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_nombre = 'Solicitud Prestamo' INNER JOIN socio so ON so.socio_id = ss.socio_id WHERE sd.solicitud_estado = 1  LIMIT 2 ";
		$solicitudes = $object->selquery($q_solicitudes);
	}elseif($action == 'detail'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept','' ,".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Aprobar usuario <img src=\"../images/accept.png\" title=\"Aprobar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$socio_id."); \" style=\"text-decoration:none;\" class=\"reject\">Rechazar usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
		$q_solicitud = "SELECT so.socio_id, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, ap.aportacion_cantidad,  so.socio_salario, so.socio_estado,  sd.solicitud_fecha FROM socio so INNER JOIN solicitud sd ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = 1 INNER JOIN ahorro ao ON ao.socio_id = so.solicitud_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id WHERE so.socio_id = '".$socio_id."'";
		$solicitud = $object->selquery($q_solicitud);
		$solicitud = $solicitud[0];
		
		$q_prestamo= "SELECT pd.prestamo_numero, pd.prestamo_cuota, pd.prestamo_plazo, pd.prestamo_interes, pd.prestamo_monto,pd.prestamo_tpagar,pd.prestamo_observacion FROM prestamo pd INNER JOIN solicitud_socio ss ON ss.solicitud_id = pd.solicitud_id WHERE ss.socio_id = ".$socio_id." AND pd.solicitud_id = ".$solicitud_id."";
		$prestamo = $object->selquery($q_prestamo);
		$prestamo = $prestamo[0];
		
	}elseif($action == 'accept'){
		
		$q_solicitud = "UPDATE solicitud SET solicitud_estado = 2 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);

		}elseif($action == 'reject'){
		$q_solicitud = "UPDATE solicitud SET solicitud_estado = 3 WHERE solicitud_id = ".$solicitud_id;
		$update_solicitud = $object->updquery($q_solicitud);
		$object->redireccionURL();
	}
    ?>
    <script>
	function sndForm(action, socio_id, solicitud_id){
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
		input_solicitud_id.setAttribute("value", socio_id);
			
		var sele_solicitud_id = document.createElement("input");
		sele_solicitud_id.setAttribute("name", "solicitud_id");
		sele_solicitud_id.setAttribute("type", "hidden");
		sele_solicitud_id.setAttribute("value", solicitud_id);	
		
		form.appendChild(input_action);
		form.appendChild(input_solicitud_id);
		form.appendChild(sele_solicitud_id);
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
	}
	</script>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="titulo_reporte">Generación de Reportes Según Periodo</div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none' && count($solicitudes) > 0){
	?>
    <form autocomplete="off">
       <table id="tabla_contenido">
	   <tr><td>Seleccione Reporte</td>
			<td><select id="reporte_tipo">
				<option value="1">Transacciones Periodo<option>
				<option value="2">Solicitudes Socio<option>
				<option value="3">Solicitudes Prestamo<option>
				<option value="4">Solicitudes Retiro Socio<option>
				<option value="5">Solicitudes Retiro de Ahorro<option>
				</select>
				</td>
	   </tr>
		<tr><td>Desde</td> 
			<td><input type="text" id="desde"/></td>
		</tr>
		<tr>
		<td>Hasta</td> 
		<td><input type="text" id="hasta"/></td>
		</tr>
		<tr>
		<td><a  onclick="parent.location='inicio_operador.php'"  href="../resources/excel/operaciones.php"  style="text-decoration:none;">Generar Excel <img alt="ingresar" src="../images/excel_icon.png"/></a></td>
		<td><a  onclick="parent.location='inicio_operador.php'"  href="../resources/excel/operaciones.php"  style="text-decoration:none;">Generar PDF <img alt="ingresar" src="../images/img_pdf.png"/></a></td>
		</tr>
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
	<table>
				<tr class="fuente12_rojo">
					<td></td>
				</tr>
			<form id="datos" method="post" autocomplete="off">
    	<table id="tabla_contenido">
            <tr>
                <td colspan="3"  class="fuente12_rojo">DATOS PERSONALES</td>
                <td align="right"><a href="validacion_prestamo.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
       
		   </tr>
           
            <tr>
            	<td>Primer Nombre</td>
                <td><input name="socio_nombre1" type="text" disabled="disabled" id="socio_nombre1" value="<?php echo $solicitud['nombre_completo']?>" size="45" readonly="readonly"/></td>
            </tr>
			      <tr>
        <td>Sueldo</td>
        <td><input disabled="disabled"  class=":alpha :only_on_submit vanadium-invalid"  disabled="disabled" name="socio_sueldo" type="text" id="socio_sueldo" value="<?php echo $solicitud['socio_salario']?>" readonly="readonly"  size="5"/></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td><input disabled="disabled" class=":required :only_on_submit vanadium-invalid" value ="<?php echo $solicitud['socio_estado']?>" name="socio_estado" type="text" id="socio_estado" size="5"/></td>
      </tr>
      <tr>
        <td>Fecha de Ingreso</td>
        <td><input disabled="disabled" class=":required :only_on_submit vanadium-invalid" value="<?php echo $solicitud['solicitud_fecha']?>" name="socio_fecha_ingreso" type="text" id="socio_fecha_ingreso" size="20"/></td>
      </tr>
       <tr>
        <td>Aportacion</td>
        <td><input disabled="disabled" name="ahorro_socio_acumulado" value="<?php echo $solicitud['aportacion_cantidad'] ?>" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>Ahorros</td>
        <td><input disabled="disabled" name="ahorro_socio_acumulado" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  </table>
	  </form>
	  <table id="tabla_contenido">
	  <form id="formSolicitudPrestamo">
      <tr>
        <td colspan="2"  class="fuente12_rojo">Informacion de Solicitud</td>
      </tr>
      <tr>
        <td>Cantidad Solicitada</td>
        <td><input disabled="disabled" name="cantidad_solicitar" value="<?php echo $prestamo['prestamo_monto']?>" type="text" id="cantidad_solicitar" size="10"/></td>
      </tr>
      <tr>
        <td>Plazo</td>
        <td>
		<input disabled="disabled" type="text"  value="<?php echo $prestamo['prestamo_plazo']?>" name="prestamo_cuota" id="prestamo_cuota">
		</td>
      </tr>
      <tr>
        <td>Inter&eacute;s %</td>
        <td><input disabled="disabled" name="prestamo_interes"  value="<?php echo $prestamo['prestamo_interes']?>" id="prestamo_interes" onblur="calculoPago();" type="text" size="4"/>
		Cuota de Plazo
		<input disabled="disabled" name="plazo"  value="<?php echo $prestamo['prestamo_plazo']?>" id="plazo" type="text" size="5"/>
		 </td>
        <td></td>
      </tr>
      <tr>
        <td>Total a Pagar</td>
        <td><input disabled="disabled"  value="<?php echo $prestamo['prestamo_tpagar']?>"  class="required" name="prestamo_tpagar" id="prestamo_tpagar" type="text" size="10"/></td>
      </tr>
      <tr>
        <td height="62">Observaciones</td>
        <td><textarea disabled="disabled" class=":required :only_on_submit vanadium-invalid" name="prestamo_observacion" id="prestamo_observacion" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"><?php echo $prestamo['prestamo_observacion']?></textarea></td>
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
  	<!-- InstanceEndEditable -->
  </div>
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->