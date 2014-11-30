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
	$_SESSION['app_id'] = 1;
	include('log.php');
    ?>
	<table width="342" border="1">
      <tr>
        <td width="177">Id Socio: </td>
        <td width="149"><form name="form1" method="post" action="">
          <label>
            <input type="text" name="textfield">
          </label>
        </form>        </td>
      </tr>
      <tr>
        <td>Numero de Cuenta:</td>
        <td><input type="text" name="textfield2"></td>
      </tr>
      <tr>
        <td>Nombre de Socio:</td>
        <td><input type="text" name="textfield3"></td>
      </tr>
      <tr>
        <td>Saldo:</td>
        <td><input type="text" name="textfield4"></td>
      </tr>
      <tr>
        <td>Fecha de Transaccion: </td>
        <td><input type="text" name="textfield5"></td>
      </tr>
      <tr>
        <td><form name="form2" method="post" action="">
          <label>
		  <input type="hidden" id="action" name="action" value="Enviar"/>
            <input name="Enviar" type="submit" id="Enviar" value="Enviar">
          </label>
        </form>        </td>
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