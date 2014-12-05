<!-- InstanceBegin template="/Templates/codisola.dwt.php" codeOutsideHTMLIsLocked="false" --><!-- InstanceBeginEditable name="head" -->
<?php
/**
 * @author Decameron
 * @copyright 2014
 */
session_start();
if (isset($_SESSION["datos_usuario"])) {
?>
<!-- InstanceEndEditable -->
<div id="wrapper">
    <!-- InstanceBeginEditable name="includes" -->
    <?php
    $id_habitacion = 1;
    include('header.php');
	include('../core/Users.php');
	$users = new Users();
	$usearch = $users->search_user($_SESSION["datos_usuario"]);
    ?>
    
<form id="frmSocio" class="formular" method="post" autocomplete="off">
    <!-- InstanceEndEditable -->
    <div id="content">
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Datos del Empleado </div>
                <table id="tabla_contenido" class="frmPpal">
                    <tr>
                        <td colspan="4">*El titular debe ser mayor de edad  </td>
                    </tr>

                    <tr>
                        <td>Nombres</td>
                        <td><input class="noCarEsp validate[required] text-input" name="socio_nombre" type="text" id="socio_nombre" size="25" value="<?php echo $usearch["first_name"];?>"/></td>
                        <td>Apellidos</td>
                        <td><input class="noCarEsp validate[required] text-input"  name="socio_apellido" type="text" id="socio_apellido" size="25"/></td>
                    </tr>
                    <tr>
                        <td>Tel&eacute;fono </td>
                        <td ><input class="num validate[required] text-input" name="socio_tel_oficina" id="socio_tel_oficina" type="text" size="20"/></td>

                        <td>E-mail</td>
                        <td >   <input name="email" type="text" id="email" size="36" class="e-mail validate[custom[email]] text-input" /></td>
                    </tr>

                    <tr>
                        <td>Pais </td>
                        <td >
                            <select id="pais"  name="pais">
                                <option>El Salvador</option>
                                <option>Guatemala</option>
                                <option>Nicaragua</option>						
                            </select>
                        </td>

                        <td>Ciudad</td>
                        <td >
                            <select id="cuidad"  name="cuidad">
                                <option>San Salvador</option>
                                <option>San Miguel</option>
                                <option>Santa Ana</option>						
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Direcci&oacute;n 1</td>
                        <td ><textarea class="direccion validate[required] text-input"  name="socio_direccion1" id="socio_direccion1" maxlength="500" style="min-width:200px; max-width:200px; min-height:150px; max-height:150px;"></textarea></td>
                    </tr>
                    <tr>
                        <th colspan="4">&nbsp;</th>
                    </tr>
					<tr class="notHide" >

                        <td colspan="6"  align="center">
                            <input type="hidden" id="action" name="action" value="ingresar"/>
                            <input type="button" id="submit" name="submit" class="submit" value="Ingresar Solicitud"/>
                            <input type="submit" id="submit1" name="submit1" style="display: none;" value="Ingresar Solicitud"/></td>


                    </tr>
                </table>
            <table>
                <tr class="fuente12_rojo">
                    <td>Ingresado Exitosamente</td>
                </tr>
            </table>
        <!-- InstanceEndEditable -->
    </div>
    </form>
    <br />
    <br />

    <?php
    include('footer.php');
	} else {
		header('Location: ../index.php');
	}
    ?>
</div><!-- InstanceEnd -->