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
	$_SESSION['app_id'] = 15;
	include('log.php');
	
	extract($_POST);
	$action = ($action == '')? 'none': $action;
	if($action == 'none'){
	
	}elseif($action == 'operacion'){
		$action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Enviar Solicitud<img src=\"../images/accept.png\" title=\"Solicitar Creacion Cuenta\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Eliminar Solicitud Usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
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
    <!-- InstanceBeginEditable name="Content" --> <div class="fuente12_rojo"> Solicitud Amento Couta	</div>
    <div class="titulo_reporte"></div>
    <?php
	$object->permisoApp($permiso_app);
	?>
	<?php
    if($action == 'none'){
	?>
    <form autocomplete="off">
   <font color="black" > Id de Socio <font>
   <table>
 <input class=":integer :required :max_length;10 vanadium-invalid" name="socio_id" type="text" id="socio_id" size="5"/>
 <input type="button" value="Consultar" onclick="sndForm('operacion');"/>
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
	    <form autocomplete="off">
   <font color="black" > Id de Socio <font>
   <table>
 <input class=":integer :required :max_length;10 vanadium-invalid"  value="<?php echo $solicitud['socio_id']?>" name="socio_id" type="text" id="socio_id" size="5"/>
 <input type="button" value="Consultar" onclick="sndForm('operacion');"/>
	</table>
</form>
				<table>
				<tr class="fuente12_rojo">
					<td></td>
				</tr>
			<form id="datos" method="post" autocomplete="off">
    	<table id="tabla_contenido">
            <tr>
                <td colspan="3"  class="fuente12_rojo">DATOS PERSONALES</td>
                <td align="right"><a href="Solicitud_Aumento_Disminucion_Cuota.php" style="text-decoration:none;">Regresar <img alt="Regresar" src="../images/back.png"/></a></td>
       
		   </tr>
           
			<td>Nombre</td>
            <td><input class=":required :only_on_submit vanadium-invalid" value="<?php echo $solicitud['nombre_completo']?>" name="socio_nombre_completo" type="text" id="socio_nombre_completo" size="40"/></td>
          </tr>
          <tr id="tr_hidden" style="display:none;">
            <td>Sueldo</td>
            <td><input class=":alpha :only_on_submit vanadium-invalid" name="socio_sueldo" type="text" id="socio_sueldo" size="15"/></td>
          </tr>
          <tr>
            <td>Estado</td>
            <td><input class=":required :only_on_submit vanadium-invalid" value="<?php echo $solicitud['socio_estado']?>" name="socio_estado" type="text" id="socio_estado" size="15"/></td>
          </tr>
          <tr>
            <td>Fecha de Ingreso</td>
            <td><input class=":required :only_on_submit vanadium-invalid"  value="<?php echo $solicitud['solicitud_fecha']?>"name="socio_fecha_ingreso" type="text" id="socio_fecha_ingreso" size="20"/></td>
          </tr>
          <tr>
        <td>Aportacion</td>
        <td><input name="ahorro_socio_acumulado" value="<?php echo $solicitud['aportacion_cantidad'] ?>" type="text" id="ahorro_socio_acumulado" size="10" class=":date :only_on_submit vanadium-invalid"/></td>
      </tr>
          <tr>
            <td>Cuota Actual </td>
            <td><input class=":required :only_on_submit vanadium-invalid" name="aportaciones_socio_acumulado" type="text" id="aportaciones_socio_acumulado" size="15"/></td>
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
            <td colspan="2">Informacion de Préstamo ACtual</td>
          </tr>
          <tr>
            <td>Cantidad Solicitada</td>
            <td><input name="cantidad_solicitar" type="text" id="cantidad_solicitar" size="15"/></td>
          </tr>
          <tr>
            <td>Plazo Actual</td>
            <td><input name="Plazo" id="Plazo" type="text" size="15"/></td>
          </tr>
          <tr>
            <td>Cuota de Plazo Actual</td>
            <td><input name="cuota_plazo" id="cuota_plazo" type="text" size="15"/></td>
          </tr>
		<tr>
            <td>Plazo Nuevo</td>
            <td><input name="Plazo" id="Plazo" type="text" size="15"/></td>
          </tr>
          <tr>
            <td>Cuota de Plazo Nueva</td>
            <td><input name="cuota_plazo" id="cuota_plazo" type="text" size="15"/></td>
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
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>Por medio de la presente quiero aumentar o disminuir </p>
<tr>
            <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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