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
	$_SESSION['app_id'] = 22;
	include('log.php');
 
	extract($_POST);
    if ($action == 'ingresar') {
    	
    }
    ?>
    <script>
	function inicio(){
	
	
	}
	
	</script>
	<!-- InstanceEndEditable -->
    <div id="content">	
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Generacion de Trasacciones de Periodo</div>
        <?php
        $object->permisoApp($permiso_app);
        ?>
	<?php
    if($action == ''){
	?>
        <form method="post" autocomplete="off">
            <table id="tabla_contenido">
               <tr>
                <td>      <input  type="hidden" id="submit" name="submit" class="submit" value="ingresar"/>
                       <a  onclick="parent.location='inicio_operador.php'"  href="../resources/excel/operaciones.php"  style="text-decoration:none;">Generar Excel <img alt="ingresar" src="../images/excel_icon.png"/></a></td>
			   </tr>
            </table>
        </form>
        <!-- InstanceEndEditable -->
    </div>
	<?php
    }else if($action == 'ingresar'){
	?>
		<table>
            <tr class="fuente12_rojo">
                <td>Archivo Generado Exitosamente!!</td>
            </tr>
        </table>
	<?php
    }else{
	?>
			<table>
            <tr class="fuente12_rojo">
                <td>No hay transacciones Pendientes</td>
            </tr>
        </table>
	<?php
    }
	?>	
    <?php
    include('footer.php');
    ?>
</div><!-- InstanceEnd -->