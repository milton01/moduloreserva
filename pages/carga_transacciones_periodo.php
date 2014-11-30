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
	$_SESSION['app_id'] = 24;
	include('log.php');
 
	extract($_POST);

   
   $conn = mysql_connect("localhost","root","codisola") or die(mysql_error());
	mysql_select_db("codisola2",$conn);

		if(isset($_POST['submit']))
	{
		$file = $_FILES['file']['tmp_name'];
		
		$handle = fopen ($file,"r");
		$i=0;	
		while(($fileop = fgetcsv($handle,1000,",")) !== false)
		{
		
		$socio_id = $fileop[0];
		$tipo_movimiento = $fileop[3];
		$operacion_fecha = $fileop[5];
		$movimiento_monto = $fileop[6];
		$cuenta_ahorro = $fileop[7];		
		
		
	$i++;	
		if($i==0){
		false;
	
	}else{
	if($tipo_movimiento=='Ahorro'){
		$sql = mysql_query("INSERT INTO movimiento (operacion_fecha, socio_id, cuenta_ahorro,tipo_movimiento, movimiento_monto) VALUES('$operacion_fecha','$socio_id','$cuenta_ahorro','$tipo_movimiento','$movimiento_monto')");
		}else if($tipo_movimiento!='Ahorro'){
		$sql = mysql_query("INSERT INTO movimiento (operacion_fecha, socio_id, cuenta_ahorro,tipo_movimiento, movimiento_monto) VALUES('$operacion_fecha','$socio_id','$cuenta_ahorro','$tipo_movimiento','$movimiento_monto')");
		}
		
		}

		}
	
	if($sql)
		
		{
			echo '<li class="titulo_reporte"> datos guardados exitosamente</li>';
		}
	}
	
    
    ?>

	<!-- InstanceEndEditable -->
    <div id="content">	
        <!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <!-- InstanceBeginEditable name="Content" -->
        <div class="titulo_reporte">Generacion de Trasacciones de Periodo</div>

		<form method="post" action="carga_transacciones_periodo.php" enctype="multipart/form-data">
				
			<input type="file" class="fuente12_rojo" name="file"/>
			<br/>
			<input type="submit" name="submit" value="ingresar"/>
			
			</form>
      
        <!-- InstanceEndEditable -->
    </div>
	
    <?php
    include('footer.php');
    ?>
</div><!-- InstanceEnd -->