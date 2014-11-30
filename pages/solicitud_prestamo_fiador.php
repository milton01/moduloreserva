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
	$_SESSION['app_id'] = 11;
	include('log.php');
    ?>
	<!-- InstanceEndEditable -->
  	<div id="content">
            <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
    <!-- InstanceBeginEditable name="Content" -->
        
  	<!--table width="500" border="1"-->
        <table id="tabla_contenido">
            <tr >
                    <th colspan="4" >SOLICITUD PRESTAMO FIADOR</th>
                </tr>
      <tr>
        <td width="133">Nombre de Cuenta: </td>
        <td width="144"><form name="form2" method="post" action="">
          <label>
            <input type="text" name="textfield">
            </label>
        </form>        </td>
        <td width="222">Solicitud Numero:</td>
        <td width="145"><input type="text" name="textfield5"></td>
      </tr>
      <tr>
        <td>Codigo Empleado:</td>
        <td><input type="text" name="textfield2"></td>
        <td>Prestamo:</td>
        <td><input type="text" name="textfield4"></td>
      </tr>
      <tr>
        <td>Financiamiento:</td>
        <td><input type="text" name="textfield3"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Datos Solicitante. </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Nombre:</td>
        <td><input type="text" name="textfield6"></td>
        <td>A&ntilde;o Ingreso: </td>
        <td><input type="text" name="textfield7"></td>
      </tr>
      <tr>
        <td>Empresa:</td>
        <td><input type="text" name="textfield11"></td>
        <td>Ingreso Codisola de R.L. </td>
        <td><input type="text" name="textfield8"></td>
      </tr>
      <tr>
        <td>Sueldo:</td>
        <td><input type="text" name="textfield10"></td>
        <td>Cargo del Trabajador: </td>
        <td><input type="text" name="textfield9"></td>
      </tr>
      <tr>
        <td>Cantidad:</td>
        <td><input type="text" name="textfield12"></td>
        <td>Plazo:</td>
        <td><input type="text" name="textfield13"></td>
      </tr>
      <tr>
        <td>Cuota:</td>
        <td><input type="text" name="textfield14"></td>
        <td>Observaciones Destino Financiero: </td>
        <td><input type="text" name="textfield15"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><form name="form1" method="post" action="">
          <label>
          <div align="center">
            <input name="Enviar" type="submit" id="Enviar" value="Enviar">
          </div>
          </label>
        </form>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <!-- InstanceEndEditable -->    </div>
    <?php
	include('Templates/footer.php');
	?>
</div><!-- InstanceEnd -->