<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$NombreBD = "codisola2";
$Servidor = "localhost";
$Usuario = "root";
$Password ="codisola";
$IdConexion = mysql_connect($Servidor, $Usuario, $Password);
mysql_select_db($NombreBD, $IdConexion);

$date = date("Ymd");
$dias= 15;
$periodo = date("Ymd", strtotime("$fecha -$dias day"));  


$sql = "SELECT so.socio_id, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ',so.socio_apellido1,' ',so.socio_apellido2) AS nombre_completo,so.socio_dui,op.tipo_operacion,CONCAT(us.usuario_nombre,' ',us.usuario_apellido) AS nombre_operador,op.operacion_fecha,op.operacion_monto, ao.cuenta_numero FROM socio so INNER JOIN operacion op ON op.socio_id = so.socio_id INNER JOIN ahorro ao ON ao.cuenta_numero = op.cuenta_ahorro INNER JOIN usuarios us ON us.usuario_id = op.usuario_id WHERE  op.operacion_fecha >= '$periodo'";
$result=mysql_query($sql,$IdConexion);


$sql2 = "SELECT so.socio_id,  CONCAT('Aportacion') AS aportacion, CONCAT(so.socio_nombre1,' ', so.socio_nombre2,' ',so.socio_apellido1,' ',so.socio_apellido2) AS nombre_completo,so.socio_dui,op.tipo_operacion,CONCAT(us.usuario_nombre,' ',us.usuario_apellido) AS nombre_operador,op.operacion_fecha,op.operacion_monto, ao.cuenta_numero, ap.aportacion_cantidad FROM socio so INNER JOIN operacion op ON op.socio_id = so.socio_id INNER JOIN ahorro ao ON ao.cuenta_numero = op.cuenta_ahorro INNER JOIN usuarios us ON us.usuario_id = op.usuario_id INNER JOIN aportacion ap ON ap.cuenta_id = ao.cuenta_id";
$result2 =mysql_query($sql2,$IdConexion);

?>

<table border="1" align="center" cellpadding="1" cellspacing="1">
<tr>
<td>Socio Id</td>
<td>Socio Nombre</td>
<td>DUI</td>
<td>Operacion</td>
<td>Nombre Operador</td>
<td>Fecha Operacion</td>
<td>Monto Operacion </td>
<td>Cuenta Decameron</td>
</tr>
<?php
while($row = mysql_fetch_array($result)) {
printf("<tr>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
</tr>", $row["socio_id"],$row["nombre_completo"],$row["socio_dui"],$row["tipo_operacion"],$row["nombre_operador"],$row["operacion_fecha"],$row["operacion_monto"],$row["cuenta_numero"]);
}
while($row = mysql_fetch_array($result2)) {
printf("<tr>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
</tr>", $row["socio_id"],$row["nombre_completo"],$row["socio_dui"],$row["aportacion"],$row["nombre_operador"],$row["operacion_fecha"],$row["aportacion_cantidad"],$row["cuenta_numero"]);
}
mysql_free_result($result);
mysql_close($IdConexion);  //Cierras la Conexión
?>
</table>
</body>
</html>