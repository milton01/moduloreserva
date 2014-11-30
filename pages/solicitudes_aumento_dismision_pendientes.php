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
	$_SESSION['app_id'] = 21;
	include('log.php');
  	extract($_POST);
	$action = ($action == '')? 'none': $action;

		$action_ope ="<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'operacion\', ', sd.solicitud_id, ');\" class=\"fuente10_negro\"><img src=\"../images/accept.png\" title=\"Accion solicitud\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td></tr></table>";
		$q_solicitudes = "SELECT sd.solicitud_id, CONCAT(so.socio_nombre1, ' ', so.socio_nombre2, ' ', so.socio_apellido1, ' ', so.socio_apellido2) AS nombre_completo, sd.solicitud_fecha, ts.tipo_soli_nombre, sd.solicitud_estado, so.socio_salario, CONCAT('".$action_bar."', '') AS detalle, CONCAT('".$action_ope."', '') AS operacion FROM solicitud sd INNER JOIN socio so ON so.solicitud_id = sd.solicitud_id INNER JOIN tipo_solicitud ts ON ts.tipo_soli_id = sd.tipo_soli_id WHERE so.socio_estado = 'Inactivo' ORDER BY sd.solicitud_id";
		$solicitudes = $object->selquery($q_solicitudes);


  ?>
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <div class="fuente12_rojo">   Solicitud Pendiente Aumento y Disminucion de Couta </div>
  	<!-- InstanceEndEditable -->
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
            <td align="center">Aumento de Cuota</td>
            <td align="center"><?php echo $val['solicitud_estado']?></td>
			<td align="center"><?php echo $val['operacion']?></td>
          </tr>
          <?php
		  }
		  ?>
	  </table>
    </form>
	
	</div>
	   
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->