<!-- InstanceBegin template="/Templates/codisola.dwt.php" codeOutsideHTMLIsLocked="false" --><!-- InstanceBeginEditable name="head" -->
<?php
/**
 * @author Decameron
 * @copyright 2014
 */
?>
<!-- InstanceEndEditable -->
<div id="wrapper">
    <!-- InstanceBeginEditable name="includes" -->
    <?php
    include('header.php');
    include('menu_detReserva.php');
    $_SESSION['app_id'] = 5;
    include('log.php');
    

    
    extract($_POST);
    $action = ($action == '') ? 'none' : $action;
    if ($action == 'none') {
        session_start();
        $tipo_habitacion    = $_SESSION['tipo_habitacion'];
        $fecha_desde        = $_SESSION['fecha_entrada'];
        $fecha_hasta        = $_SESSION['fecha_salida'];
        $cantidad_personas  = $_SESSION['cantidad_personas'];
        $cant_ninios        = $_SESSION['cant_ninios'];
        $cant_adultos       = $_SESSION['cant_adultos'];
        
    } else if ($action == 'siguiente') {
        $precio=(5*$cantidad_personas);
        $_SESSION['tipo_Habitacion'] =$idHabitacion;
        $_SESSION['precio']         =$precio             ;

        echo "<script>window.location = 'crea_reserva.php'</script>";
        header('Location: crea_reserva.php');
        
        
    }
    ?>
    <script>
        $(document).ready(function() {
            var error = 1;
            var falta = 0;
            $('#frmPpal:input').each(function() {
                if ($(this).val() == '') {
                    falta = 1;
                }
            });
            if (falta == 0) {
                error = 0;
            }
            $('#submit').click(function() {
                if (error == 0) {
                    $('#submit1').click();
                } else {
                    alert('Existen campos vacios');
                }
            });
        });
    </script>

    <!-- InstanceEndEditable -->
    <div id="content">
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Datos del Titular de la Reserva</div>
        <?php
        $object->permisoApp($permiso_app);
        ?>
        <?php
        if ($action == 'none') {
            ?>
            <form id="frmSocio" class="formular" method="post" autocomplete="off">
                <table id="tabla_contenido" class="frmPpal">
                    <tr>
                        <td colspan="4">*El titular debe ser mayor de edad  </td>
                    </tr>

                    <tr>
                        <td>Habitacion</td>
                        <td>Estandar: <input name="idHabitacion" type="radio" id="idHabitacion1" value="1" size="25"/></td>
                        <td>Superior: <input name="idHabitacion" type="radio" id="idHabitacion2" value="1" size="25"/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Para: </td>
                        <td><?php echo $cantidad_personas ?> Personas</td>
                        <td>&nbsp; </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><?php echo $cant_ninios ?> ninios </td>
                        <td><?php echo $cant_adultos ?> adultos </td>
                        <td>&nbsp; </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="hidden" id="action" name="action" value="siguiente"/>
                            <input type="button" id="submit" name="submit" class="submit" value="Ingresar Solicitud"/>
                            <input type="submit" id="submit1" name="submit" style="display: none;" class="submit" value="Ingresar Solicitud"/>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </form>
            <?php
        } else if ($action == 'ingresar') {
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
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <?php
    include('footer.php');
    ?>
</div><!-- InstanceEnd -->