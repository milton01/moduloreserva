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
    session_start();
  
    $precio= ($_SESSION['precio'] == '') ? 0 : $_SESSION['precio'];
    $numAdt= ($_SESSION['cantidad_adultos'] == '') ? 0 : $_SESSION['cantidad_adultos'];
    $numNin= ($_SESSION['cantidad_ninios'] == '') ? 0 : $_SESSION['cantidad_ninios'];
    $fecha_desde = ($_SESSION['fecha_entrada'] == '') ? '' : $_SESSION['fecha_entrada'];
    $fecha_hasta = ($_SESSION['fecha_salida'] == '') ? '' : $_SESSION['fecha_salida'];
    $tipo_habitacion = ($_SESSION['tipo_habitacion'] == '') ? '' : $_SESSION['tipo_habitacion'];
    $cantidad_personas = ($_SESSION['cantidad_personas'] == '') ? 0 : $_SESSION['cantidad_personas'];
    $id_habitacion = 1;
    
    include('header.php');
    include('menu_detReserva.php');

    $date = date("Y-m-d");
    $anos = 18;
    $periodo = date("Y-m-d", strtotime("$fecha -$anos year"));

    $anio0 = date("y");
    $anio1 = date("y", strtotime("$fecha +1 year"));
    $anio2 = date("y", strtotime("$fecha +2 year"));
    $anio3 = date("y", strtotime("$fecha +3 year"));
    $anio4 = date("y", strtotime("$fecha +4 year"));
    $anio5 = date("y", strtotime("$fecha +5 year"));
    
    $q_documentos="SELECT id_tipo_documento, nombre FROM decameron_tipo_documento";
    $documentos = $object->selquery($q_documentos);
    
    $q_franquicias="SELECT id_franquicia, nombre FROM decameron_franquicia";
    $franquicias = $object->selquery($q_franquicias);
    
    extract($_POST);
    $action = ($action == '') ? 'none' : $action;
    
    if ($action == 'none') {
        $id_habitacion = 1;//$_SESSION['id_habitacion'];
        $tipo_habitacion = $_SESSION['tipo_habitacion'];
        $fecha_desde = $_SESSION['fecha_entrada'];
        $fecha_hasta = $_SESSION['fecha_salida'];
        $cantidad_personas = $_SESSION['cantidad_personas'];
        $numAdt     =$_SESSION['cantidad_adultos'];
        $numNin     =$_SESSION['cantidad_ninios'];
        $precio = $_SESSION['precio'];
        
    } else if ($action == 'ingresar') {
               
        $socio_nombre		=($_POST['socio_nombre'] == '') 	? "" : $_POST['socio_nombre'];
        $socio_apellido		=($_POST['socio_apellido'] == '') 	? "" : $_POST['socio_apellido'];
        $tipo_documento		=($_POST['tipo_documento'] == '') 	? "" : $_POST['tipo_documento'];
        $socio_numero		=($_POST['socio_numero'] == '') 	? "" : $_POST['socio_numero'];
        $socio_tel_oficina	=($_POST['socio_tel_oficina'] == '')    ? "" : $_POST['socio_tel_oficina'];
        $email			=($_POST['email'] == '') 		? "" : $_POST['email'];
        $pais			=($_POST['pais'] == '') 		? "" : $_POST['pais'];
        $cuidad			=($_POST['cuidad'] == '') 		? "" : $_POST['cuidad'];
        $socio_direccion1	=($_POST['socio_direccion1'] == '')     ? "" : $_POST['socio_direccion1'];
        $socio_direccion2	=($_POST['socio_direccion2'] == '')     ? "" : $_POST['socio_direccion2'];
        $franquicia		=($_POST['franquicia'] == '') 		? "" : $_POST['franquicia'];
        $num_tarjeta		=($_POST['num_tarjeta'] == '') 		? "" : $_POST['num_tarjeta'];
        $mes_exp		=($_POST['mes_exp'] == '') 		? "" : $_POST['mes_exp'];
        $anio_exp		=($_POST['anio_exp'] == '') 		? "" : $_POST['anio_exp'];
        $codigo_seguridad	=($_POST['codigo_seguridad'] == '')     ? "" : $_POST['codigo_seguridad'];
        $nombre_tarjeta		=($_POST['nombre_tarjeta'] == '') 	? "" : $_POST['nombre_tarjeta'];
        $idpersona		=($_POST['idpersona'] == '') 		? "" : $_POST['idpersona'];
        $nombre_1		=($_POST['nombre_1'] == '') 		? "" : $_POST['nombre_1'];
        $apellido_1		=($_POST['apellido_1'] == '') 		? "" : $_POST['apellido_1'];
        $numerodoc_1		=($_POST['numerodoc_1'] == '') 		? "" : $_POST['numerodoc_1'];
        $fecha_nac_1		=($_POST['fecha_nac_1'] == '') 		? "" : $_POST['fecha_nac_1'];
        $genero_1		=($_POST['genero_1'] == '') 		? "" : $_POST['genero_1'];
        
		$nombre_2		=($_POST['nombre_2'] == '') 		? "" : $_POST['nombre_2'];
        $apellido_2		=($_POST['apellido_2'] == '') 		? "" : $_POST['apellido_2'];
        $numerodoc_2		=($_POST['numerodoc_2'] == '') 		? "" : $_POST['numerodoc_2'];
        $fecha_nac_2		=($_POST['fecha_nac_2'] == '') 		? "" : $_POST['fecha_nac_2'];
        $genero_2		=($_POST['genero_2'] == '') 		? "" : $_POST['genero_2'];
		
        $nombre_3		=($_POST['nombre_3'] == '') 		? "" : $_POST['nombre_3'];
        $apellido_3		=($_POST['apellido_3'] == '') 		? "" : $_POST['apellido_3'];
        $numerodoc_3		=($_POST['numerodoc_3'] == '') 		? "" : $_POST['numerodoc_3'];
        $fecha_nac_3		=($_POST['fecha_nac_3'] == '') 		? "" : $_POST['fecha_nac_3'];
        $genero_3		=($_POST['genero_3'] == '') 		? "" : $_POST['genero_3'];

        $nombre_4		=($_POST['nombre_4'] == '') 		? "" : $_POST['nombre_4'];
        $apellido_4		=($_POST['apellido_4'] == '') 		? "" : $_POST['apellido_4'];
        $numerodoc_4		=($_POST['numerodoc_4'] == '') 		? "" : $_POST['numerodoc_4'];
        $fecha_nac_4		=($_POST['fecha_nac_4'] == '') 		? "" : $_POST['fecha_nac_4'];
        $genero_4		=($_POST['genero_4'] == '') 		? "" : $_POST['genero_4'];
        
        $nombre_5		=($_POST['nombre_5'] == '') 		? "" : $_POST['nombre_5'];
        $apellido_5		=($_POST['apellido_5'] == '') 		? "" : $_POST['apellido_5'];
        $numerodoc_5		=($_POST['numerodoc_5'] == '') 		? "" : $_POST['numerodoc_5'];
        $fecha_nac_5		=($_POST['fecha_nac_5'] == '') 		? "" : $_POST['fecha_nac_5'];
        $genero_5		=($_POST['genero_5'] == '') 		? "" : $_POST['genero_5'];
        
       
         //tabla decameron_people
        $q_insert="INSERT INTO decameron.decameron_people "
                . " (first_name,last_name,phone_number,email, "
                . " address_1,address_2,city,state,zip,country, "
                . " comments, numero_documento, id_tipo_documento) "
                . " VALUES  "
                . " ('".$socio_nombre."','".$socio_apellido."','".$socio_tel_oficina."' ,'".$email."', "
                . " '".$socio_direccion1."','".$socio_direccion2."','".$cuidad."' ,'1' ,'N/A' ,'".$pais."' , "
                . " 'N/A','".$socio_numero."' ,'".$tipo_documento."')";
        
        $personas = $object->insquery($q_insert);
        
        $query1 = "select max(person_id) person_id from decameron.decameron_people";
        $people = $object->selquery($query1);
        if (count($people) > 0) {
            foreach ($people as $key => $val) {
                $id_people = $val['person_id'];
            }
        }
        
        
        //tabla decameron_tarjeta_credito
        $q_insert =" INSERT INTO decameron.decameron_tarjeta_credito"
                . " (numero_tarjeta, mes_expiracion, anio_expiracion, "
                . " codigo_seguridad, nombre, fecha_nacimiento, person_id, "
                . " id_franquicia) "
                . " VALUES( "
                . " '".$num_tarjeta."', '".$mes_exp."', '".$anio_exp."', "
                . " '".$codigo_seguridad."', '".$nombre_tarjeta."', "
                . " date(now()), '".$id_people."', "
                . " '".$franquicia."')";
        
        $tarjetas = $object->insquery($q_insert);
        
        $query2 = "select max(id_tarjeta_credito) id_tarjeta_credito from decameron.decameron_tarjeta_credito";
        $idcards = $object->selquery($query2);
        if (count($idcards) > 0) {
            foreach ($idcards as $key => $val) {
                $id_tarjeta_credito = $val['id_tarjeta_credito'];
            }
        }
        
        // tabla de numero de personas
        $q_insert=" INSERT INTO "
                . " decameron.decameron_numero_personas "
                . " (num_adultos, num_ninos) "
                . " VALUES "
                . " (".$numAdt.", ".$numNin.")";
        
        $npersonas = $object->insquery($q_insert);
        
        
        //tabla reservacion
        $q_insert = "INSERT INTO decameron.decameron_reservacion "
                . " (fecha_reservacion, fecha_desde, fecha_hasta, "
                . " estado, id_habitacion, id_tipo_habitacion, "
                . " id_tarjeta_credito, id_numero_personas) "
                . " VALUES "
                . " (date(now()),'".$fecha_desde."','".$fecha_hasta."', "
                . " '1','".$id_habitacion."','".$tipo_habitacion."', "
                . " ".$id_tarjeta_credito.",".$cantidad_personas.")";
        
        $reservacion = $object->insquery($q_insert);
        
        $con = fopen("COM3", "w");
	fwrite($con, "D");
	fclose($con);
        
    }
    ?>
    <script>
        $(document).ready(function() {
            $('#detallePersonas tr:not(.notHide)').hide();
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
            var count = 1;
            $('#detallePersonas tr:not(.notHide)').each(function() {
                if (count <(<?php echo $cantidad_personas ?>+1))
                    $(this).show();
                count++;
            });
            
            
        });
    </script>
