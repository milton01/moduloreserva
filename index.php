<?php

 /**
 * @author Codisola
 * @copyright 2014
 */

require_once("core/Functions.php");
$object = new Functions();

@$action = $_POST['action'];
@$usuario = $_POST['usuario'];
@$clave = md5($_POST['clave']);

if(isset($_SESSION['islog']) && $_SESSION['islog'] == true){
	header("Location: pages/index.php");
}

if(isset($action) && $action == 'Ingresar'){
    $object->login_user($usuario,$clave);
}
?>

<style>
/* CSS3 BUTTON */

.btn {
	display: inline-block;
	background: url(btn.bg.png) repeat-x 0px 0px;
	padding:5px 10px 6px 10px;
	font-weight:bold;
	text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
	border:1px solid rgba(0,0,0,0.4);
	-moz-border-radius: 5px;
	-moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
	-webkit-border-radius: 5px;
	-webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
}

.btn:hover {
	text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
	cursor:pointer;
}

/* COLOR VARIATIONS */

.blue		{background-color: #CCCCCC; color: #141414;}
.blue:hover	{background-color: #00c0ff; color: #ffffff;}

</style>
<script>
function Login(){
	var form = document.getElementById('formulario');
	form.submit();
}
</script>
<link rel="stylesheet" href="resources/css/StyleMain.css" type="text/css" media="all"/>
<html>
    <head>
        <title>Login Usuario</title>
    </head>
    <body>
        <form method="post" autocomplete="off" id="formulario">
        <div align="center">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
<p><img src="images/banner1.png" width="592" height="150"></p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
        <table align="center" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <td><font color="black">Usuario:</font> </td>
                <td><input type="text" id="usuario" name="usuario" placeholder="Usuario" class="input_usuario"/></td>
            </tr>
            <tr>
                <td ><font color="black">Clave:</font> </td>
                <td><input name="clave" type="password" id="clave" placeholder="Clave" class="input_usuario"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><div align="center">
                  <input name="action" type="hidden" id="action" value="Ingresar">
               <input type="submit" value="Continue" class="btn blue" onclick="Login();"/></div></td>
            </tr>
        </table>
        </form>
    </body>
</html>