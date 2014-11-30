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
    $_SESSION['app_id'] = 5;
    include('log.php');
	$date = date("Y-m-d");
	$anos= 18;
	$periodo = date("Y-m-d", strtotime("$fecha -$anos year"));
    extract($_POST);
	$action = ($action == '')? 'none': $action;	
	if($action == 'none'){
	
	}else  if ($action == 'ingresar') {
        $q_solicitud = "INSERT INTO solicitud (solicitud_estado, solicitud_fecha, tipo_soli_id, usuario_id, sucursal_id) VALUES (1, NOW(), 1, " . $datos_usuario['usuario_id'] . ", 1)";
        $solicitud_id = $object->insquery($q_solicitud);

        $q_insert = "INSERT INTO socio (socio_nombre1, socio_nombre2, socio_apellido1, socio_apellido2, socio_apellidoc, socio_fecha_nacimiento, socio_sexo, socio_salario, socio_direccion, socio_fecha_ingreso, socio_tel_casa, socio_tel_celular, socio_tel_oficina, socio_dui, socio_nit, socio_isss, socio_email, socio_estado, est_civil_id, usuario_id, solicitud_id) VALUES ('" . addslashes($socio_nombre1) . "', '" . addslashes($socio_nombre2) . "', '" . addslashes($socio_apellido1) . "', '" . addslashes($socio_apellido2) . "', '" . addslashes($socio_apellidoc) . "', '" . $socio_fecha_nacimiento . "', '" . $socio_sexo . "', '" . $socio_salario . "', '" . addslashes($socio_direccion) . "', NOW(), '" . $socio_tel_casa . "', '" . $socio_tel_celular . "', '" . $socio_tel_oficina . "', '" . $socio_dui . "', '" . $socio_nit . "', '" . $socio_isss . "', '" . $socio_email . "', 1, " . $est_civil_id . ", 0, " . $solicitud_id . ")";
        $socio_id = $object->insquery($q_insert);
    }
    ?>
    <!-- InstanceEndEditable -->
    <div id="content">
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Solicitud Ingreso Socio</div>
        <?php
        $object->permisoApp($permiso_app);
        ?>
		<?php
		if($action == 'none'){
		?>
        <form id="frmSocio" class="formular" method="post" autocomplete="off">
            <table id="tabla_contenido">
                <tr>
                    <th colspan="4">DATOS PERSONALES</th>
                </tr>
                <tr>
                    <td width="150">Sexo</td>
                    <td width="175"><input type="radio" name="socio_sexo" id="socio_sexo_m" value="M" checked/>Masculino<input type="radio" name="socio_sexo" id="socio_sexo_f" value="F"/>Femenino</td>
                    <td width="150">Estado Civil</td>
                    <td width="175">
                        <?php
                        $estados_civiles = $object->selquery("SELECT est_civil_id, est_civil_nombre FROM estado_civil ORDER BY est_civil_nombre");
                        $est_civil_id = ($est_civil_id == '') ? 1 : $est_civil_id;
                        echo '<select id="est_civil_id" name="est_civil_id">';
                        foreach ($estados_civiles as $key => $val) {
                            echo '<option value="' . $val['est_civil_id'] . '" ' . (($val['est_civil_id'] == $est_civil_id) ? 'selected' : '') . '>' . $val['est_civil_nombre'] . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Primer Nombre</td>
                    <td><input class="validate[required] text-input" name="socio_nombre1" type="text" id="socio_nombre1" size="25"/></td>
                    <td>Segundo Nombre</td>
                    <td><input class="validate[required] text-input"  name="socio_nombre2" type="text" id="socio_nombre2" size="25"/></td>
                </tr>
                <tr>
                    <td>Primer Apellido</td>
                    <td><input class="validate[required] text-input" name="socio_apellido1" type="text" id="socio_apellido1" size="25"/></td>
                    <td>Segundo Apellido</td>
                    <td><input class="validate[required] text-input" name="socio_apellido2" type="text" id="socio_apellido2" size="25"/></td>
                </tr>
                <tr id="tr_hidden" style="display:none;">
                    <td>Apellido Casada</td>
                    <td><input class="" name="socio_apellidoc" type="text" id="socio_apellidoc" size="25"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>DUI</td>
                    <td><input class="validate[required] text-input" name="socio_dui" type="text" id="socio_dui" size="20"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>NIT</td>
                    <td><input class="validate[required] text-input" name="socio_nit" type="text" id="socio_nit" size="20"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>ISSS</td>
                    <td><input class="validate[required] text-input" name="socio_isss" type="text" id="socio_isss" size="20"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Fecha nacimiento</td>
                    <td><input name="socio_fecha_nacimiento" type="text" id="socio_fecha_nacimiento" size="20" class="validate[custom[date],past[<?php echo $periodo ?>]] text-input datepicker"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Sueldo</td>
                    <td><input name="socio_salario" type="text" id="socio_salario" size="20" class="validate[required,custom[number],min[1],max[50000]]" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="4">INFORMACION DE CONTACTO</th>
                </tr>
                <tr>
                    <td>Tel&eacute;fono casa</td>
                    <td><input name="socio_tel_casa" type="text" id="socio_tel_casa" size="20"/></td>
                </tr>
                <tr>
                    <td>Tel&eacute;fono celular</td>
                    <td colspan="3"><input name="socio_tel_celular" id="socio_tel_celular" type="text" size="20"/></td>
                </tr>
                <tr>
                    <td>Tel&eacute;fono oficina</td>
                    <td colspan="3"><input class="validate[required] text-input" name="socio_tel_oficina" id="socio_tel_oficina" type="text" size="20"/></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td colspan="3">   <input name="socio_email" type="text" id="email" size="36" class="validate[custom[email]] text-input" /></td>
                </tr>
                <tr>
                    <td>Direcci&oacute;n</td>
                    <td colspan="3"><textarea class="validate[required] text-input"  name="socio_direccion" id="socio_direccion" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" id="action" name="action" value="ingresar"/>
                        <input type="submit" id="submit" name="submit" class="submit" value="Ingresar Solicitud"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
		<?php
		}else if($action == 'ingresar'){
		?>
		<table>
        <tr class="fuente12_rojo">
        <td>Socio ingresado Exitosamente</td>
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