<?php
	
	$conn = mysql_connect("localhost","root","codisola") or die(mysql_error());
	mysql_select_db("codisola2",$conn);

		if(isset($_POST['submit']))
	{
		$file = $_FILES['file']['tmp_name'];
		
		$handle = fopen ($file,"r");
		$i=0;	
		while(($fileop = fgetcsv($handle,1000,",")) !== false)
		{
		
		$nombre = $fileop[0];
		$apellido = $fileop[1];
		$correo = $fileop[2];
		if($i==0){
		false;
		}else{
		$sql = mysql_query("INSERT INTO usuarios (nombre, apellido, correo) VALUES('$nombre','$apellido','$correo')");
		}
		$i++;
		}
		if($sql)
		{
			echo 'datos guardados exitosamente';
		}
	}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<title>Documento sin t&iacute;tulo</title>
</head>
	<div id ="mainWrapper">

			<form method="post" action="index.php" enctype="multipart/form-data">
				
			<input type="file" name="file"/>
			<br/>
			<input type="submit" name="submit" value="submit"/>
			
			</form>
			
	</div>
<body>
</body>
</html>
