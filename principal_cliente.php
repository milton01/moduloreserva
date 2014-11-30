<?php

 /**
 * @author Codisola
 * @copyright 2012
 */

    require_once("core/Functions.php");
    $object = new Functions();

    @$action = $_POST['action'];
    @$usuario = $_POST['usuario'];
    @$clave = md5($_POST['clave']);

    $date = date("Y-m-d");
    $anos= 18;
    $periodo = date("Y-m-d", strtotime("$date -$anos year"));
    /*
    if(isset($_SESSION['islog']) && $_SESSION['islog'] == true){
            header("Location: pages/index.php");
    }

    if(isset($action) && $action == 'Ingresar'){
        $object->login_user($usuario,$clave);
    }*/

    extract($_POST);
    $action = ($action == '')? 'none': $action;
    if($action == 'none'){
            
            $query = "SELECT    th.id_tipo_habitacion, th.nombre, cpp.value precio, th.descripcion, cpp.key
                          FROM      decameron_tipo_habitacion th inner join decameron_costo_por_num_personas cpp on
                                    th.id_tipo_habitacion = cpp.id_tipo_habitacion
                          WHERE     cpp.key = '3 Adultos'
                                    order by 1";
            $datos_habitaciones = $object->selquery($query);
   
    }elseif($action == 'operacion'){
            $action_bar = "<table><tr><td><a href=\"javascript:sndForm('accept', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"accept\">Realizar reserva<img src=\"../images/accept.png\" title=\"Realizar reserva\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td><td><a href=\"javascript:sndForm('reject', ".$solicitud_id."); \" style=\"text-decoration:none;\" class=\"reject\">Eliminar Solicitud Usuario <img src=\"../images/icon_delete.png\" title=\"Rechazar usuario\" style=\"border:none;\" width=\"16\" height=\"16\"></a></td</tr></table>";
            $q_solicitud = "SELECT    th.id_tipo_habitacion, th.nombre, cpp.value precio, th.descripcion, cpp.key
                          FROM      decameron_tipo_habitacion th inner join decameron_costo_por_num_personas cpp on
                                    th.id_tipo_habitacion = cpp.id_tipo_habitacion
                          WHERE     cpp.key = '3 Adultos'
                                    order by 1";
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

<style>
/* CSS3 BUTTON */

.btn {
	display: inline-block;
	background: url(btn.bg.png) repeat-x 0px 0px;
	padding:5px 10px 6px 10px;
	font-weight:bold;
	text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
	border:1px solid rgba(0,0,0,0.4);
	-moz-border-radius: 5px;
	-moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
	-webkit-border-radius: 5px;
	-webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
}

.btn:hover {
	text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
	cursor:pointer;
}

/* COLOR VARIATIONS */

.blue		{background-color: #CCCCCC; color: #141414;}
.blue:hover	{background-color: #00c0ff; color: #ffffff;}

</style>

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

	
</script>

<link rel="stylesheet" href="resources/css/StyleMain.css" type="text/css" media="all"/>
<html>
    <head>
        <title>Login Usuario</title>
    </head>
    <body>
        <form method="post" autocomplete="off" id="formulario">
        <div align="center">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
<p><img src="images/banner1.png" width="592" height="150"></p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
            
            Origen: El Salvador, San Salvador <br><br>
            Hotel: San Salvador, Hotel Decameron <br><br>
            Fecha Entrada
            <input class=":required :alpha :only_on_submit vanadium-invalid ;adv" name="socio_id" type="text" id="socio_id" size="10"/>
            Fecha Salida
            <input class=":required :alpha :only_on_submit vanadium-invalid ;adv" name="socio_id" type="text" id="socio_id" size="10"/>
            Numero de Personas
            <select class="comboUno" name="station">
                	<option>---</option>
                        <option>1 Adulto</option>
                        <option>3 Adultos</option>
                        <option>2 Adultos 2 niños</option>
                        <option>2 Adultos 1 niño</option>
                        <option>3 Adultos 1 niño</option>
                        <option>2 Adultos</option>
                        <option>1 Adulto 4 niños</option>
                        <option>3 Adultos 2 niños</option>
                        <option>1 Adulto 3 niños</option>
                        <option>1 Adulto 2 niños</option>
                        <option>4 Adultos</option>
                        <option>1 Adulto 1 niño</option>
                        <option>4 Adultos 1 niño</option>
                        <option>2 Adultos 3 niños</option>
                </select>
            <input type="button" value="Buscar" onclick="sndForm('operacion');"/>

        </form>
            <div id="content">
        <!--Ralarcon[17052012] Inicio: Agrega el estilo a las tablas-->
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!--Ralarcon[17052012] Fin: Agrega el estilo a las tablas-->

        <div class="titulo_reporte">Administrador de Perfiles</div>
<?php
$object->permisoApp($permiso_app);

if ($action == 'none' && count($datos_habitaciones) > 0) {
    //$object->getReport($datos_usuarios);
    ?>
            <table id="tabla_reporte">
                <tr>
                    <th width="50" align="center">ID</th>
                    <th width="150" align="center">Nombre</th>
                    <th width="100" align="center">Estado</th>
                    <th width="100" align="center"><?php echo $add1 ?></th>
                </tr>
    <?php
    foreach ($datos_perfiles as $key => $val) {
        ?>
                    <tr>
                        <td><?php echo $val['perfil_id']; ?></td>
                        <td><?php echo $val['perfil_nombre']; ?></td>
                        <td align="center">
                            <select id="perfil_estado_<?php echo $val['usuario_id'] ?>" name="perfil_estado_<?php echo $val['perfil_id'] ?>" class="input_text" onChange="chngEstado(<?php echo $val['perfil_id'] ?>, this.value);">
        <?php
        $estados = $object->getEnumValues('perfiles', 'perfil_estado');
        foreach ($estados as $k => $v) {
            ?>
                                    <option value="<?php echo ($k + 1) ?>" <?php echo ($val['perfil_estado'] == $v) ? 'selected' : '' ?>><?php echo $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td align="center"><?php echo $val['accion']; ?></td>
                    </tr>
        <?php
    }
    ?>
            </table>
                <?php
            } elseif ($action == 'none') {
                ?>
            <table>
                <tr class="fuente12_rojo">
                    <td>No se encontraron perfiles a mostrar</td>
                </tr>
            </table>
    <?php
} elseif ($action == 'update') {
    ?>
            <form id="datos_usuario" method="post">
                <input type="hidden" name="perfil_id" id="perfil_id" value="<?php echo $datos_perfil['perfil_id'] ?>"/>
                <table>
                    <tr height="25">
                        <td colspan="2" class="fuente14b_negro" align="center" height="50" valign="top"><u>Datos del perfil</u></td>
                    </tr>
                    <tr height="25">
                        <td width="100" class="fuente12b_negro">ID</td>
                        <td width="200" class="fuente12_negro"><?php echo $datos_perfil['perfil_id'] ?></td>
                    </tr>
                    <tr height="25">
                        <td width="100" class="fuente12b_negro">Nombre</td>
                        <td width="200" class="fuente12_negro">
                            <input type="text" class="validate[required] text-input" id="perfil_nombre" name="perfil_nombre" class=":required :only_on_submit" value="<?php echo $datos_perfil['perfil_nombre'] ?>" style="width:200px"/>
                        </td>
                    </tr>
                    <tr height="25">
                        <td width="100" class="fuente12b_negro">Estado</td>
                        <td width="200" class="fuente12_negro">
                            <select id="perfil_estado" name="perfil_estado">
    <?php
    $estados = $object->getEnumValues('perfiles', 'perfil_estado');
    foreach ($estados as $k => $v) {
        ?>
                                    <option value="<?php echo ($k + 1) ?>" <?php echo ($datos_perfil['perfil_estado'] == $v) ? 'selected' : '' ?>><?php echo $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" colspan="2" valign="bottom" align="center" width="250">
                            <input type="submit" id="submit" name="submit" class=":submit" value="Actualizar"/>
                            <input type="hidden" id="action" name="action" value="actualizar"/>
                        </td>
                    </tr>
                </table>
            </form>
    <?php
} elseif ($action == 'insert') {
    ?>
            <form method="post">
                <table>
                    <tr height="25">
                        <td colspan="2" class="fuente14b_negro" align="center" height="50" valign="top"><u>Datos del perfil a agregar</u></td>
                    </tr>
                    <tr height="25">
                        <td width="100" class="fuente12b_negro">Nombre</td>
                        <td width="200" class="fuente12_negro">
                            <input type="text" id="perfil_nombre" name="perfil_nombre" class=":required :only_on_submit" style="width:200px"/>
                        </td>
                    </tr>
                    <tr height="25">
                        <td width="100" class="fuente12b_negro">Estado</td>
                        <td width="200" class="fuente12_negro">
                            <select id="perfil_estado" name="perfil_estado">
    <?php
    $estados = $object->getEnumValues('perfiles', 'perfil_estado');
    foreach ($estados as $k => $v) {
        ?>
                                    <option value="<?php echo ($k + 1) ?>" <?php echo ($datos_usuario['perfil_estado'] == $v) ? 'selected' : '' ?>><?php echo $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" colspan="2" valign="bottom" align="center" width="250">
                            <input type="submit" id="submit" name="submit" class=":submit" value="Guardar"/>
                            <input type="hidden" id="action" name="action" value="insertar"/>
                        </td>
                    </tr>
                </table>
            </form>
    <?php
}
?>
    </div>
    </body>
</html>