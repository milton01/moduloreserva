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
	<!-- InstanceEndEditable -->
  	<div id="content">
    <!-- InstanceBeginEditable name="Content" -->
    <table id="tabla_contenido">
      <tr>
        <td colspan="4">Cosulta Cuenta de Ahorro</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td width="150">Sexo</td>
        <td width="175"><input type="radio" name="socio_sexo" id="socio_sexo_m" value="M" checked="checked"/>
          Masculino
          <input type="radio" name="socio_sexo" id="socio_sexo_f" value="F"/>
          Femenino</td>
        <td width="150">Estado Civil</td>
        <td width="175"><?php
                $estados_civiles = $object->selquery("SELECT est_civil_id, est_civil_nombre FROM estado_civil ORDER BY est_civil_nombre");
				$est_civil_id = ($est_civil_id == '')? 1: $est_civil_id;
				echo '<select id="est_civil_id" name="est_civil_id">';
				foreach($estados_civiles as $key => $val){
					echo '<option value="'.$val['est_civil_id'].'" '.(($val['est_civil_id'] == $est_civil_id)?'selected':'').'>'.$val['est_civil_nombre'].'</option>';
				}
				echo '</select>';
				?></td>
      </tr>
      <tr>
        <td>Nombre Socio</td>
        <td><input class=":required :alpha :only_on_submit vanadium-invalid ;adv" name="socio_nombre1" type="text" id="socio_nombre1" size="25"/></td>
        <td>Segundo Nombre</td>
        <td><input name="socio_nombre2" type="text" id="socio_nombre2" size="25"/></td>
      </tr>
      <tr>
        <td>Primer Apellido</td>
        <td><input class=":required :only_on_submit vanadium-invalid" name="socio_apellido1" type="text" id="socio_apellido1" size="25"/></td>
        <td>Segundo Apellido</td>
        <td><input class=":required :alpha :only_on_submit vanadium-invalid" name="socio_apellido2" type="text" id="socio_apellido2" size="25"/></td>
      </tr>
      <tr id="tr_hidden" style="display:none;">
        <td>Apellido Casada</td>
        <td><input class=":alpha :only_on_submit vanadium-invalid" name="socio_apellidoc" type="text" id="socio_apellidoc" size="25"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>DUI</td>
        <td><input class=":required :only_on_submit vanadium-invalid" name="socio_dui" type="text" id="socio_dui" size="20"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>NIT</td>
        <td><input class=":required :only_on_submit vanadium-invalid" name="socio_nit" type="text" id="socio_nit" size="20"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>ISSS</td>
        <td><input class=":required :only_on_submit vanadium-invalid" name="socio_isss" type="text" id="socio_isss" size="20"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Fecha nacimiento</td>
        <td><input name="socio_fecha_nacimiento" type="text" id="socio_fecha_nacimiento" size="20" class=":date :only_on_submit vanadium-invalid"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sueldo</td>
        <td><input name="socio_salario" type="text" id="socio_salario" size="20" class=":float :required :max_length;7 :only_on_submit vanadium-invalid" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">INFORMACION DE CONTACTO</td>
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
        <td colspan="3"><input class="required" name="socio_tel_oficina" id="socio_tel_oficina" type="text" size="20"/></td>
      </tr>
      <tr>
        <td>E-mail</td>
        <td colspan="3"><input name="socio_email" type="text" id="email" size="36" class=":required :email :only_on_submit" /></td>
      </tr>
      <tr>
        <td>Direcci&oacute;n</td>
        <td colspan="3"><textarea class=":required :only_on_submit vanadium-invalid" name="socio_direccion" id="socio_direccion" style="min-width:300px; max-width:300px; min-height:50px; max-height:50px;"></textarea></td>
      </tr>
    </table>
    <!-- InstanceEndEditable -->
    </div>
    <?php
	include('footer.php');
	?>
</div><!-- InstanceEnd -->