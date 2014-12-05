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
	
    //include('log.php');
	
	$action = ($_POST['action'] == '')? 'none': $_POST['action'];
	$reserva_id = ($_POST['reserva_id'] == '')? 0: $_POST['reserva_id'];
	$reserva_estado = ($_POST['reserva_estado'] == '')? '': $_POST['reserva_estado'];
	
	//echo $checkbox.'<br>';
	//echo $action.'<br>';
	
    if($action == 'actualizar'){
        $estado = $reserva_estado == "2" ? "2" : "3";
        $update = "UPDATE decameron_reservacion SET estado = ".$estado." WHERE id_reservacion = ".$reserva_id;
        $object->updquery($update);
        $object->redireccionURL();
    }


	$query = "SELECT r.id_reservacion,r.fecha_reservacion,r.fecha_desde,r.fecha_hasta,r.estado, h.numero_piso,h.numero_habitacion,
            c.num_personas, p.first_name, p.last_name, e.nombre AS 'edificio'
            FROM decameron.decameron_reservacion as r
            INNER JOIN decameron_habitacion AS h ON r.id_habitacion = h.id_habitacion
            INNER JOIN decameron_habitacion_capacidad AS c ON h.id_habitacion_capacidad = c.id_habitacion_capacidad
            INNER JOIN decameron_people AS p ON r.id_people = p.person_id
            INNER JOIN decameron_edificio AS e ON h.id_edificio = e.id_edificio

            WHERE r.estado <> 3 ;";


	$datos_reservas = $object->selquery($query);
		
	?>
	<script type="text/javascript">
	
	function sndForm(id,estado){
		var form = document.createElement("form");
		form.setAttribute("name", "formulario");
		form.setAttribute("action", "");
		form.setAttribute("method", "post");
		
		var input_action = document.createElement("input");
		input_action.setAttribute("name", "action");
		input_action.setAttribute("type", "hidden");
		input_action.setAttribute("value", "actualizar");
		
        var input_reserva_id = document.createElement("input");
        input_reserva_id.setAttribute("name", "reserva_id");
        input_reserva_id.setAttribute("type", "hidden");
        input_reserva_id.setAttribute("value", id);

		var input_reserva_estado = document.createElement("input");
		input_reserva_estado.setAttribute("name", "reserva_estado");
        input_reserva_estado.setAttribute("type", "hidden");
        input_reserva_estado.setAttribute("value", estado);
        
		form.appendChild(input_action);
        form.appendChild(input_reserva_id);
		form.appendChild(input_reserva_estado);
		
		document.getElementsByTagName("body")[0].appendChild(form);
		document.formulario.submit();
	}
	
	
	</script>
    <div id="content">
	<!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <div class="titulo_reporte">Reservas realizadas</div>
        <?php
        //$object->permisoApp($permiso_app);
        
        if($action == 'none' && count($datos_reservas) > 0){
            //$object->getReport($datos_reservas);
        ?>
        <table id="tabla_reporte">
            <tr>
                <th width="150">Desde</th>
                <th width="100">Hasta</th>
                <th width="100">Estado</th>
                <th width="100">Habitaci&oacute;n</th>
                <th width="150">Nombre</th>
                <th width="150">Apellido</th>
                <th width="100" align="center"> Acci&oacute;n </th>
            </tr>
            <?php
            foreach($datos_reservas as $key => $val){
            ?>
            <tr>
                <td><?php echo $val['fecha_desde'];?></td>
                <td><?php echo $val['fecha_hasta'];?></td>
                <td><?php echo ($val['estado']=="1" ? "Pendiente" : "En estad&iacute;a" );?></td>
                <td><?php echo $val['edificio']." piso ".$val['numero_piso']." #".$val['numero_habitacion'];?></td>
                <td><?php echo $val['first_name'];?></td>
                <td><?php echo $val['last_name'];?></td>
              <td align="center">
                <?php if($val['estado']=="1"){ ?>
                    <a href="javascript:sndForm(<?php echo $val['id_reservacion']; ?>,2);" title="Proceder la checkin"><img width="24" height="24" src="../images/get_in.png"></a>
                <?php }else{ ?>
                    <a href="javascript:sndForm(<?php echo $val['id_reservacion']; ?>,3);" title="Proceder la checkout"><img width="24" height="24" src="../images/get_out.png"></a>
                <?php }  ?>
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
                <td>No se encontraron registros para mostrar</td>
            </tr>
        </table>
        <?php 
        } 
        ?>

	</div>
    <?php
    include('footer.php');
	?>
</div>