<form id="frmSocio" class="formular" method="post" autocomplete="off">
    <!-- InstanceEndEditable -->
    <div id="content">
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Datos del Titular de la Reserva</div>
        <?php
        if ($action == 'none') {
            ?>
            
                <table id="tabla_contenido" class="frmPpal">
                    <tr>
                        <td colspan="4">*El titular debe ser mayor de edad  </td>
                    </tr>

                    <tr>
                        <td>Nombres</td>
                        <td><input class="noCarEsp validate[required] text-input" name="socio_nombre" type="text" id="socio_nombre" size="25"/></td>
                        <td>Apellidos</td>
                        <td><input class="noCarEsp validate[required] text-input"  name="socio_apellido" type="text" id="socio_apellido" size="25"/></td>
                    </tr>

                    <tr>

                        <td>Tipo Documento</td>
                        <td>
                            <select id="tipo_documento"  name="tipo_documento">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select>
                        </td>
                        <td>N&uacute;mero</td>
                        <td><input class="num validate[required] text-input" name="socio_numero" type="text" id="socio_numero" size="20"/></td>
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

                        <td>Direcci&oacute;n 2</td>
                        <td ><textarea class="direccion validate[required] text-input"  name="socio_direccion2" id="socio_direccion2" maxlength="500" style="min-width:200px; max-width:200px; min-height:150px; max-height:150px;"></textarea></td>
                    </tr>
                    <tr>
                        <th colspan="4">&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="4">PAGO CON TARJETA DE CREDITO</th>
                    </tr>
                    <tr>
                        <th colspan="4">&nbsp;</th>
                    </tr>
                    <tr>
                        <td>Franquicia</td>
                        <td>
                            <select id="franquicia"  name="franquicia">
                                 <?php 
                                foreach($franquicias as $key => $val){
					echo '<option value="'.$val['id_franquicia'].'">'.$val['nombre'].'</option>';
				}
                                ?>							
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Numero Tarjeta</td>
                        <td><input class="num validate[required] text-input" name="num_tarjeta" type="text" id="num_tarjeta" size="20"/></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Mes Expiracion</td>
                        <td>
                            <select id="mes_exp"  name="mes_exp">
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </td>
                        <td>Anio Expiracion</td>
                        <td>
                            <select id="anio_exp"  name="anio_exp">
                                <option value="<?php echo $anio0; ?>"><?php echo $anio0; ?></option>
                                <option value="<?php echo $anio1; ?>"><?php echo $anio1; ?></option>
                                <option value="<?php echo $anio2; ?>"><?php echo $anio2; ?></option>
                                <option value="<?php echo $anio3; ?>"><?php echo $anio3; ?></option>
                                <option value="<?php echo $anio4; ?>"><?php echo $anio4; ?></option>
                                <option value="<?php echo $anio5; ?>"><?php echo $anio5; ?></option>

                            </select>
                        </td>

                    </tr>
                    <tr>
                        <td>Codigo Seguridad</td>
                        <td><input name="codigo_seguridad" type="password" id="codigo_seguridad" size="20"  /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>Nombre</td>
                        <td><input name="nombre_tarjeta" type="text" id="nombre_tarjeta" class="noCarEsp" size="20"/></td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            
                           <!-- 
                           <input type="hidden" id="action" name="action" value="ingresar"/>
                           <input type="button" id="submit" name="submit" class="submit" value="Ingresar Solicitud"/>
                            <input type="submit" id="submit1" name="submit" style="display: none;" class="submit" value="Ingresar Solicitud"/>
                           -->
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            
            <?php
        } else if ($action == 'ingresar') {
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
    <div id="pre_footer">
        <div align="center">
            
                <table id="detallePersonas">
                    <tr class="notHide">
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo Documento</th>
                        <th>Numero</th>
                        <th>Fecha Nacimiento</th>
                        <th>Genero</th>

                    </tr>
                    <tr id="tr1">
                        <td><input type="text" class="noCarEsp validate[required]" name="nombre_1" id="nombre_1"/> </td>
                        <td><input type="text" class="noCarEsp validate[required]" name="apellido_1" id="apellido_1"/></td>
                        <td> <select id="tipo_doc_1"  name="tipo_doc_1">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select></td>
                        <td><input type="text" class="num" name="numerodoc_1" id="numerodoc_1"/></td>
                        <td><input type="text"  readonly="readonly" class="num validate[custom[date],past[NOW]] text-input datepicker" name="fecha_nac_1" id="fecha_nac_1"/></td>
                        <td><select id="genero_1"  name="genero_1">
                                <option>Hombre</option>
                                <option>Mujer</option>												
                            </select></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr id="tr2">
                        <td><input type="text" class="noCarEsp validate[required]" name="nombre_2" id="nombre_2"/> </td>
                        <td><input type="text" class="noCarEsp validate[required]" name="apellido_2" id="apellido_2"/></td>
                        <td> <select id="tipo_doc_2"  name="tipo_doc_2">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select></td>
                        <td><input type="text" class="num" name="numerodoc_2" id="numerodoc_2"/></td>
                        <td><input type="text"  readonly="readonly" class="validate[custom[date],past[NOW]]"  name="fecha_nac_2" id="fecha_nac_2"/></td>
                        <td><select id="genero_2"  name="genero_2">
                                <option>Hombre</option>
                                <option>Mujer</option>												
                            </select></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr id="tr3">
                        <td><input type="text" class="noCarEsp validate[required]" name="nombre_3" id="nombre_3"/> </td>
                        <td><input type="text" class="noCarEsp" name="apellido_3" id="apellido_3"/></td>
                        <td> <select id="tipo_doc_3"  name="tipo_doc_3">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select></td>
                        <td><input type="text" class="num" name="numerodoc_3" id="numerodoc_3"/></td>
                        <td><input type="text" class="num validate[custom[date],past[NOW]] "   name="fecha_nac_3" id="fecha_nac_3"/></td>
                        <td><select id="genero_3"  name="genero_3">
                                <option>Hombre</option>
                                <option>Mujer</option>												
                            </select></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr id="tr4">
                        <td><input type="text" class="noCarEsp" name="nombre_4" id="nombre_4"/> </td>
                        <td><input type="text" class="noCarEsp" name="apellido_4" id="apellido_4"/></td>
                        <td> <select id="tipo_doc_4"  name="tipo_doc_4">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select></td>
                        <td><input type="text" class="num" name="numerodoc_4" id="numerodoc_4"/></td>
                        <td><input type="text" class="num" readonly="readonly" class="validate[custom[date],past[NOW]]"  name="fecha_nac_4" id="fecha_nac_4"/></td>
                        <td><select id="genero_4"  name="genero_4">
                                <option>Hombre</option>
                                <option>Mujer</option>												
                            </select></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr id="tr5">
                        <td><input type="text" class="noCarEsp" name="nombre_5" id="nombre_5"/> </td>
                        <td><input type="text" class="noCarEsp" name="apellido_5" id="apellido_5"/></td>
                        <td> <select id="tipo_doc_5"  name="tipo_doc_5">
                                <option value="0">Seleccione</option>
                                <?php 
                                foreach($documentos as $key => $val){
					echo '<option value="'.$val['id_tipo_documento'].'">'.$val['nombre'].'</option>';
				}
                                ?>						
                            </select></td>
                        <td><input type="text" class="num" name="numerodoc_5" id="numerodoc_5"/></td>
                        <td><input type="text" class="num" readonly="readonly" class="validate[custom[date],past[NOW]]"  name="fecha_nac_5" id="fecha_nac_5"/></td>
                        <td><select id="genero_5"  name="genero_5">
                                <option>Hombre</option>
                                <option>Mujer</option>												
                            </select></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="notHide" >
                        <th colspan="6">&nbsp;</th>
                    </tr>
                    <tr class="notHide" >
                        <th colspan="6">&nbsp;</th>
                    </tr>
                    <tr class="notHide" >

                        <td colspan="6"  align="center">
                            <input type="hidden" id="action" name="action" value="ingresar"/>
                            <input type="button" id="submit" name="submit" class="submit" value="Ingresar Solicitud"/>
                            <input type="submit" id="submit1" name="submit1" style="display: none;" value="Ingresar Solicitud"/></td>


                    </tr>
                </table>
            
        </div>

    </div>
    </form>
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