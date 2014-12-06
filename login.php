<?php
session_start();
if (!isset($_SESSION["datos_usuario"])) {
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="resources/css/login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login</h1>
	  <?php if (isset($_REQUEST["bad"])){
				echo "<h2>Ingrese usuario / contrase&ntilde;a validos </h2>";
			}
	  ?>
      <form method="post" action="core/Login.php?action=login">
        <p><input type="text" name="login" value="" placeholder="Username or Email" required></p>
        <p><input type="password" name="password" value="" placeholder="Password" required></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

  </section>
</body>
</html>
<?php
	} else {
		header('Location: pages/index.php');
	}
?>
