<!-- InstanceBegin template="/Templates/codisola.dwt.php" codeOutsideHTMLIsLocked="false" --><!-- InstanceBeginEditable name="head" -->
<?php
/**
 * @author Decameron
 * @copyright 2014
 */

    ini_set('error_reporting', 0);

 ?>
<!-- InstanceEndEditable -->
<div id="wrapper">
    <!-- InstanceBeginEditable name="includes" -->
    <?php
//    include('header.php');
//    include('menu_reserva.php');
    require_once("core/Functions.php");
    $object = new Functions();

    $date = date("Y-m-d");
    $anos = 18;
    $periodo = date("Y-m-d", strtotime("$fecha -$anos year"));
    extract($_POST);
    
    $action = ($action == '') ? 'none' : $action;
    //str_replace("world","Peter","Hello world!");
    $numAdt = ($_POST['cant_adultos'] == '') ? "" : $_POST['cant_adultos'];
    $numAdtInt = substr($numAdt, 0, 1);
    
    $numNin = ($_POST['cant_ninios'] == '') ? "" : $_POST['cant_ninios'];
    $numNinInt = substr($numNin, 0, 1);
    
    $numPersonas = $numAdt.$numNin;
    $numPersonasInt = $numAdtInt + $numNinInt;
    
    if ($action == 'none') {
        $fecha_entrada   ='';
        $fecha_salida   ='';
        $numPersonas   ='';
        
    } else if ($action == 'reservar') {
        
        $qBusqueda = "select 	r.id_reservacion Hay_Reservas " .
                "  from 	decameron.decameron_reservacion r" .
                " where 	date(r.fecha_desde) between date(str_to_date('" . $fecha_entrada . "', '%Y-%m-%d')) and date(str_to_date('" . $fecha_salida . "', '%Y-%m-%d'))" .
                "or   	date(r.fecha_hasta) between date(str_to_date('" . $fecha_entrada . "', '%Y-%m-%d')) and date(str_to_date('" . $fecha_salida . "', '%Y-%m-%d'))";
                

        $datos_Hab = $object->selquery($qBusqueda);
        
        if (count($datos_Hab) == 0) {
            session_start();
            $_SESSION['fecha_entrada']      = $fecha_entrada;
            $_SESSION['fecha_salida']       = $fecha_salida;
            $_SESSION['numPersonas']        = $numPersonas;
            $_SESSION['cantidad_personas']  = $numPersonasInt;
            $_SESSION['cantidad_adultos']   = $numAdtInt;
            $_SESSION['cantidad_ninios']    = $numNinInt;
            
            echo "<script>window.location = 'pages/carga_habitaciones.php'</script>";
            header('Location: pages/carga_habitaciones.php');
        }
    }
    ?>
    
    <title>.:: DECAMERON ::.</title>

    <link href="resources/css/StyleMain.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/StylePage.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
    
    <script src="resources/js/jquery-1.6.min.js" type="text/javascript"></script>
    <script src="resources/js/jquery.validationEngine-es.js" type="text/javascript"></script>
    <script src="resources/js/jquery.validationEngine.js" type="text/javascript"></script>
    <link href="resources/css/validationEngine.jquery.css" rel="stylesheet" type="text/css"/>
    <script src="resources/js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
    <script src="resources/js/jquery.timers.js" type="text/javascript"></script>
    <script src="resources/js/jquery.highlightFade.js" type="text/javascript"></script>
    <script src="resources/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="resources/js/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script src="resources/js/jquery.autocomplete.js" type="text/javascript"></script>
    <script src="resources/js/main.js" type="text/javascript"></script>

    <script>

        $(document).ready(function() {
            var fsalida = $('#fecha_salida');
            var fentrada = $('#fecha_entrada');

            var error = 1;
            $("#frmBusqueda").validationEngine(
                    {
                        inlineValidation: true
                    });
            $('[id*=cant]').change(function() {
                var cantidad = 0;
                var max = 5;
                $('[id*=cant]').each(function() {
                    var valor='';
                    valor=$(this).val();
                    valor=valor.replace('N','');
                    valor=valor.replace('A','');
                    cantidad = cantidad + parseInt(valor);
                });
                if (parseInt(cantidad) > max || parseInt(cantidad) < 1) {
                    $(this).validationEngine('showPrompt', 'La cantidad maxima de personas para realizar su reservacion es 5', 'error', true)
                    error = 1;
                } else
                    error = 0;
            });

            $('[id*=fecha]').change(function() {
                if (new Date(fsalida.val()).getTime() <= new Date(fentrada.val()).getTime()) {
                    fsalida.val('');
                    fentrada.val('');
                    alert('Fecha entrada no puede ser mayor a salida');
                }

            });

            $('#ingresa').click(function() {
                var form = document.forms["frmBusqueda"];
                $('[id*=cant]').change();
                if (error == 0) {
                    $('#submit').click();
                } else {
                    alert('valor de campos no validos');
                }
            });
            
            $('[id*=fecha]').datepicker({
               dateFormat: 'yy-mm-dd',
               showButtonPanel: true,
               changeMonth: true, 
               changeYear: true,
               gotoCurrent: true 
       });

        });

    </script>
    <div id="header-logo" align="center">
        <a href="index.php">
            <img src="images/banner1.png" border="0" alt="logo"/>
        </a>
    </div>
    <div id="header-bot">
        <div id="header-userbar">Las promociones expuestas en este sitio web aplican s&oacute;lo para El Salvador 
        </div>
        <div id="header-logoutbar">
            <img id="BtnSalir" alt="Salir" src="images/shut_down.png" />
        </div>
    </div>
    <div class="menu">
    
        <div class="suite_title_closed" id="suite_">
            publicidad
        </div>

        <div id="appsuite_1" class="suite_opened">

              <div id="app_" >
                  <a href="" class="suite_item" id="appa_">
                    <img width="210px" src="images/public/hoteleria-hoteles-recreacion-turismo-14131-MLM20084155343_042014-Y.jpg" border="0" alt="logo"/>
                  </a>
              </div>

              <div id="app_">
                  <a href="" class="suite_item" id="appa_">
                    <img width="210px" src="images/public/hotel-aloft-bogota-decameron.jpg" border="0" alt="logo"/>
                  </a>
              </div>
        </div>


    </div>
    <!-- InstanceEndEditable -->
    <div id="content">
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Reserva Ahora</div>

        <form id="frmBusqueda" class="formular" method="post" >
            <table id="tabla_contenido">
                <tr>
                    <th colspan="4">Datos Reserva</th>
                </tr>
                <tr>
                    <td width="150">Fecha Entrada</td>                    
                    <td width="175"><input value="<?php echo$fecha_entrada ?>" name="fecha_entrada" readonly="readonly" type="text" id="fecha_entrada" size="20" class="num validate[custom[date],future[NOW]] text-input datepicker"/></td>
                    <td width="150">&nbsp;</td>
                    <td width="175">&nbsp;</td>
                </tr>
                <tr>
                    <td width="150">Fecha Salida</td>                    
                    <td width="175"><input value="<?php echo$fecha_salida ?>" name="fecha_salida" readonly="readonly" type="text" id="fecha_salida" size="20" class="num validate[custom[date],future[NOW]] text-input datepicker"/></td>
                    <td width="150">&nbsp;</td>
                    <td width="175">&nbsp;</td>
                </tr>
                <tr>
                    <td>Adultos</td>
                    <td><select id="cant_adultos"  name="cant_adultos">
                            <option value="1A">1</option>
                            <option value="2A">2</option>
                            <option value="3A">3</option>
                            <option value="4A">4</option>
                            <option value="5A">5</option>
                        </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Ni&#241;os/as</td>
                    <td><select id="cant_ninios"  name="cant_ninios">
                            <option value="0N">Seleccione</option>
                            <option value="1N">1</option>
                            <option value="2N">2</option>
                            <option value="3N">3</option>
                            <option value="4N">4</option>
                            <option value="5N">5</option>
                        </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="hidden" id="action" name="action" value="reservar"/>
                        <input type="button" id="ingresa" name="submit" class="submit" value="Ingresar Solicitud"/>
                        <input type="submit" id="submit" name="submit" style="display: none;" value="Ingresar Solicitud"/>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
        <?php
        if ($action == 'reservar' && count($datos_Hab) > 0) {
            ?>
            <table>
                <tr class="fuente12_rojo">

                    <td>No se encontraron habitaciones disponibles al 
                        <?php echo $fecha_entrada ?>  al  <?php echo $fecha_salida?></td>

                </tr>
            </table>
            <?php
            $fecha_entrada   ='';
            $fecha_salida   ='';
            $numPersonas    ='';
        }
        
        ?>
        <!-- InstanceEndEditable -->
    </div>
    <?php
    include('pages/footer.php');
    ?>
</div><!-- InstanceEnd -->