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
    $_SESSION['app_id'] = 4;
    include('log.php');

    $action = ($_POST['action'] == '') ? 'none' : $_POST['action'];
    $perfil_id = ($_POST['perfil_id'] == '') ? 0 : $_POST['perfil_id'];
    $perfil_nombre = ($_POST['perfil_nombre'] == '') ? '' : $_POST['perfil_nombre'];
    $perfil_estado = ($_POST['perfil_estado'] == '') ? 0 : $_POST['perfil_estado'];

    if ($action == 'none') {

        $action_bar = "<table class=\"fuente08_negro\"><tr><td width=\"20\"><a href=\"javascript:sndForm(\'update\', ', perfil_id, '); \"><img src=\"../images/icon_edit.png\" title=\"Modificar perfil\" style=\"border:none;\"></a></td></tr></table>";
        $add1 = "<form name=\"frm1\" method=\"post\" action=\"administrador_perfiles.php\"><input type=\"hidden\" name=\"action\" id=\"action\" value=\"insert\"><input type=\"image\" src=\"../images/icon_add.png\"></form>";

        $query = "SELECT perfil_id, perfil_nombre, perfil_estado, CONCAT('" . $action_bar . "', '') AS accion FROM perfiles ORDER BY perfil_id";
        $datos_perfiles = $object->selquery($query);
    } elseif ($action == 'update') {

        $query = "SELECT perfil_id, perfil_nombre, perfil_estado, CONCAT('" . $action_bar . "', '') AS accion FROM perfiles WHERE perfil_id='" . $perfil_id . "'";
        $datos_perfil = $object->selquery($query);
        $datos_perfil = $datos_perfil[0];
    } elseif ($action == 'actualizar') {
        $query = "UPDATE perfiles SET perfil_nombre='" . $perfil_nombre . "', perfil_estado=" . $perfil_estado . " WHERE perfil_id='" . $perfil_id . "'";
        $upd = $object->updquery($query);
        $object->redireccionURL();
    } elseif ($action == 'insertar') {
        $query = "INSERT INTO perfiles (perfil_nombre, perfil_estado) VALUES('" . $perfil_nombre . "', " . $perfil_estado . ")";
        $inser = $object->insquery($query);
        $object->redireccionURL();
    }
    ?>
    <script type="text/javascript">
        function chngEstado(){
            var myParams = (chngEstado.arguments);
            var nP = ((parseInt(myParams.length) < 1)?'':myParams[0]);
            var tParams = (Base64.encode(myParams[0] + '::' + myParams[1]).split('=').join('~'));
            $.ajax({
                type: "POST",
                url: "consultas_jquery.php",
                async:true,
                data: ("step=1&params="+tParams),
                success: function(datos){
                    alert('Cambio de estado satisfactorio1');
                }
            });
        }


        function sndForm(action, perfil_id){
            var form = document.createElement("form");
            form.setAttribute("name", "formulario");
            form.setAttribute("action", "");
            form.setAttribute("method", "post");

            var input_action = document.createElement("input");
            input_action.setAttribute("name", "action");
            input_action.setAttribute("type", "hidden");
            input_action.setAttribute("value", action);

            var input_perfil_id = document.createElement("input");
            input_perfil_id.setAttribute("name", "perfil_id");
            input_perfil_id.setAttribute("type", "hidden");
            input_perfil_id.setAttribute("value", perfil_id);

            form.appendChild(input_action);
            form.appendChild(input_perfil_id);

            document.getElementsByTagName("body")[0].appendChild(form);
            document.formulario.submit();
        }
    </script>
    <div id="content">
        <!--Ralarcon[17052012] Inicio: Agrega el estilo a las tablas-->
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!--Ralarcon[17052012] Fin: Agrega el estilo a las tablas-->

        <div class="titulo_reporte">Administrador de Perfiles</div>
<?php
$object->permisoApp($permiso_app);

if ($action == 'none' && count($datos_perfiles) > 0) {
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
        <?php
        include('footer.php');
        ?>
</div>