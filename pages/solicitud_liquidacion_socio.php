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
    $_SESSION['app_id'] = 10;
    include('log.php');
    ?>
    <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
    <!--table width="644" border="1"-->
    <table id="tabla_contenido">
        <tr >
            <th colspan="4" >SOLICITUD LIQUIDACION SOCIO</th>
        </tr>
        <tr>
            <td width="185">Fecha:</td>
            <td width="144"><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield">
                    </label>
                </form>        </td>
            <td width="142">Verificado por: </td>
            <td width="145"><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield13">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Carnet:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield2">
                    </label>
                </form></td>
            <td>Ultimo Mes Cobrados: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield14">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Nombre:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield3">
                    </label>
                </form></td>
            <td>Meses Restantes: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield15">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Cuenta de Ahorro a Liquidar:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield4">
                    </label>
                </form></td>
            <td>Saldo:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield16">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Cuota Mensual: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield5">
                    </label>
                </form></td>
            <td>Orden de Proveedor: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield17">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Estado de Cuenta a: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield6">
                    </label>
                </form></td>
            <td>Monto Deposito: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield18">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Aportacion:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield7">
                    </label>
                </form></td>
            <td>Deposito:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield19">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Ahorro:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield8">
                    </label>
                </form></td>
            <td>Otros:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield20">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Cuenta Corriente: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield9">
                    </label>
                </form></td>
            <td>Saldo Socio:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield21">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Prestamo Normal: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield10">
                    </label>
                </form></td>
            <td><p>Total a Entregar: </p>        </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield22">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Prestamo Especial: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield11">
                    </label>
                </form></td>
            <td>Saldo a Favor: </td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield23">
                    </label>
                </form></td>
        </tr>
        <tr>
            <td>Saldo:</td>
            <td><form name="form1" method="post" action="">
                    <label>
                        <input type="text" name="textfield12">
                    </label>
                </form></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><form name="form2" method="post" action="">
                    <label>
                        <input type="hidden" id="action" name="action" value="Enviar"/>
                        <input name="Enviar" type="submit" id="Enviar" value="Enviar">
                    </label>
                </form>        </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <!-- InstanceEndEditable -->
    <div id="content">
        <!-- InstanceBeginEditable name="Content" -->

        <!-- InstanceEndEditable -->
    </div>
    <?php
    include('Templates/footer.php');
    ?>
</div><!-- InstanceEnd -->