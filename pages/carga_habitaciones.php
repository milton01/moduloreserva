<?php
/**
 * @author Decameron
 * @copyright 2014
 */
session_start();
?>
<div id="wrapper">
    
    <?php
    include('header.php');
    include('menu_reserva.php');

	$date       = date("Y-m-d");
	$anos       = 18;
	$periodo    = date("Y-m-d", strtotime("$fecha -$anos year"));
        extract($_POST);
	
        $action             = ($action == '') ? 'none' : $action;
        $id_tipo_habitacion = ($_POST['id_tipo_habitacion'] == '') ? 0 : $_POST['id_tipo_habitacion'];
        $precio             = ($_POST['Precio'] == '') ? 0 : $_POST['Precio'];
        
	if($action == 'none'){
            
            $fecha1 = $_SESSION['fecha_entrada'];
            $fecha2 = $_SESSION['fecha_salida'];
            $numPersonas = $_SESSION['numPersonas'];
            
            $action_bar = "<table class=\"fuente08_negro\">"
                    . "<tr>"
                    . "<td width=\"20\">"
                    . "<a href=\"javascript:sndForm(\'sendReserva\', ', habitaciones.id_tipo_habitacion, ', ', habitaciones.Precio, '); \">"
                    . "<img src=\"../images/do.png\" title=\"Realizar Reserva\" style=\"border:none;\">"
                    . "</a>"
                    . "</td>"
                    . "</tr>"
                    . "</table>";
            
            $query = " select"
                    . " habitaciones.id_tipo_habitacion,"
                    . " habitaciones.nombre,"
                    . " habitaciones.descripcion,"
                    . " habitaciones.description,"
                    . " habitaciones.Precio,"
                    . " concat('".$action_bar."', '') as accion from ( "
                    . "     select th.id_tipo_habitacion, th.nombre, th.descripcion, cpp.description, "
                    . "     cpp.value * (select cpf.costo_base from decameron.decameron_costo_por_fecha cpf "
                    . "     where cpf.fecha_desde <= str_to_date('".$fecha1."', '%Y-%m-%d') "
                    . "     and cpf.fecha_hasta >= str_to_date('".$fecha2."', '%Y-%m-%d')) Precio "
                    . "     from decameron.decameron_tipo_habitacion th inner join decameron.decameron_costo_por_num_personas cpp "
                    . "     on th.id_tipo_habitacion = cpp.id_tipo_habitacion where cpp.vkey = '".$numPersonas."' "
                    . ") habitaciones";
                      
            $datos_habitaciones = $object->selquery($query);

            $query2 = "select description from decameron.decameron_costo_por_num_personas  where vkey = '".$numPersonas."' limit 1";
            $dato_persona = $object->selquery($query2);

            
        }else  if ($action == 'sendReserva') {
            session_start();
            
            $_SESSION['tipo_habitacion'] = $id_tipo_habitacion;
            $_SESSION['precio'] = $precio;
            
            echo "<script>window.location = 'crea_reserva.php'</script>";
            header('Location: crea_reserva.php');
	}
    ?>
	<script type="text/javascript">

             function sndForm(action, id_tipo_habitacion, Precio){
                var form = document.createElement("form");
                form.setAttribute("name", "formulario");
                form.setAttribute("action", "");
                form.setAttribute("method", "post");

                var input_action = document.createElement("input");
                input_action.setAttribute("name", "action");
                input_action.setAttribute("type", "hidden");
                input_action.setAttribute("value", action);

                var input_id_tipo_habitacion = document.createElement("input");
                input_id_tipo_habitacion.setAttribute("name", "id_tipo_habitacion");
                input_id_tipo_habitacion.setAttribute("type", "hidden");
                input_id_tipo_habitacion.setAttribute("value", id_tipo_habitacion);
                
                var input_Precio = document.createElement("input");
                input_Precio.setAttribute("name", "Precio");
                input_Precio.setAttribute("type", "hidden");
                input_Precio.setAttribute("value", Precio);
                
                form.appendChild(input_action);
                form.appendChild(input_id_tipo_habitacion);
                form.appendChild(input_Precio);

                document.getElementsByTagName("body")[0].appendChild(form);
                document.formulario.submit();
            }
		
	</script>
    <!-- InstanceEndEditable -->
    <div id="content">
        <br>
        <table>
            <tr align="left">
                <th class="fuente12b_negro" width="1%">Pais: </th>
                <th class="fuente10_negro" width="10%">El salvador</th>
                <th class="fuente12b_negro" width="1%">Ciudad: </th>
                <th class="fuente10_negro" width="20%">El Salvador, San Salvador</th>
                <th class="fuente12b_negro" width="1%">Hotel: </th>
                <th class="fuente10_negro" width="10%">Royal Decameron</th>
            </tr>
            <tr></tr>
            <tr align="left">
                <td class="fuente12b_negro" width="10%">Fecha Entrada: </td>
                <td class="fuente10_negro" width="10%"><?php echo $fecha1 ?></td>
                <td class="fuente12b_negro" width="10%">Fecha Salida: </td>
                <td class="fuente10_negro" width="10%"><?php echo $fecha2 ?></td>
                <td class="fuente12b_negro" width="10%"># Personas: </td>
                <td class="fuente10_negro" width="10%"><?php foreach ($dato_persona as $key => $val) { echo $val['description']; } ?></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <div class="titulo_reporte">Tipo de Habitacion</div>
        <?php
            if (count($datos_habitaciones) > 0) {
        ?>
        <form id="formHabitaciones" method="POST">
                    <table width="" id="tabla_reporte">
                        <tr>
                            <th width="5%">Id</th>
                            <th width="15%">Habitacion</th>
                            <th width="60%">Descripcion</th>
                            <th width="25%">Numero Personas</th>
                            <th width="25%">Precio</th>
                            <th></th>
                        </tr>
                        <?php
                            foreach ($datos_habitaciones as $key => $val) {
                        ?>
                        <tr id="tr1">
                            <td><?php echo $val['id_tipo_habitacion']; ?></td>
                            <td><?php echo $val['nombre']; ?></td>
                            <td><?php echo $val['descripcion']; ?></td>
                            <td><?php echo $val['description']; ?></td>
                            <td><?php echo $val['Precio']; ?></td>
                            <td align="center"><?php echo $val['accion']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </form>
		<?php
		}else if($action == 'ingresar'){
		?>
		<table>
                    <tr class="fuente12_rojo">
                        <td>Ingresado Exitosamente</td>
                    </tr>
                </table>
		<?php
		}
		?>
        <!-- InstanceEndEditable -->
    </div>
    <?php
    include('footer.php');
    ?>
</div><!-- InstanceEnd -->